<?php
namespace Nizarp\PdfVision\Test;
ini_set('display_errors', 1);

use Nizarp\PdfVision\Pdf;
use PHPUnit\Framework\TestCase;
use Predis\Client;

class pdfVisionTest extends TestCase
{
	/**
     * @var string
     */
    protected $testFile;

    /**
     * Declare Path to test files
     *
     */
    public function setUp()
    {
        parent::setUp();
        $this->blank = __DIR__.'/files/blank.pdf';
        $this->single_page = __DIR__.'/files/single_page.pdf';
        $this->multiple_page = __DIR__.'/files/multiple_page.pdf';
        $this->blank_ocr = __DIR__.'/files/blank_ocr.pdf';
        $this->single_page_ocr = __DIR__.'/files/single_page_ocr.pdf';
        $this->multiple_page_ocr = __DIR__.'/files/multiple_page_ocr.pdf';
    }

    /** @test */
    public function should_throw_an_exception_when_try_to_convert_a_non_existing_file()
    {
        $this->expectExceptionMessage('PDF file does not exist!');
        new Pdf('pdfdoesnotexists.pdf');
    }

    /** @test */
    public function should_throw_an_exception_when_a_non_existing_env_file_is_set()
    {
        $this->expectExceptionMessage('Unable to read the environment file at /invalid/env/path/.env.');
        $pdf = new Pdf($this->single_page);
        $pdf->setEnvPath('/invalid/env/path/.env');
    }

    /** @test */
    public function should_throw_an_exception_when_pdf_file_is_empty()
    {

        $this->expectExceptionMessage('PDF file is empty!');
        
        $pdf = new Pdf($this->blank);
        $pdf->setEnvPath(__DIR__ . '/../.env');
        $pdf->convertToText();
    }

    /** @test */
    public function should_return_text_from_single_page_text_pdf()
    {
        $expectedText = "This is the first page text.\nHeading\n";

        $client = new Client();        

        // Retrieve date from cache if it exists
        if(!is_null($client->get('single_page'))) {
            $value = $client->get('single_page');

        } else {
            $pdf = new Pdf($this->single_page);
            $pdf->setEnvPath(__DIR__ . '/../.env');
            $value = $pdf->convertToText();

            // Update value to cache
            $client->set('single_page', $value);
        }

        $this->assertEquals(
            $expectedText,
            $value
        );
    }

    /** @test */
    public function should_return_text_from_multiple_page_text_pdf()
    {
        $expectedText = "This is the first page text.\nHeading\n This is the second page text\n";
       
        $client = new Client();        

        // Retrieve date from cache if it exists
        if(!is_null($client->get('multiple_page'))) {
            $value = $client->get('multiple_page');

        } else {
            $pdf = new Pdf($this->multiple_page);
            $pdf->setEnvPath(__DIR__ . '/../.env');
            $value = $pdf->convertToText();

            // Update value to cache
            $client->set('multiple_page', $value);
        }

        $this->assertEquals(
            $expectedText,
            $value
        );
    }

    /** @test */
    public function should_throw_an_exception_when_pdf_file_is_empty_image()
    {

        $this->expectExceptionMessage('PDF file is empty!');
        
        $pdf = new Pdf($this->blank_ocr);
        $pdf->setEnvPath(__DIR__ . '/../.env');
        $pdf->convertToText();
    }

    /** @test */
    public function should_return_text_from_single_page_image_pdf()
    {
        $expectedText = "This is the first page text.\nHeading\n";

        $client = new Client();        

        // Retrieve date from cache if it exists
        if(!is_null($client->get('single_page_ocr'))) {
            $value = $client->get('single_page_ocr');

        } else {
            $pdf = new Pdf($this->single_page_ocr);
            $pdf->setEnvPath(__DIR__ . '/../.env');
            $value = $pdf->convertToText();

            // Update value to cache
            $client->set('single_page_ocr', $value);
        }

        $this->assertEquals(
            $expectedText,
            $value
        );
    }

    /** @test */
    public function should_return_text_from_multiple_page_image_pdf()
    {
        $expectedText = "This is the first page text.\nHeading\n This is the second page text\n";
       
        $client = new Client();        

        // Retrieve date from cache if it exists
        if(!is_null($client->get('multiple_page_ocr'))) {
            $value = $client->get('multiple_page_ocr');

        } else {
            $pdf = new Pdf($this->multiple_page_ocr);
            $pdf->setEnvPath(__DIR__ . '/../.env');
            $value = $pdf->convertToText();

            // Update value to cache
            $client->set('multiple_page_ocr', $value);
        }

        $this->assertEquals(
            $expectedText,
            $value
        );
    }
}
