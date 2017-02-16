<?php
require_once __DIR__ . '/../vendor/autoload.php';
date_default_timezone_set('America/Los_Angeles');
use Nizarp\PdfVision\Pdf;

$pdf = new Pdf($argv[1]);

//$pdf->setEnvPath('/path/to/env/.env');
$pdf->setEnvPath(__DIR__ . '/../.env');

echo $pdf->convertToText();

