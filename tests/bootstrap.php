<?php

//Define constants
define( "PACKAGE_DIRECTORY", dirname( __DIR__ ) );

//Load composer packages
require PACKAGE_DIRECTORY . DIRECTORY_SEPARATOR . "vendor/autoload.php";

//Load project files
$classes = array(
	"models/pdfwatermark.php",
	"pdfwatermarker.php",
	"models/ImageWatermark.php",
	"models/value_objects/PositionEnum.php",
	"repositoris/FpdiPdfRepository.php",
	"insertAWatermark.php"
);

foreach( $classes as $class ) {
	require_once PACKAGE_DIRECTORY . DIRECTORY_SEPARATOR . "pdfwatermarker" . DIRECTORY_SEPARATOR . $class;
}
