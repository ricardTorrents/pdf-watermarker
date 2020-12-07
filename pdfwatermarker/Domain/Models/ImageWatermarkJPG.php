<?php
include('ImageWatermark.php');

class ImageWatermarkJPG extends ImageWatermark
{

    public function prepareImage(string $filePath): string
    {
        $imagetype = exif_imagetype($filePath);
        if ($imagetype != IMAGETYPE_JPG) {
            throw new Exception("Unsupported image type");
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
