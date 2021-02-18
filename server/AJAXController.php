<?php


abstract class AJAXController {

    public $server_request;

    function __construct(array $server_request) {
        $this->server_request = $server_request;
    }

    abstract public function handle();

}