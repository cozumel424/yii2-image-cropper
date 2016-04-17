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
<?= \cozumel\cropper\ImageCropper::widget(); ?>
```

Example
-----

View File:
```php
<?= \cozumel\cropper\ImageCropper::widget(['id' => 'user_profile_photo']); ?>
```
Where `user_profile_photo` is the id of the image to use.

Html in view file:

The main image you will be cropping:
```html
<img width="<?= $width; ?>" height="<?= $height; ?>" max-width="<?=$max_width;?>" class="border" id="user_profile_photo" alt="<?=alt_text;?>" src="<?= image_source; ?>">
```
The preview image:
(the ids here are fixed, and the 75px must be stated but can be changed)
```html
<div style="display:none;" id="js_photo_preview">
  <strong>Preview:</strong>
    <div class="p_2">
      <div id="js_profile_photo_preview_container" style="position:relative; overflow:hidden; width:75px; height:75px; border:1px #000 solid;">
        <img width="<?= $width; ?>" height="<?= $height; ?>" class="border" id="js_profile_photo_preview" alt="<?=$alt_text;?>" src="<?= $image_source; ?>" style="">
      </div>		
  </div>
</div>

```
The form to send the information to your controller:
```html
<?php
$form = ActiveForm::begin(['action' => Yii::$app->urlManager->createUrl(['your/url/here']), 'options' => ['id' => 'crop_form'],
]);
?>
<div><input type="hidden" id="x1" value="" name="x1"></div>
<div><input type="hidden" id="y1" value="" name="y1"></div>
<div><input type="hidden" id="x2" value="" name="x2"></div>
<div><input type="hidden" id="y2" value="" name="y2"></div>
<div><input type="hidden" id="w" value="" name="w"></div>
<div><input type="hidden" id="h" value="" name="h"></div>
<div><input type="hidden" value="<?= $width; ?>" name="image_width"></div>
<div><input type="hidden" value="<?= $height; ?>" name="image_height"></div>				
<div style="margin-top:10px;">
<input type="submit" class="button" id="js_save_profile_photo" value="Save Avatar">
</div>

<?php ActiveForm::end(); ?>
```
Javascript to submit the form:
```javascript
$(document).ready(function () {

//sends crop info from user/photo
    $(document.body).on('submit', '#crop_form', function (e) {

        var frm = $(this); //just sent text

        $.ajax({
            type: frm.attr('method'),
            url: frm.attr('action'),
            dataType: 'json',
            data: frm.serialize(),
            success: function (data) {

                if (data) {

                   //do something
                }
            },
        });
        return false;
    });


});
```

Your controller function:
```php
$request = Yii::$app->request;

$x1 = $request->post('x1');
$x2 = $request->post('x2');
$y1 = $request->post('y1');
$y2 = $request->post('y2');

$h = $request->post('h');
$w = $request->post('w');

$image_height = $request->post('image_height');
$image_width = $request->post('image_width');

if (empty($w)) {
  //nothing selected
  return;
}
$image = imagecreatefromjpeg($profile_picture);

$width = imagesx($image);
$height = imagesy($image);

$resized_width = ((int) $x2) - ((int) $x1);
$resized_height = ((int) $y2) - ((int) $y1);

 $resized_image = imagecreatetruecolor($resized_width, $resized_height);
 imagecopyresampled($resized_image, $image, 0, 0, (int) $x1, (int) $y1, $width, $height, $width, $height);
 imagejpeg($resized_image, $profile_picture);
 ```
 

