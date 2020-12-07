<?php

class PDFWatermark {

	private string $file;
	private int $height;
	private int $width;
	private string $position;
	private bool $asBackground;

	function __construct(string $file) {

		$this->file = $this->prepareImage($file);
		$this->getImageSize($this->file);

		$this->position = 'center';
		$this->asBackground = false;
	}

	private function prepareImage(string $file) : string {

		$imagetype = exif_imagetype($file);

		switch($imagetype) {

			case IMAGETYPE_JPEG:
				$path =  sys_get_temp_dir() . '/' . uniqid() . '.jpg';
				$image = imagecreatefromjpeg($file);
				imageinterlace($image, false);
				imagejpeg($image, $path);
				imagedestroy($image);
				break;

			case IMAGETYPE_PNG:
				$path =  sys_get_temp_dir() . '/' . uniqid() . '.png';
				$image = imagecreatefrompng($file);
				imageinterlace($image, false);
				imagesavealpha($image, true);
				imagepng($image, $path);
				imagedestroy($image);
				break;
			default:
				throw new Exception("Unsupported image type");
				break;
		};

		return $path;

	}

	private function getImageSize(string $image) : void {
		$is = getimagesize($image);
		$this->width = $is[0];
		$this->height = $is[1];
	}

	public function setPosition(string $position) : void {
		$this->position = $position;
	}

	public function setAsBackground() : void {
		$this->asBackground = true;
	}

	public function setAsOverlay() : void {
		$this->asBackground = false;
	}

	public function usedAsBackground() : bool {
		return $this->asBackground;
	}

	public function getPosition() : string {
		return $this->position;
	}

	public function getFilePath() : string {
		return $this->file;
	}

	public function getHeight() : int {
		return $this->height;
	}

	public function getWidth() : int {
		return $this->width;
	}
}
