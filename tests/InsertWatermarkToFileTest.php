<?php

namespace Tests;

use PHPUnit\Framework\TestCase;
use Watermarker\Domain\ValueObjects\PositionEnum;
use Watermarker\Infraestructure\Controllers\InsertWatermarkToFileController;

class InsertWatermarkToFileTest extends TestCase
{
    protected $controller;
    protected $assetsDirectory;
    protected $inputPath;
    protected $outputPath;
    protected $inputPathMulti;
    protected $outputPathMulti;

    protected function setUp(): void
    {
        $this->controller = new InsertWatermarkToFileController();
        $this->assetsDirectory = PACKAGE_DIRECTORY . DIRECTORY_SEPARATOR . "assets" . DIRECTORY_SEPARATOR;
        $this->inputPath = $this->assetsDirectory . "test.pdf";
        $this->outputPath = $this->assetsDirectory . "test-output.pdf";
        $this->inputPathMulti = $this->assetsDirectory . "test-multipage.pdf";
        $this->outputPathMulti = $this->assetsDirectory . "test-output-multiple.pdf";
    }

    public function testDefaultOptionsWithJPG()
    {
        $watermarkPath = $this->assetsDirectory . "star.jpg";
        $this->controller->execute($this->inputPath, $this->outputPath, $watermarkPath);
        $this->assertTrue(file_exists($this->outputPath));
        $this->assertTrue(filesize($this->assetsDirectory . 'output-from-jpg.pdf') === filesize($this->outputPath));
    }

    public function testTopRightPosition()
    {

        $watermarkPath = $this->assetsDirectory . "star.png";
        $this->controller->execute($this->inputPath, $this->outputPath, $watermarkPath, PositionEnum::TOPRIGHT);
        $this->assertTrue(file_exists($this->outputPath));
        $this->assertTrue(filesize($this->assetsDirectory . 'output-topright-position.pdf') === filesize($this->outputPath));
    }

    public function testTopLeftPosition()
    {
        $watermarkPath = $this->assetsDirectory . "star.png";
        $this->controller->execute($this->inputPath, $this->outputPath, $watermarkPath, PositionEnum::TOPLEFT);
        $this->assertTrue(file_exists($this->outputPath));
        $this->assertTrue(filesize($this->assetsDirectory . 'output-topleft-position.pdf') === filesize($this->outputPath));
    }

    public function testBottomRightPosition()
    {
        $watermarkPath = $this->assetsDirectory . "star.png";
        $this->controller->execute($this->inputPath, $this->outputPath, $watermarkPath, PositionEnum::BOTTOMRIGHT);
        $this->assertTrue(file_exists($this->outputPath));
        $this->assertTrue(filesize($this->assetsDirectory . 'output-bottomright-position.pdf') === filesize($this->outputPath));

    }

    public function testBottomLeftPosition()
    {
        $watermarkPath = $this->assetsDirectory . "star.png";
        $this->controller->execute($this->inputPath, $this->outputPath, $watermarkPath, PositionEnum::BOTTOMLEFT);
        $this->assertTrue(file_exists($this->outputPath));
        $this->assertTrue(filesize($this->assetsDirectory . 'output-bottomleft-position.pdf') === filesize($this->outputPath));
    }

    public function testAsBackground()
    {
        $watermarkPath = $this->assetsDirectory . "star.png";
        $this->controller->execute($this->inputPath, $this->outputPath, $watermarkPath, PositionEnum::CENTER, true);
        $this->assertTrue(file_exists($this->outputPath));
        $this->assertTrue(filesize($this->assetsDirectory . 'output-as-background.pdf') === filesize($this->outputPath));
    }
}
