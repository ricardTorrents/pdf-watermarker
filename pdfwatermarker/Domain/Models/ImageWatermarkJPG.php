<?php
require_once 'pdfwatermarker/Domain/Models/ImageWatermark.php';
class ImageWatermarkJPG extends ImageWatermark
{
    const IMAGETYPE_JPG = 2;
    
    public function prepareImage(string $filePath): string
    {
        $imagetype = exif_imagetype($filePath);
        if ($imagetype != self::IMAGETYPE_JPG) {
            throw new InvalidArgumentException("Unsupported image type");
        }
        $path = sys_get_temp_dir() . '/' . uniqid() . '.jpg';
        $image = imagecreatefromjpeg($filePath);
        imageinterlace($image, false);
        imagejpeg($image, $path);
        imagedestroy($image);
        return $path;
    }

}

?>
