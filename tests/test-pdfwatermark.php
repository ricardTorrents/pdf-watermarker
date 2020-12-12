`<?php

$parent_directory = dirname(__FILE__);

class PDFWatermark_test extends PHPUnit_Framework_TestCase
{
    public $watermark;
	public $output;
	public $imageWatermark;
	
	protected $_assets_directory;

    function setUp() {
	
		$this->_assets_directory = PACKAGE_DIRECTORY . DIRECTORY_SEPARATOR . "assets" . DIRECTORY_SEPARATOR;
		$this->$filepath=$this->_assets_directory . 'star.png';
		
		$this->imageWatermark=new ImageWatermarkPNG($this->$filepath);
        $this->watermark = PDFWatermark::contructCenterOverlay($this->imageWatermark);

    }
	
    public function testSetPosition() {
		$this->watermark->setPosition('bottomleft');
		$this->assertTrue( $this->watermark->getPosition() == 'bottomleft' );
    }
	
	public function testSetAsBackground() {
		$this->watermark->setAsBackground();
		$this->assertTrue( $this->watermark->usedAsBackground() === true );
	}
	
	public function testSetAsOverlay() {
		$this->watermark->setAsBackground();
		$this->watermark->setAsOverlay();
		$this->assertTrue( $this->watermark->usedAsBackground() === false );
	}
	
	public function testGetFilePath() {
		$this->assertTrue( file_exists($this->watermark->getFilePath()) === true );
	}
	
	
	public function testPrepareImagePng() {
		$class = new ReflectionClass('ImageWatermarkPNG');
		$method = $class->getMethod('prepareImage');
		$method->setAccessible(true);

  		$fileExtension = substr($method->invokeArgs($this->imageWatermark, [ $this->_assets_directory . 'star.png']), -4);

  		$this->assertSame('.png', $fileExtension);
	}

	public function testPrepareImageJpg() {
		$this->imageWatermark=new ImageWatermarkJPG($this->_assets_directory . 'star.jpg');
		$class = new ReflectionClass('ImageWatermarkJPG');
		$method = $class->getMethod('prepareImage');
		$method->setAccessible(true);

  		$fileExtension = substr($method->invokeArgs($this->imageWatermark, [ $this->_assets_directory . 'star.jpg']), -4);
		echo $fileExtension;
  		$this->assertSame('.jpg', $fileExtension);
	}

	
	
}
