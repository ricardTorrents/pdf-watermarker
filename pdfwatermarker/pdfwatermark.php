
<?php
//position 'center','topright', 'topleft', 'bottomright', 'bottomleft'
/**
 * pdfwatermark.php
 * 
 * This class defines properties of a watermark
 * @author Binarystash <binarystash01@gmail.com>
 * @version 1.1.1
 * @license https://opensource.org/licenses/MIT MIT
 */

class PDFWatermark {

	private $imageWatermark;
	private $_position;
	private $_asBackground;
	

	public function __construct(ImageWatermark $imageWatermark, string $position, bool $asbackground) {

		$this->$imageWatermark=$imageWatermark;
		$this->_position = $position;
		$this->_asBackground = $asbackground;
	}
	
	public static function contructCenterOverlay(ImageWatermark $imageWatermark):PDFWatermark 
	{
		return new self($imageWatermark,'center',false);
	}
	

	

	
	public function setPosition(string $position):void 
	{
		$this->_position = $position;
	}
	

	public function setAsBackground():void
	{
		$this->_asBackground = true;
	}
	

	public function setAsOverlay():void
	{
		$this->_asBackground = false;
	}
	
	
	public function usedAsBackground():bool 
	{
		return $this->_asBackground;
	}
	
	
	public function getPosition():string
	{
		return $this->_position;
	}

	public function getFilePath():string 
	{
		return $this->imageWatermark->getFilePath();
	}
	

	public function getHeight():int 
	{
		return $this->imageWatermark->getHeight();
	}
	


	public function getWidth():int 
	{
		return $this->imageWatermark->getWidth();
	}
}