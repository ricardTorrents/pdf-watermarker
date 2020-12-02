<?php
include('../Domain/ImageWatermark.php');

class ImageWatermarkPNG extends ImageWatermark
{

    public function prepareImage(string $filePath): string
    {
        $imagetype = exif_imagetype($filePath);
        if ($imagetype != IMAGETYPE_PNG) {
            throw new Exception("Unsupported image type");
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
