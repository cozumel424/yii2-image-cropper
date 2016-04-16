<?php

/**
 * @copyright Copyright (c) 2016 cozumel
 * @link https://github.com/cozumel424/yii2-image-cropper
 * @license http://www.opensource.org/licenses/bsd-license.php New BSD License
 */

namespace cozumel\cropper;

use yii\web\AssetBundle;

class ImageCropperAsset extends AssetBundle {

    public $sourcePath = '@vendor/cozumel/yii2-image-cropper/assets';
    public $depends = [
        'yii\web\YiiAsset',
        'yii\web\JqueryAsset'
    ];

    public function init() {
        $this->css[] = 'css/imgareaselect-default.css';
        $this->js[] = 'js/jquery.imgareaselect.pack.js';
        $this->js[] = 'js/jquery.crop.js';
    }

}