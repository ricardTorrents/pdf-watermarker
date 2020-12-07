<?php

final class CreateWatermarkImage {
	
	private string $file;
	// createWatermarkImage

	public function __construct(string $file) {
		validatePath();
	}

	private function validatePath(): void {
		$result = file_exists($this->file);
		if ($result != 1) {
			throw new Exception("Image doesn't exist.");
		}
	}
}

?>
