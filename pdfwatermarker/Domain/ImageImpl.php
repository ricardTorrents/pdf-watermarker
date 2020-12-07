<?php
final class ImageImpl implements Image {

	private string $file;
	private DimensionsMm $dimensions;
	private const IMAGE_DPI = 96;
	private const DPI_TO_MM = 25.4;

	public function __construct(string $file) {
		$this->file = $file;
		$this->validatePath();
		$this->dimensions = $this->getImageDimensions();
	}

	public function getFilePath(): string {
		return $this->file;
	}

	public function getDimensions(): DimensionsMm {
		return $this->dimensions;
	}

	private function validatePath(): void {
		$result = file_exists($this->file);
		if ($result != 1) {
			throw new Exception("Image doesn't exist.");
		}
	}

	private function getImageDimensions(): DimensionsMm {
		$is = getimagesize($this->file);
		return DimensionsMm($this->pixelsToMm($is[0]), $this->pixelsToMm($is[1]));
	}

	private function pixelsToMm(int $pixel): float {
		return ($pixel / self::IMAGE_DPI) * self::DPI_TO_MM;
	}
}
?>
