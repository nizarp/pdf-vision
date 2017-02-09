<?php
namespace Nizarp\PdfVision\Test;

require_once __DIR__ . '/../vendor/autoload.php';
date_default_timezone_set('America/Los_Angeles');

use Nizarp\PdfVision\Pdf;

$pdf = new Pdf('/Users/qbuser/Downloads/TextPdf.pdf');
$pdf->setEnvPath('/path/to/env/.env');
echo $pdf->convertToText();

