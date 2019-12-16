<?php
/**
 * Created by PhpStorm.
 * User: Иван
 * Date: 06.12.2019
 * Time: 17:59
 */

namespace creeone\FileToText;


use PhpOffice\PhpPresentation\IOFactory;
use PhpOffice\PhpPresentation\Shape\RichText;

class PptParse extends AbstractParse implements IFileToText
{

    public function parse()
    {
        $pptReader = IOFactory::createReader('PowerPoint97');
        $presentation = $pptReader->load($this->file);

        $slides = $presentation->getAllSlides();
        var_dump($slides);exit;


    }
}