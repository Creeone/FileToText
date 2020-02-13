[![GitHub tag](https://img.shields.io/github/tag/creeone/FileToText.svg)](https://GitHub.com/creeone/FileToText/tags/)
# FileToText
Convert All type of file to JSON for Elastic Search

#allow extensions
* txt
* csv
* doc/docx
* xls/xlsx
* pptx
* pdf
* xml
* html

#Usage
```php
$parser = new creeone\FileToText\FileToText('file.txt');
echo $parser->parse();
```
