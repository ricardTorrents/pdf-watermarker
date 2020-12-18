<?php

namespace Tests;

use PHPUnit\Framework\TestCase;
use Watermarker\Domain\Models\ImageWatermarkJPG;
use Watermarker\Domain\Models\ImageWatermarkPNG;

class ImageWatermarkTest extends TestCase
{
    private $assetsDirectory;
    private string $inputPathJPG;
    private string $inputPathPNG;
    private ImageWatermarkJPG $watermarkJPG;
    private ImageWatermarkPNG $watermarkPNG;

    protected function setUp(): void
    {
        $this->assetsDirectory = PACKAGE_DIRECTORY . DIRECTORY_SEPARATOR . "assets" . DIRECTORY_SEPARATOR;
        $this->inputPathJPG = $this->assetsDirectory . "star.jpg";
        $this->watermarkJPG = new ImageWatermarkJPG($this->inputPathJPG);
        $this->inputPathPNG = $this->assetsDirectory . "star.png";
        $this->watermarkPNG = new ImageWatermarkPNG($this->inputPathPNG);
        //$this->outputPath = $this->assetsDirectory . "test-output.pdf";
        //$this->inputPathMulti = $this->assetsDirectory . "test-multipage.pdf";
        //$this->outputPathMulti = $this->assetsDirectory . "test-output-multiple.pdf";
    }

    /** @test */
    public function get_file_path_jpg()
    {
        $this->assertTrue(file_exists($this->watermarkJPG->getFilePath()) == true);
    }

    /** @test */
    public function get_file_path_png()
    {
        $this->assertTrue(file_exists($this->watermarkPNG->getFilePath()) == true);
    }

    /** @test */
    public function get_dimensions_jpg()
    {
        //print_r(count(array_diff($this->watermarkJPG->getMMDimensions(), array(52.916666666667, 52.916666666667))));
        $this->assertTrue(count(array_diff($this->watermarkJPG->getMMDimensions(), array(200, 200))) === 0);
    }

    /** @test */
    public function get_dimensions_png()
    {
        //print_r(count(array_diff($this->watermarkPNG->getMMDimensions(), array(52.916666666667, 52.916666666667))));
        $this->assertTrue(count(array_diff($this->watermarkPNG->getMMDimensions(), array(200, 200))) === 0);
    }
}