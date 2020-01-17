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

            foreach ($sectionElements as $elementValue) {
                if ($elementValue instanceof Text) {
                    $text = $this->getEncodingText($elementValue->getText());
                    $content[] = $text;
                }
            }
        }

        $content = implode(' ', $content);
        $this->createPage($content);
        return $this->getJSON();
    }

    protected function isASCII($text)
    {
        return mb_detect_encoding($text) === 'ASCII';
    }

    protected function getEncodingText($text)
    {
        if ($this->isASCII($text)) {
            return $text;
        }

        return iconv('Windows-1251','UTF-8', iconv('UTF-16','CP1251', $text));
    }

}