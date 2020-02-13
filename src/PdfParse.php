<?php
/**
 * Created by PhpStorm.
 * User: Иван
 * Date: 13.01.2020
 * Time: 12:28
 */

namespace creeone\FileToText;


use Smalot\PdfParser\Parser;

class PdfParse extends AbstractParse implements IFileToText
{

    public function parse()
    {
        $parser = new Parser();
        $pdf = $parser->parseFile($this->file);
        $pages = $pdf->getPages();
        foreach ($pages as $num => $page) {
            $this->createPage($page->getText());
        }

        return $this->getJSON();

    }
}