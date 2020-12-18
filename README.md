[![Build Status](https://travis-ci.org/binarystash/pdf-watermarker.svg?branch=master)](https://travis-ci.org/binarystash/pdf-watermarker)

# PDF Watermarker
PDFWatermarker enables you to add an image as a watermark to existing PDF files. It uses FPDF that allows you to write PDF files and FPDI that allows you to import existing PDF documents into FPDF.

Using it, you can:

* Use jpg and png ( with alpha channels ) files with a 96 DPI resolution
* Easily position the watermark on the pages of the PDF file

## Installation

1. Place [composer.phar](https://getcomposer.org/composer.phar) in the folder you extracted the files to.

2. Run `php composer.phar install`

3. Include the files in your project. 

 There are 2 controllers 1 for insert in all pages and 1 for insert in a range 

* Insert in all pages 
``` php
<?php
use Watermarker\Domain\ValueObjects\PositionEnum;
use Watermarker\Infraestructure\Controllers\InsertWatermarkToFileController;
```
or 

* Insert in a range 
``` php
<?php
use Watermarker\Domain\ValueObjects\PositionEnum;
use Watermarker\Infraestructure\Controllers\InsertWatermarkToPageRangeController;
```

## Usage
* Insert in all pages 
``` php
<?php
    $inputFile="path to inputFile";
    $outputPath="path to outpuFile ";
    $watermarkPath="path to Image ";
    $position=PositionEnum::CENTER // Use this enum to select position, default is center
    $isBackground=False // Default is False
    $controller=new InsertWatermarkToFileController();
    $this->controller->execute($inputPath, $outputPath, $watermarkPath,$position,$isBackground);
?>
```
* Insert in a range 
``` php
<?php
    $inputFile="path to inputFile";
    $outputPath="path to outpuFile ";
    $watermarkPath="path to Image ";
    $position=PositionEnum::CENTER // Use this enum to select position, default is center
    $pageStart="page to start to insert watermark"
    $pageEnd="page to finish the rang"
    $isBackground=False // Default is False
    $controller=new InsertWatermarkToPageRangeController();
    $this->controller->execute($inputPath, $outputPath, $watermarkPath,$pageStart,$pageEnd,$position,$isBackground);
?>
```

Five positions can be used. 'center' is the default.
``` php
<?php
 PositionEnum::CENTER
 PositionEnum::TOPLEFT
 PositionEnum::TOPRIGHT
 PositionEnum::BOTTOMRIGHT
 PositionEnum::BOTTOMLEFT
?>
```



