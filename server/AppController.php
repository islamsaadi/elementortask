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
            default:
                return $response;
        }
    }


    protected function fetchAllProducts() : array
    {
        $products = DB::getAll();

        return [
            'body'  => $products,
            'code'  => 200,
        ];
    }

}