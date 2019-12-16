<?php
/**
 * Created by PhpStorm.
 * User: Creeone
 * Date: 22.11.2019
 * Time: 12:17
 */

namespace creeone\FileToText;

use PhpOffice\PhpWord\Element\TextRun;
use PhpOffice\PhpWord\Element\Text;
use PhpOffice\PhpWord\Element\Table;
use PhpOffice\PhpWord\IOFactory;

class DocxParse extends AbstractParse implements IFileToText
{

    protected $content = [];

    public function parse()
    {
        $phpWord = IOFactory::load($this->file);
        $sections = $phpWord->getSections();

        foreach ($sections as $value) {
            $sectionElements = $value->getElements();
            foreach ($sectionElements as $elementValue) {
                if ($elementValue instanceof TextRun) {
                    $this->getRegularText($elementValue);
                }
                if ($elementValue instanceof Table) {
                    $this->getTableText($elementValue);
                }
            }
        }
        $content = implode(' ', $this->content);
        $this->createPage($content);
        return $this->getJSON();
    }

    /**
     * Get text from section of word document
     * @param TextRun $element
     */
    protected function getRegularText(TextRun $element)
    {
        foreach ($element->getElements() as $elementValue) {
            if ($elementValue instanceof Text) {
                $this->content[] = $elementValue->getText();
            }
        }
    }

    /**
     * Get text from tables of word document
     * @param Table $element
     */
    protected function getTableText(Table $element)
    {
        foreach ($element->getRows() as $row) {
            foreach ($row->getCells() as $cell) {
                $cellElements = $cell->getElements();
                foreach ($cellElements as $cellElement) {
                    if ($cellElement instanceof TextRun) {
                        $this->getRegularText($cellElement);
                    }
                }
            }
        }
    }
}