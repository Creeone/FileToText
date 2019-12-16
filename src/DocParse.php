<?php
/**
 * Created by PhpStorm.
 * User: Creeone
 * Date: 22.11.2019
 * Time: 12:17
 */

namespace creeone\FileToText;

use PhpOffice\PhpWord\IOFactory;
use PhpOffice\PhpWord\Element\Text;

class DocParse extends AbstractParse implements IFileToText
{

    public function parse()
    {
        $phpWord = IOFactory::load($this->file, 'MsDoc');
        $sections = $phpWord->getSections();
        $content = [];

        foreach ($sections as $value) {
            $sectionElements = $value->getElements();

            //TODO кодирвока utf-8 .doc
            foreach ($sectionElements as $elementValue) {
                if ($elementValue instanceof Text) {
                    $content[] = $elementValue->getText();
                }
            }
        }

        $content = implode(' ', $content);
        $this->createPage($content);
        return $this->getJSON();
    }

}