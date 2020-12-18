<?php

namespace Watermarker\Domain\Models;

use Watermarker\Domain\Models\ImageWatermark;

class ImageWatermarkPNG extends ImageWatermark
{
    const IMAGETYPE_PNG = 3;

    public function prepareImage(string $filePath): string
    {
        $imagetype = exif_imagetype($filePath);
        if ($imagetype != self::IMAGETYPE_PNG) {
            throw new InvalidArgumentException("Unsupported image type");
        }
        $path = sys_get_temp_dir() . '/' . uniqid() . '.png';
        $image = imagecreatefrompng($filePath);
        imageinterlace($image, false);
        imagesavealpha($image, true);
        imagepng($image, $path);
        imagedestroy($image);
        return $path;
    }

}

?>
