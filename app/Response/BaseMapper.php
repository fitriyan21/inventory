<?php


namespace App\Response;


abstract class BaseMapper
{
    public function list($items) {
        $result = [];
        foreach($items as $item) {
            $result[] = $this->single($item);
        }
        return $result;
    }

    abstract function single($item);
}
