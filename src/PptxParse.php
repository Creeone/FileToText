<?php
/**
 * Created by PhpStorm.
 * User: Иван
 * Date: 06.12.2019
 * Time: 15:49
 */

namespace creeone\FileToText;


use PhpOffice\PhpPresentation\IOFactory;
use PhpOffice\PhpPresentation\Shape\RichText;

class PptxParse extends AbstractParse implements IFileToText
{

    public function parse()
    {
        $pptReader = IOFactory::createReader('PowerPoint2007');
        $presentation = $pptReader->load($this->file);
        $slides = $presentation->getAllSlides();
        foreach ($slides as $slide) {
            $content = [];
            $shapes = $slide->getShapeCollection();
            foreach ($shapes as $shape) {
                if ($shape instanceof RichText) {
                    $paragraphs = $shape->getParagraphs();
                    foreach ($paragraphs as $paragraph) {
                        $textElements = $paragraph->getRichTextElements();
                        foreach ($textElements as $textElement) {
                            $content[] = $textElement->getText();
                        }
                    }
                }
            }
            $text = implode(' ', $content);
            $this->createPage($text);
        }

        return $this->getJSON();
    }
}