 Magento 2 Gravatar Extension
==========================

This extension implements [Gravatar](http://en.gravatar.com/) service in Magento 2!
This module uses customer e-mail for generating Gravatar URL and it is complatible with Magento 2.

 ## Requirements
    Magento 2.0+
    
 ## How to use
Installation is pretty eas just use [Composer](https://getcomposer.org/) for it and viola!

There is optional Block code that you can use in templates:
```php
echo Matej\Gravatar\Helper\Data::getCustomerAvatarByMail($email);
echo Matej\Gravatar\Helper\Data::getCustomerAvatarById($customer_id);
```
It automatically create block and put Gravatar URL (use those echo's for images src)!

You can use custom PHP code for creating Gravatar URL based on custom params:

```php
$url = $this
    ->setGravatarSize(80)                           // Optional (default is 80)
    ->setGravatarSecured(false)                     // Optional (default is false)
    ->setGravatarDefaultImage('identico', false)    // Optional (default is mm)
    ->setGravatarRating('g')                        // Optional (default is g)
    ->getGravatarURL('example@example.com');
echo $url;
// Prints out: http://www.gravatar.com/avatar/55502f40dc8b7c769880b10874abc9d0?s=60&r=g&d=mm
```
That's all!
