<?php
use setasign\Fpdi\Fpdi;
/**
 * pdfwatermarker.php
 * 
 * This class applies PDFWatermark to the file
 * @author Binarystash <binarystash01@gmail.com>
 * @version 1.1.1
 * @license https://opensource.org/licenses/MIT MIT
 */

class PDFWatermarker {
	
	private $_originalPdf;
	private $_newPdf;
	private $_tempPdf;
	private $_watermark;
	private $_specificPages;
	
	public function __construct(string $originalPdfPath,string $newPdfPath,PDFWatermark $watermark)
	{
		
		$this->_originalPdf = $originalPdfpath;
		$this->_newPdf = $newPdfPath;
		$this->_tempPdf = new FPDI();
		$this->_watermark = $watermark;
		$this->_specificPages = array();
		
		
		$this->_validateAssets();
	}

	
	private function _validateAssets():void {
		
		if ( !file_exists( $this->_originalPdf ) ) {
			throw new Exception("Inputted PDF file doesn't exist");
		}
		else if ( !file_exists( $this->_watermark->getFilePath() ) ) {
			throw new Exception("Watermark doesn't exist.");
		}
		
	}
	

	private function _updatePDF():void {
		
		$totalPages = $this->_getTotalPages();
		
		for($ctr = 1; $ctr <= $totalPages; $ctr++){
			
			$this->_importPage($ctr);
			
			if ( in_array($ctr, $this->_specificPages ) || empty( $this->_specificPages ) ) {
				$this->_watermarkOnSpecificPage($ctr);
			}
			else {
				$this->_watermarkOnSpecificPage($ctr, false);
			}
			
		}
		
	}
	
	
	private function _getTotalPages():int {
		return $this->_tempPdf->setSourceFile($this->_originalPdf);
	}

	private function _importPage(int $page_number):void {
		
		$templateId = $this->_tempPdf->importPage($page_number);
		$templateDimension = $this->_tempPdf->getTemplateSize($templateId);
		
		if ( $templateDimension['w'] > $templateDimension['h'] ) {
			$orientation = "L";
		}
		else {
			$orientation = "P";
		}
		
		$this->_tempPdf->addPage($orientation,array($templateDimension['w'],$templateDimension['h']));
		
	}
	

	private function _watermarkOnSpecificPage(int $page_number, bool $watermark_visible = true):void {
		
		$templateId = $this->_tempPdf->importPage($page_number);
		$templateDimension = $this->_tempPdf->getTemplateSize($templateId);
		
		$wWidth = ($this->_watermark->getWidth() / 96) * 25.4; //in mm
		$wHeight = ($this->_watermark->getHeight() / 96) * 25.4; //in mm
		
		$watermarkCoords = $this->_calculateWatermarkCoordinates( 	$wWidth, 
																	$wHeight, 
																	$templateDimension['w'], 
																	$templateDimension['h']);
							
		if ( $watermark_visible ) {
			if ( $this->_watermark->usedAsBackground() ) {															
				$this->_tempPdf->Image($this->_watermark->getFilePath(),$watermarkCoords[0],$watermarkCoords[1],-96);
				$this->_tempPdf->useTemplate($templateId);
			}
			else {
				$this->_tempPdf->useTemplate($templateId);
				$this->_tempPdf->Image($this->_watermark->getFilePath(),$watermarkCoords[0],$watermarkCoords[1],-96);
			}
		}
		else {
			$this->_tempPdf->useTemplate($templateId);
		}
		
	}
	

	private function _calculateWatermarkCoordinates( int $wWidth, int $wHeight, int $tWidth, int $tHeight ):array {
		
		switch( $this->_watermark->getPosition() ) {
			case 'topleft': 
				$x = 0;
				$y = 0;
				break;
			case 'topright':
				$x = $tWidth - $wWidth;
				$y = 0;
				break;
			case 'bottomright':
				$x = $tWidth - $wWidth;
				$y = $tHeight - $wHeight;
				break;
			case 'bottomleft':
				$x = 0;
				$y = $tHeight - $wHeight;
				break;
			default:
				$x = ( $tWidth - $wWidth ) / 2 ;
				$y = ( $tHeight - $wHeight ) / 2 ;
				break;
		}
		
		return array($x,$y);
	}
	
	
	public function setPageRange(int $startPage=1, int $endPage=null):void{
		
		$end = $endPage !== null ? $endPage : $this->_getTotalPages();
		
		$this->_specificPages = array();
		
		for ($ctr = $startPage; $ctr <= $end; $ctr++ ) {
			$this->_specificPages[] = $ctr;
		}
		
	}
	 
	public function savePdf():void {
		$this->_updatePDF();
		$this->_tempPdf->Output("F",$this->_newPdf);
	}
}
?>
