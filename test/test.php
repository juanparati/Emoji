<?php
require '../vendor/autoload.php';

use Juanparati\Emoji\Emoji;

foreach (\Juanparati\Emoji\EmojiDictionary::collection() as $k => $hex)
{
    echo $k . ': ' . Emoji::char($k) . '  ' . PHP_EOL;
}


