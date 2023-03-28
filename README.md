
# free-google-translate

Simple PHP library for talking to Google's Translate API for free.

Eliminates IP request limitations

## Installation

Install this package via [Composer](https://getcomposer.org/).

```
composer require ILYAGVC/free-google-translate
```

Or edit your project's `composer.json` to require ILYAGVC/free-google-translate` and then run `composer update`.

```json
"require": {
    "ILYAGVC/free-google-translate": "^1.0.0"
}
```

## Usage

```php
require __DIR__ . 'vendor/autoload.php';
use \ILYAGVC/free-google-translate;

$result = TranslateGoogleFree::Translate("Hello, how are you?", "en", "fa");
if ($result[1] == null) {
    echo $result[0]; // سلام، حال شما چطور است؟
} else {
    echo $result[1]->getMessage();
}
```
