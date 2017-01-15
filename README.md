php-line-notify
========
[![Build Status](https://travis-ci.org/kittinan/php-line-notify.svg?branch=master)](https://travis-ci.org/kittinan/php-line-notify)
[![Code Coverage](https://scrutinizer-ci.com/g/kittinan/php-line-notify/badges/coverage.png?b=master)](https://scrutinizer-ci.com/g/kittinan/php-line-notify/?branch=master)
[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/kittinan/php-line-notify/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/kittinan/php-line-notify/?branch=master)
[![License](https://poser.pugx.org/kittinan/php-line-notify/license.svg)](https://packagist.org/packages/kittinan/php-line-notify)

Line Notify with PHP 

[Line Notify Document] (https://notify-bot.line.me/doc/en/)



## Requirement
* PHP 5.5+
* [guzzlehttp] (https://github.com/guzzle/guzzle)

## Composer

Install the latest version with composer require kittinan/php-line-notify

This plugin on the Packagist.

[https://packagist.org/packages/kittinan/php-line-notify](https://packagist.org/packages/kittinan/php-line-notify)

##Generate Line Notify Token

[https://notify-bot.line.me/my/] (https://notify-bot.line.me/my/)

## Usage
*Example : notify text message*
```php
$token = 'YOUR LINE NOTIFY TOKEN';
$ln = new KS\Line\LineNotify($token);

$text = 'Hello Line Notify';
$ln->sendText($text);
```

*Example : notify text with image*
```php
$text = 'Hello Line Notify';
$image_path = '/YOUR/IMAGE/PATH'; //Line notify allow only jpeg and png file
$ln->sendText($text);
```


License
=======
The MIT License (MIT)
