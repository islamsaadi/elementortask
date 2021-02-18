$(document).ready( () => {
    
    $.get( "/server/index.php?path=fetch-products", (resp) => {
        let body = JSON.parse(resp).body;
        let boxes = $('#boxes');

        for(product of body) {
            boxes.append(`
            <div class="product">
                <h3 class="title">${product.title}</h3>
                <img src="${product.image}" alt="Image" />
                <button class="clickme-btn" type="button" data-product-id="${product.id}">Click Me</button>
            </div>`);
        }

    }).fail(() => {
        alert( "error" );
    });

});


$(document).on('click','.clickme-btn', (e) => {
    
    let product_id = $(e.target).data('product-id');

    if(product_id === undefined) {
        alert('Something went wrong, please try later.'); 
        return;
    }

    $('#overlay').toggle();
    $('#popup').toggle();
    

    $.get( `/server/index.php?path=get-product-description-by-id&id=${product_id}`, (resp) => {
        let body = JSON.parse(resp).body;

        let popup_container = $('#popup .content');
        popup_container.html(`<p>${body}</p>`);

    }).fail(() => {
        alert( "error" );
    });
});


$(document).on('click','#popup .close-btn, #overlay', (e) => {
    $('#overlay').toggle();
    $('#popup').toggle();
});



