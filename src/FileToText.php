<?php
/**
 * Created by PhpStorm.
 * User: Creeone
 * Date: 19.11.2019
 * Time: 16:58
 */

namespace creeone\FileToText;

class FileToText
{
    public $file;
    public $ext;
    private $parser;

    public function __construct($file)
    {
        $this->file = $file;
        $this->ext = strtolower(pathinfo($this->file, PATHINFO_EXTENSION));
        switch ($this->ext){
            case 'txt':
                $this->parser = new TxtParse($this->file);
                break;
            case 'csv':
                $this->parser = new CsvParse($this->file);
                break;
            case 'docx':
                $this->parser = new DocxParse($this->file);
                break;
            case 'doc':
                $this->parser = new DocParse($this->file);
                break;
            case 'xlsx':
            case 'xls':
                $this->parser = new ExcelParse($this->file);
                break;
            case 'pptx':
                $this->parser = new PptxParse($this->file);
                break;
            case 'ppt':
                //$this->parser = new PptParse($this->file);
                throw new \Exception('ppt is not avaliable');
                break;
            case 'pdf':
                $this->parser = new PdfParse($this->file);
                break;
            case 'xml':
                $this->parser = new XmlParse($this->file);
                break;
            case 'html':
                $this->parser = new HtmlParse($this->file);
                break;
            default:
                throw new \Exception("Неподходящий тип файла");
        }
    }

    public function parse(){
        return $this->parser->parse();
    }
}