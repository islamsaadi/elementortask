import ProductAPI from './ProductAPI.js'

const api_url = './server/index.php';

let productAPI = new ProductAPI(api_url);


$(document).ready( () => {

        productAPI.fetchProducts().then( ( products ) => {
            let boxes = $('#boxes');

            for(let [product_id, product] of products) {
                boxes.append(`
                <div class="product">
                    <h3 class="title">${product._title}</h3>
                    <img src="${product._image}" alt="Image" />
                    <button class="clickme-btn" type="button" data-product-id="${product_id}">Click Me</button>
                </div>`);
            }
        }).catch((err) => {
            console.error(err);
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
    
    
    let product = productAPI._products.get(product_id);
    
    if (product !== undefined) {

        let popup_container = $('#popup .content');

        popup_container.html(`<p>${product._description}</p>`);

    } else {
        alert( "Something went wrong, Product not found." );
    }
});


$(document).on('click','#popup .close-btn, #overlay', (e) => {
    $('#overlay').toggle();
    $('#popup').toggle();
});



