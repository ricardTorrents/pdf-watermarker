<?php
final class DimensionsMm {

	private float $weight;
	private float $height;

	public function __construct(float $weight, float $height) {
		$this->weight = $weight;
		$this->height = $height;
		validateSizes();
	}

	public function getWeight(): float {
		return $this->weight;
	}

	public function getHeight(): float {
		return $this->height;
	}

	private function validateSizes(): void {
		validateSize($this->weight, "Weight");
		validateSize($this->height, "Height");
	}

	// TODO revisar!
	private function validateSize(float $value, string $orientation) {
		if ($value <= 0) {
			throw new Exception("$orientation need positive and not zero. But is: $value");
		}
	}
}
?>
