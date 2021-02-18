<?php

require_once 'AJAXController.php';
require_once 'DB.php';

class AppController extends AJAXController {

    public function handle()
    {
        $uri = parse_url($this->server_request['REQUEST_URI'], PHP_URL_PATH);

        $params = [];
        parse_str($this->server_request['QUERY_STRING'], $params);

        return $this->router($uri, $params);

    }

    protected function router(string $uri, array $params ) : array
    {
        $response = [
            'body'      => 'Not Found',
            'code'      => 404,
        ];

        if ( !isset($params['path']) ) {
            return $response;
        }

        switch ($params['path']) {
            case 'fetch-products':
                return $this->fetchAllProducts();
                break;
            case 'get-product-description-by-id':
                return $this->getProdcutDecriptionById($params);
                break;
            
            default:
                return $response;
                break;
        }
    }


    protected function fetchAllProducts() : array
    {
        $products = DB::getAll();

        $data = array_map(function($elm) {
                    return [
                        'id'       => $elm['id'],
                        'title'    => $elm['title'],
                        'image'    => $elm['image'],
                    ];
                }, $products);

        return [
            'body'  => $data,
            'code'  => 200,
        ];
    }

    protected function getProdcutDecriptionById(array $params) : array
    {
        if ( !isset($params['id']) || empty($params['id']) ) {
            return [
                'body'  => 'Not Found.',
                'code'  => 404,
            ];
        }

        $data = DB::getById($params['id']);
        if( empty($data) ) {
            return [
                'body'  => 'Not Found.',
                'code'  => 404,
            ];
        }

        return [
            'body'  => $data['description'],
            'code'  => 200,
        ];

    }

}