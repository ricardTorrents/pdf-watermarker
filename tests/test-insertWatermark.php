<?php

$parent_directory = dirname(__FILE__);

class INSERTWATERMARK_test extends PHPUnit_Framework_TestCase
{
    public $watermark;
	public $output;
    public $imageWatermark;
    public $inputPdf;
    public $insertWatermark;
    

	
	protected $_assets_directory;

    function setUp() {
	
		// $this->_assets_directory = PACKAGE_DIRECTORY . DIRECTORY_SEPARATOR . "assets" . DIRECTORY_SEPARATOR;
		// $filepath=$this->_assets_directory . 'star.png';
		// $this->imageWatermark=new ImageWatermarkPNG($filepath);
        // $this->watermark = PDFWatermark::contructCenterOverlay($this->imageWatermark);
        // $input = $this->_assets_directory."test-multipage.pdf";
        // $this->output =  $this->_assets_directory . "test-output-multiline.pdf";
        // $this->inputPdf = FpdiPdf::pdf($input);
        // $this->insertWatermark = new InsertAWatermark($this->inputPdf,$this->watermark);
        // $outPutPdf=$this->insertWatermark->insert();
        // $this->$outPutPdf->writeOnFile($this->output);

    }
	
    // public function testInsertWatermark() {
    //     $this->assertTrue( file_exists($this->output) === true );
    // }
	

}