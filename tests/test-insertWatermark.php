<?php

$parent_directory = dirname(__FILE__);

class InsertWatermark_test extends PHPUnit_Framework_TestCase
{
    public $watermark;
	public $output;
    public $imageWatermark;
    public $inputPdf;
    public $insertWatermark;
    

	
	protected $_assets_directory;

    function setUp() {
	
		$this->_assets_directory = PACKAGE_DIRECTORY . DIRECTORY_SEPARATOR . "assets" . DIRECTORY_SEPARATOR;
	    $filepath=$this->_assets_directory . 'star.png';
        $input = $this->_assets_directory."test.pdf";
        $output =  $this->_assets_directory . "test-output.pdf";
        $InsertWatermark = InsertWatermarkController::insertWatermarkPNG($input, $output,$filepath,PositionEnum::CENTER,false);
        $InsertWatermark->insert();
    }
	
    public function testInsertWatermark() {
        $this->assertTrue( file_exists($this->_assets_directory . "test-output-multiline.pdf") === true );
    }
	

}
