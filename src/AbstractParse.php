<?php
/**
 * Created by PhpStorm.
 * User: Creeone
 * Date: 19.11.2019
 * Time: 17:11
 */

namespace creeone\FileToText;

abstract class AbstractParse
{
    protected $data = [];
    protected $page = 1;
    protected $file;

    public function getJSON(){
        return json_encode($this->data, JSON_UNESCAPED_UNICODE);
    }

    public function createPage($text, $pageName = null){
        if ($pageName) {
            $this->data[$pageName] = $text;
            return true;
        }
        $this->data[$this->page] = $text;
        $this->page++;
        return true;
    }

    public function __construct($file)
    {
        $this->file = $file;
    }
}