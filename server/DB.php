<?php

class DB {

    private static $data = [
        [ "id" => 1, "title" => 'P1', "image" => '/images/im1.webp', "description"  => 'p1 description' ],
        [ "id" => 2, "title" => 'P2', "image" => '/images/im2.jpeg', "description"  => 'p2 description' ],
        [ "id" => 3, "title" => 'P3', "image" => '/images/im3.png', "description"   => 'p3 description' ],
    ];


    public static function getAll() : array
    {
        return self::$data;
    }

    public static function getById(int $id) : array
    {

        foreach ( self::$data as $i => $product ) {
            if( $product['id'] == $id ) return $product;
        }
        
        return [];

    }

}