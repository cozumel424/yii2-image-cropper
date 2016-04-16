Yii2 Image Cropper
==================

[![Latest Stable Version](https://poser.pugx.org/cozumel/yii2-image-cropper/v/stable)](https://packagist.org/packages/cozumel/yii2-image-cropper) 
[![Total Downloads](https://poser.pugx.org/cozumel/yii2-image-cropper/downloads)](https://packagist.org/packages/cozumel/yii2-image-cropper) 
[![License](https://poser.pugx.org/cozumel/yii2-image-cropper/license)](https://packagist.org/packages/cozumel/yii2-image-cropper)

A simple wrapper for the [imgAreaSelect](http://odyniec.net/projects/imgareaselect/) jquery plugin

Installation
------------

The preferred way to install this extension is through [composer](http://getcomposer.org/download/).

Either run

```
php composer.phar require --prefer-dist cozumel/yii2-image-cropper "*"
```

or add

```
"cozumel/yii2-image-cropper": "*"
```

to the require section of your `composer.json` file.


Usage
-----

Once the extension is installed, simply use it in your code by  :

```php
<?= \cozumel\cropper\ImageCropper::widget(); ?>```