import Product from './Product.js'

export default class ProductAPI {

    constructor ( api_url ) {
        this._api_url   = api_url
        this._products  = new Map()
    }
    
    fetchProducts () {
        return new Promise ( (resolve, reject) => {
            $.get( `${this._api_url}?path=fetch-products`, (resp) => {
                let body = JSON.parse(resp).body;
    
                for(let product of body) {
                    this._products.set(product.id, new Product(product.id, product.title, product.image, product.description));
                }

                resolve(this._products);
    
            }).fail( (err) => {
                reject(err);
            });
        });
    }
}