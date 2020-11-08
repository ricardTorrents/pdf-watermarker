
<?php
class ImageWatermark {
	private $file;
	private $height;
    private $width;

    public function __construct(string $filePath) {
        $this->file = $this->_prepareImage($filePath);
        $this->_getImageSize( $this->file );


    }

    private function _getImageSize(string $image):void {
		$is = getimagesize($image);
		$this->width = $is[0];
		$this->height = $is[1];
	}
	
    private function preparePng(string $filePath):string 
    {
        $path =  sys_get_temp_dir() . '/' . uniqid() . '.png';
		$image = imagecreatefrompng($filePath);
		imageinterlace($image,false);
		imagesavealpha($image,true);
		imagepng($image, $path);
        imagedestroy($image);
        return $path;

    }
    private function prepareJpg(string $filePath):string 
    {
        $path =  sys_get_temp_dir() . '/' . uniqid() . '.jpg'; 
        $image = imagecreatefromjpeg($filePath);
        imageinterlace($image,false);
        imagejpeg($image, $path);
        imagedestroy($image);
        return $path;

    }
    private function _prepareImage(string $filePath):string 
	{
		$imagetype = exif_imagetype( $filePath );
		switch( $imagetype ) {
			case IMAGETYPE_JPEG:
                $path=$this->prepareJpg($filePath);
                break;
				
			case IMAGETYPE_PNG:
                $path=$this->preparePng($filePath);
				break;
			default:
				throw new Exception("Unsupported image type");
				break;
		};
		return $path;
    }
    
    public function getFilePath():string 
	{
		return $this->file;
	}
    public function getWith():int 
    {
        return $this->width;
    }
    public function getHeight():int 
    {
        return $this->height;
    }

}