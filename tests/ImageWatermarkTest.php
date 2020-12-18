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

        $this->assertTrue(count(array_diff($this->watermarkJPG->getMMDimensions(), array(52.916666666667, 52.916666666667))) === 0);
    }

    /** @test */
    public function get_dimensions_png()
    {
       
        $this->assertTrue(count(array_diff($this->watermarkPNG->getMMDimensions(), array(52.916666666667, 52.916666666667))) === 0);
    }

    public function invalidImageType()
    {
        $input = $this->assetsDirectory . "star.tif";
        $this->assertTrue(new ImageWatermarkPNG($input)==="InvalidArgumentException: Unsupported image type");
    }
}