<?php
/**
 * Created by PhpStorm.
 * User: Creeone
 * Date: 19.11.2019
 * Time: 17:33
 */

namespace creeone\FileToText;

class CsvParse extends AbstractParse implements IFileToText
{
    public function parse()
    {
        $content = file_get_contents($this->file);
        $this->createPage($content);
        return $this->getJSON();
    }
}