<?php

//Define constants
define( "PACKAGE_DIRECTORY", dirname( __DIR__ ) );

//Load composer packages
require PACKAGE_DIRECTORY . DIRECTORY_SEPARATOR . "vendor/autoload.php";

//Load project files
$classes = array(
	"Domain/Models/Pdfwatermark.php",

	"Domain/Interfaces/IPdfWatermark.php",
	"Domain/Interfaces/PdfInsertWatermark.php",
	"Domain/Interfaces/PDFRepository.php",
	"Domain/Models/ImageWatermarkPNG.php",
	"Domain/Models/ImageWatermarkJPG.php",
	"Domain/ValueObjects/PositionEnum.php",
	"Domain/ValueObjects/Coordinates.php",
	"Infraestructure/FpdiPdf.php",
	"Infraestructure/InsertWatermarkController.php",
	"Infraestructure/InsertWatermarkOnpecificPagesController.php",
	"Application/InsertAWatermark.php",
	"Application/InsertAWatermarkOnSpecificPages.php"
);

foreach( $classes as $class ) {
	require_once PACKAGE_DIRECTORY . DIRECTORY_SEPARATOR . "pdfwatermarker" . DIRECTORY_SEPARATOR . $class;
}
