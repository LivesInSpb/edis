<?php

$phpVersion = 7;
echo PHP_MAJOR_VERSION === $phpVersion ? "ok. php version is 7+" : "Please update PHP! Need php 7.0+";

use library\classes\CsvReader;
use library\classes\XmlReader;

require('vendor/autoload.php');

$fileCsv = 'files/excel.csv';
$fileXml1 = "files/xmlFirst.xml";
$fileXml2 = "files/xmlSecond.xml";

$obj = new CsvReader($fileCsv);
$obj->readFile();

echo $obj->view();

$objXml1 = new XmlReader($fileXml1, (string)'xml1');
$objXml1->readFile();
echo $objXml1->view();

$objXml1 = new XmlReader($fileXml2, (string)'xml2');
$objXml1->readFile();
echo $objXml1->view();
