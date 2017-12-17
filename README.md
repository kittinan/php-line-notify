php-line-notify
========
[![Build Status](https://travis-ci.org/kittinan/php-line-notify.svg?branch=master)](https://travis-ci.org/kittinan/php-line-notify)
[![Code Coverage](https://scrutinizer-ci.com/g/kittinan/php-line-notify/badges/coverage.png?b=master)](https://scrutinizer-ci.com/g/kittinan/php-line-notify/?branch=master)
[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/kittinan/php-line-notify/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/kittinan/php-line-notify/?branch=master)
[![License: MIT](https://img.shields.io/badge/License-MIT-yellow.svg)](https://opensource.org/licenses/MIT)

Simple PHP Line Notify Class

[Line Notify Document](https://notify-bot.line.me/doc/en/)



## Requirement
* PHP 5.5+
* [guzzlehttp](https://github.com/guzzle/guzzle)

## Composer

Install the latest version with composer

```
composer require kittinan/php-line-notify
```

[https://packagist.org/packages/kittinan/php-line-notify](https://packagist.org/packages/kittinan/php-line-notify)

## Generate Line Notify Token

[https://notify-bot.line.me/my/](https://notify-bot.line.me/my/)

## Usage
*Example : notify text message*
```php
$token = 'YOUR LINE NOTIFY TOKEN';
$ln = new KS\Line\LineNotify($token);

$text = 'Hello Line Notify';
$ln->send($text);
```

*Example : notify text with image*

```php
$text = 'Hello Line Notify';
$image_path = '/YOUR/IMAGE/PATH'; //Line notify allow only jpeg and png file
$ln->send($text, $image_path);

//HTTP or HTTPS image path
$image_path = 'https://lorempixel.com/800/600/'; //Line notify allow only jpeg and png file
$ln->send($text, $image_path);

```

*Example : notify text with sticker*

See sticker list [https://devdocs.line.me/files/sticker_list.pdf](https://devdocs.line.me/files/sticker_list.pdf)

```php
$text = 'Hello Sticker';
$sticker = ['stickerPackageId' => '1', 'stickerId' => '401'];
$ln->send($text, null, $sticker);
```

## Screenshot
![Screenshot](/screenshot/screen2.png?raw=true "Screenshot")


License
=======
The MIT License (MIT)
