# Convert a pdf file to text (OCR)

This package provides an easy to work with class to convert pdf's to text. It internally uses Google Cloud Vision API. You need to create an API key and add it to your project's `.env` file as follows:

```
GOOGLE_VISION_PROJECTID=your-project-id
GOOGLE_APPLICATION_CREDENTIALS=/Path/To/Your/KeyFile.json
```

[Read about Google Cloud Vision API] (https://cloud.google.com/vision/)


## How to get service key
[Google Cloud Vision API Document](https://cloud.google.com/vision/docs/getting-started)

## Requirements

You should have [Imagick](http://php.net/manual/en/imagick.setresolution.php) and [Ghostscript](http://www.ghostscript.com/) installed.

## Install

The package can be installed via composer:
``` bash
$ composer require nizarp/pdf-vision
```

## Usage

Converting a pdf to text is easy.

```php
$pdf = new Pdf($pathToPdf);
$pdf->setEnvPath('/path/to/env/.env');
echo $pdf->convertToText();
```

## Security

If you discover any security related issues, please email nizarp@gmail.com instead of using the issue tracker.

## Credits

- [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
