<?php

use setasign\Fpdi\Fpdi;

class PDFWatermarker {

	private string $originalPdf;
	private string $newPdf;
	private FPDI $tempPdf;
	private PDFWatermark $watermark;
	private array $specificPages;

	public function __construct(string $originalPdf, string $newPdf, PDFWatermark $watermark) {

		$this->originalPdf = $originalPdf;
		$this->newPdf = $newPdf;
		$this->tempPdf = new FPDI();
		$this->watermark = $watermark;
		$this->specificPages = array();


		$this->validateAssets();
	}

	private function validateAssets() : void {

		if (!file_exists($this->originalPdf)) {
			throw new Exception("Inputted PDF file doesn't exist");
		}
		else if (!file_exists($this->watermark->getFilePath())) {
			throw new Exception("Watermark doesn't exist.");
		}

	}

	private function updatePDF() : void {

		$totalPages = $this->getTotalPages();

		for($ctr = 1; $ctr <= $totalPages; $ctr++){

			$this->importPage($ctr);

			if (in_array($ctr, $this->specificPages) || empty($this->specificPages)) {
				$this->watermarkPage($ctr);
			}
			else {
				$this->watermarkPage($ctr, false);
			}

		}

	}

	private function getTotalPages() : int {
		return $this->tempPdf->setSourceFile($this->originalPdf);
	}

	private function importPage(int $page_number) {

		$templateId = $this->tempPdf->importPage($page_number);
		$templateDimension = $this->tempPdf->getTemplateSize($templateId);

		if ($templateDimension['width'] > $templateDimension['height']) {
			$orientation = "L";
		}
		else {
			$orientation = "P";
		}

		$this->tempPdf->addPage($orientation, array($templateDimension['width'], $templateDimension['height']));

	}

	private function watermarkPage(int $page_number, bool $watermark_visible = true) {

		$templateId = $this->tempPdf->importPage($page_number);
		$templateDimension = $this->tempPdf->getTemplateSize($templateId);

		$wWidth = ($this->watermark->getWidth() / 96) * 25.4; //in mm
		$wHeight = ($this->watermark->getHeight() / 96) * 25.4; //in mm

		$watermarkCoords = $this->calculateWatermarkCoordinates( 	$wWidth,
																	$wHeight,
																	$templateDimension['width'],
																	$templateDimension['height']);

		if ($watermark_visible) {
			if ($this->watermark->usedAsBackground()) {
				$this->tempPdf->Image($this->watermark->getFilePath(), $watermarkCoords[0], $watermarkCoords[1], -96);
				$this->tempPdf->useTemplate($templateId);
			}
			else {
				$this->tempPdf->useTemplate($templateId);
				$this->tempPdf->Image($this->watermark->getFilePath(), $watermarkCoords[0], $watermarkCoords[1], -96);
			}
		}
		else {
			$this->tempPdf->useTemplate($templateId);
		}

	}

	private function calculateWatermarkCoordinates(float $wWidth, float $wHeight, float $tWidth, float $tHeight) : array {

		switch($this->watermark->getPosition()) {
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
				$x = ($tWidth - $wWidth) / 2 ;
				$y = ($tHeight - $wHeight) / 2 ;
				break;
		}

		return array($x, $y);
	}

	public function setPageRange(int $startPage=1, int $endPage=null) : void {

		$end = $endPage !== null ? $endPage : $this->getTotalPages();

		$this->specificPages = array();

		for ($ctr = $startPage; $ctr <= $end; $ctr++) {
			$this->specificPages[] = $ctr;
		}

	}

	public function savePdf() : void {
		$this->updatePDF();
		$this->tempPdf->Output("F", $this->newPdf);
	}
}
?>
