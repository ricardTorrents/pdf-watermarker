<?php

namespace Watermarker\Domain\Factory;

use Exception;
use Watermarker\Domain\Interfaces\Image;
use Watermarker\Domain\Models\ImageWatermarkJPG;
use Watermarker\Domain\Models\ImageWatermarkPNG;

class ImageWatermarkFactory
{


    private function __construct()
    {
    }

    public static function build($filePath): Image
    {
        $imageType = exif_imagetype($filePath);
        switch ($imageType) {

            case IMAGETYPE_JPEG:
                return new ImageWatermarkJPG($filePath);
            case IMAGETYPE_PNG:
                return new ImageWatermarkPNG($filePath);
            default:
                throw new Exception("Unsupported image type");
        }
    }
}
