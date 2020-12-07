<?php

//Define constants
define( "PACKAGE_DIRECTORY", dirname( __DIR__ ) );

//Load composer packages
require PACKAGE_DIRECTORY . DIRECTORY_SEPARATOR . "vendor/autoload.php";

//Load project files
$classes = array(
	"Application/CreateWatermarkImage.php",
	"Domain/DimensionsMm.php",
	"Domain/Image.php",
	"Domain/ImageImpl.php",
	"pdfwatermark.php",
	"pdfwatermarker.php",
);

foreach( $classes as $class ) {
	require_once PACKAGE_DIRECTORY . DIRECTORY_SEPARATOR . "pdfwatermarker" . DIRECTORY_SEPARATOR . $class;
}
