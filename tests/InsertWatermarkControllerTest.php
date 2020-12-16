<?php

namespace Tests;

use PHPUnit\Framework\TestCase;
use Watermarker\Infraestructure\InsertWatermarkController;

class InsertWatermarkControllerTest extends TestCase
{
    protected $controller;
    protected $assetsDirectory;
    protected $inputPath;
    protected $outputPath;

    protected function setUp(): void
    {

        $this->controller = new InsertWatermarkController();
        $this->assetsDirectory = PACKAGE_DIRECTORY . DIRECTORY_SEPARATOR . "assets" . DIRECTORY_SEPARATOR;
        $this->inputPath = $this->assetsDirectory . "test.pdf";
        $this->outputPath = $this->assetsDirectory . "test-output.pdf";
    }


    public function testDefaultOptionsWithJPG()
    {

        $watermarkPath = $this->assetsDirectory . "star.jpg";
        $this->controller->insertAllPages($this->inputPath, $this->outputPath, $watermarkPath,);
        $this->assertTrue(file_exists($this->outputPath));
        $this->assertTrue(filesize($this->assetsDirectory . 'output-from-jpg.pdf') === filesize($this->outputPath));
    }

    public function testSpecificPages() {

        $watermarkPath = $this->assetsDirectory . "star.jpg";
        $this->controller->insertAllPages($this->inputPath, $this->outputPath, $watermarkPath,);
        $this->assertTrue(file_exists($this->outputPath));
        $this->assertTrue(filesize($this->assetsDirectory . 'output-multipage.pdf') === filesize($this->outputPath));

        $this->watermarker_multiple->setPageRange(3,5);
      }
}
