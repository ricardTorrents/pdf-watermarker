<?php

namespace Tests;

use PHPUnit\Framework\TestCase;
use Watermarker\Domain\ValueObjects\PositionEnum;
use Watermarker\Infraestructure\Controllers\InsertWatermarkToPageRangeController;

class InsertWatermarkToPageRangeTest extends TestCase
{
    protected $controller;
    protected $assetsDirectory;
    protected $inputPath;
    protected $outputPath;
    protected $inputPathMulti;
    protected $outputPathMulti;

    protected function setUp(): void
    {
        $this->controller = new InsertWatermarkToPageRangeController();
        $this->assetsDirectory = PACKAGE_DIRECTORY . DIRECTORY_SEPARATOR . "assets" . DIRECTORY_SEPARATOR;
        $this->inputPath = $this->assetsDirectory . "test.pdf";
        $this->outputPath = $this->assetsDirectory . "test-output.pdf";
        $this->inputPathMulti = $this->assetsDirectory . "test-multipage.pdf";
        $this->outputPathMulti = $this->assetsDirectory . "test-output-multiple.pdf";
    }

    public function testSpecificPages()
    {

        $watermarkPath = $this->assetsDirectory . "star.png";
        $this->controller->execute($this->inputPathMulti, $this->outputPathMulti, $watermarkPath, 3, 5);
        $this->assertTrue(file_exists($this->outputPathMulti));
        printf(filesize($this->assetsDirectory . 'output-multipage.pdf'));
        printf(' - ');
        printf(filesize($this->outputPathMulti));
        $this->assertTrue(filesize($this->assetsDirectory . 'output-multipage.pdf') === filesize($this->outputPathMulti));
    }

    public function testTopRightPositionRange()
    {
        $watermarkPath = $this->assetsDirectory . "star.png";
        $this->controller->execute($this->inputPathMulti, $this->outputPathMulti, $watermarkPath, 1, 3, PositionEnum::TOPRIGHT);
        $this->assertTrue(file_exists($this->outputPathMulti));
        $this->assertTrue(filesize($this->assetsDirectory . 'output-topright-position-range.pdf') === filesize($this->outputPathMulti));
    }

    public function testTopLeftPositionRange()
    {
        $watermarkPath = $this->assetsDirectory . "star.png";
        $this->controller->execute($this->inputPathMulti, $this->outputPathMulti, $watermarkPath, 1, 3, PositionEnum::TOPLEFT);
        $this->assertTrue(file_exists($this->outputPathMulti));
        $this->assertTrue(filesize($this->assetsDirectory . 'output-topleft-position-range.pdf') === filesize($this->outputPathMulti));
    }

    public function testBottomRightPositionRange()
    {

        $watermarkPath = $this->assetsDirectory . "star.png";
        $this->controller->execute($this->inputPathMulti, $this->outputPathMulti, $watermarkPath, 4, 5, PositionEnum::BOTTOMRIGHT);
        $this->assertTrue(file_exists($this->outputPathMulti));
        $this->assertTrue(filesize($this->assetsDirectory . 'output-bottomRight-position-range.pdf') === filesize($this->outputPathMulti));


    }

    public function testBottomLeftPosition()
    {

        $watermarkPath = $this->assetsDirectory . "star.png";
        $this->controller->execute($this->inputPathMulti, $this->outputPathMulti, $watermarkPath, 1, 1, PositionEnum::BOTTOMLEFT);
        $this->assertTrue(file_exists($this->outputPathMulti));
        $this->assertTrue(filesize($this->assetsDirectory . 'output-bottomleft-position-range.pdf') === filesize($this->outputPathMulti));
    }
}
