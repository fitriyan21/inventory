<?php


namespace App\Response;


interface MapperContract
{
    public function single($item);

    public function list($items);
}
