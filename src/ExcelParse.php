<?php
/**
 * Created by PhpStorm.
 * User: Иван
 * Date: 05.12.2019
 * Time: 12:40
 */

namespace creeone\FileToText;


use PhpOffice\PhpSpreadsheet\IOFactory;

class ExcelParse extends AbstractParse implements IFileToText
{

    public function parse()
    {
        $extension = ucfirst(pathinfo($this->file, PATHINFO_EXTENSION));
        $reader = IOFactory::createReader($extension);
        $reader->setReadDataOnly(true);
        $spreadsheet = $reader->load($this->file);

        $sheetNames = $spreadsheet->getSheetNames();

        foreach ($sheetNames as $sheet) {
            $content = [];
            $workSheet = $spreadsheet->getSheetByName($sheet);


            foreach ($workSheet->getRowIterator() as $row) {
                $cellIterator = $row->getCellIterator();
                $cellIterator->setIterateOnlyExistingCells(false);

                foreach ($cellIterator as $cell) {
                    if (!empty($cell->getValue())) {
                        $content[] = $cell->getValue();
                    }
                }
            }
            $this->createPage(implode(' ', $content), $sheet);
        }

        return $this->getJSON();
    }
}