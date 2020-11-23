<?php
include('ImageWatermark.php');
class PNGImageWatermark implements ImageWatermark 
{
	private $file;
	private $height;
    private $width;

    public function __construct(string $filePath) {
        $this->file = $this->prepareImage($filePath);
        $this->vaildatePath();
        $this->_getImageSize( $this->file );

    }
    private function vaildatePath():void
    {   
        $result=file_exists( $this->file );
        if ( $result !=1 ) {
			throw new Exception("Image doesn't exist.");
        }
        
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
    

  
    public function prepareImage(string $filePath):string 
	{
        $imagetype = exif_imagetype( $filePath );
        if( $imagetype != IMAGETYPE_PNG ){
            throw new Exception("Unsupported image type");
        }
        $path=$this->preparePng($filePath);
		
		return $path;
    }
    
    public function getFilePath():string 
	{
		return $this->file;
	}
    public function getWidth():int 
    {
        return $this->width;
    }
    public function getHeight():int 
    {
        return $this->height;
    }

}
?>
