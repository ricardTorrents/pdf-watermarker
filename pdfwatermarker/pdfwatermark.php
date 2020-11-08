
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
	private $position;
	private $asBackground;
	
	/**
	 * Comentar si es mejor named constructor o valores default
	 */
	public function __construct(ImageWatermark $imageWatermark, string $position, bool $asbackground) {

		$this->$imageWatermark=$imageWatermark;
		$this->position = $position;
		$this->asBackground = $asbackground;
	}

	public static function contructCenterOverlay(ImageWatermark $imageWatermark):PDFWatermark 
	{
		return new self($imageWatermark,'center',false);
	}

	public function setPosition(string $position):void 
	{
		$this->position = $position;
	}

	public function setAsBackground():void
	{
		$this->asBackground = true;
	}
	
	public function setAsOverlay():void
	{
		$this->asBackground = false;
	}
	
	
	public function usedAsBackground():bool 
	{
		return $this->asBackground;
	}
	
	
	public function getPosition():string
	{
		return $this->position;
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