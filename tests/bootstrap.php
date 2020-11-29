<?php

//Define constants
define( "PACKAGE_DIRECTORY", dirname( __DIR__ ) );

//Load composer packages
require PACKAGE_DIRECTORY . DIRECTORY_SEPARATOR . "vendor/autoload.php";

//Load project files
$classes = array(
	"Domain/pdfwatermark.php",
	"Domain/Interfaces/ImageWatermark.php",
	"Domain/Interfaces/PdfInsertWatermark.php",
	"Domain/Interfaces/PdfWrite.php",
	"pdfwatermarker.php",
	"Infraestructure/ImageWatermarkPNG.php",
	"Infraestructure/ImageWatermarkJPG.php",
	"Domain/value_objects/PositionEnum.php",
	"Infraestructure/FpdiPdf.php",
	"Domain/UseCases/insertAWatermark.php",
);

foreach( $classes as $class ) {
	require_once PACKAGE_DIRECTORY . DIRECTORY_SEPARATOR . "pdfwatermarker" . DIRECTORY_SEPARATOR . $class;
}
