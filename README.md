# Emoji 

## What is it?

A lightweight PHP 5.4.x-7.x and HHVM library that help you to print your unicode Emojis on console or a html document.

## How to use it?

### Print on console

        use Juanparati\Emoji\Emoji;
        
        echo Emoji::char('grinning face') . '  or  ' . Emoji::char(':D');
        

### Print on html document
 
        use Juanparati\Emoji\Emoji;
        
        echo Emoji::html('monkey face');
        

### Emoji list

Emojis are referenced by name. 

A full list of all unicode emojis with their names are available at:
http://unicode.org/emoji/charts/full-emoji-list.html

For example if you want to print a beer mug, just type:

        echo Emoji::char('beer mug')    // Print on console

or 

        echo Emoji:html('beer mug')     // Print on html document
        

### How to install it

        composer require juanparati/emoji
        
