<?php

/**
 * @copyright Copyright (c) 2016 cozumel
 * @link https://github.com/cozumel424/yii2-image-cropper
 * @license http://www.opensource.org/licenses/bsd-license.php New BSD License
 */

namespace cozumel\cropper;

/**
 * This is just an example.
 */
class ImageCropper extends \yii\base\Widget {
    /**
     * @var array the options for the imgAreaSelect plugin.
     * Please refer to the imgAreaSelect Web page for possible options.
     * @see http://odyniec.net/projects/imgareaselect/usage.html
     */

    /**
     * @var type the id of the containing image
     */
    public $id = 'user_profile_photo';

    /**
     * @var string of the form "width:height" which represents the aspect ratio to maintain example: "4:3"
     */
    public $aspectRatio = '1:1';

    /**
     * @var boolean If set to true, selection area will disappear when selection ends
     *  default: false
     */
    public $autoHide = false;

    /**
     * @var type A string that is prepended to class names assigned to plugin elements 
     * default: "imgareaselect"
     */
    public $classPrefix = 'imgareaselect';

    /**
     * @var type boolean If set to true, the plugin is disabled (the selection area remains visible, unless hide is also present) 
     */
    public $disable;

    /**
     * @var type boolean If set to true, the plugin is re-enabled 
     */
    public $enable;

    /**
     * @var type boolean If set to a number greater than zero, showing or hiding the plugin is done with a graceful fade in/fade out animation
     * default: false
     */
    public $fadeSpeed;

    /**
     * @var type If set to true, resize handles are shown on the selection area; if set to "corners", only corner handles are shown
     *  default: true
     */
    public $handles = true;

    /**
     * @var type If set to true, selection area is hidden 
     */
    public $hide;

    /**
     * @var type True height of the image (if scaled with the CSS width and height properties) 
     */
    public $imageHeight;

    /**
     * @var type True width of the image (if scaled with the CSS width and height properties) 
     */
    public $imageWidth;

    /**
     * @var type If set to true, the imgAreaSelect() call returns a reference to an instance of imgAreaSelect bound to the image, allowing you to use its API methods
     */
    public $instance;

    /**
     * @var type Enables/disables keyboard support (see below for details) 
     * default: false
     */
    public $keys = false;

    /**
     * @var type Maximum selection height (in pixels) 
     */
    public $maxHeight;

    /**
     * @var type Maximum selection width (in pixels) 
     */
    public $maxWidth;

    /**
     * @var type Minimum selection height (in pixels) 
     */
    public $minHeight;

    /**
     * @var type Minimum selection width (in pixels) 
     */
    public $minWidth;

    /**
     * @var type Determines whether the selection area should be movable
     *  default: true
     */
    public $movable = true;

    /**
     * @var type  A jQuery object or selector string that specifies the parent element that the plugin will be appended to
     *  default: "body"
     */
    public $parent = 'body';

    /**
     * @var type If set to true, clicking outside the selection area will not start a new selection (ie. the user will only be able to move/resize the existing selection area)
     * default: false
     */
    public $persistent = false;

    /**
     * @var type If set to true, the plugin is completely removed If set to true, the plugin is completely removed 
     */
    public $remove;

    /**
     * @var type Determines whether the selection area should be resizable
     * default: true
     */
    public $resizable = true;

    /**
     * @var type Width (in pixels) of the selection area margin where resize mode is triggered 
     */
    public $resizeMargin;

    /**
     * @var type If set to true, selection area is shown
     * default: true 
     */
    public $show = true;

    /**
     * @var type Coordinates of the top left corner of the initial selection area 
     */
    public $x1;

    /**
     * @var type Coordinates of the top left corner of the initial selection area 
     */
    public $y1;

    /**
     * @var type Coordinates of the bottom right corner of the initial selection area 
     */
    public $x2;

    /**
     * @var type Coordinates of the bottom right corner of the initial selection area 
     */
    public $y2;

    /**
     * @var type The z-index value to be assigned to plugin elements; normally, imgAreaSelect figures it out automatically, 
     * but there are a few cases when it's necessary to set it explicitly 
     */
    public $zIndex;

    /**
     * @var type Callback function called when the plugin is initialized
     */
    public $onInit;

    /**
     * @var type Callback function called when selection starts
     */
    public $onSelectStart;

    /**
     * @var type Callback function called when selection changes
     * default 'preview'
     */
    public $onSelectChange = 'preview';

    /**
     * @var type Callback function called when selection ends
     */
    public $onSelectEnd;

    public function run() {
        $jsOptions = [
            'aspectRatio' => $this->aspectRatio,
            'autoHide' => $this->autoHide,
            'classPrefix' => $this->classPrefix,
            'disable' => $this->disable,
            'enable' => $this->enable,
            'fadeSpeed' => $this->fadeSpeed,
            'handles' => $this->handles,
            'hide' => $this->hide,
            'imageHeight' => $this->imageHeight,
            'imageWidth' => $this->imageWidth,
            'instance' => $this->instance,
            'keys' => $this->keys,
            'maxHeight' => $this->maxHeight,
            'maxWidth' => $this->maxWidth,
            'minHeight' => $this->minHeight,
            'minWidth' => $this->minWidth,
            'movable' => $this->movable,
            'parent' => $this->parent,
            'persistent' => $this->persistent,
            'remove' => $this->remove,
            'resizable' => $this->resizable,
            'resizeMargin' => $this->resizeMargin,
            'show' => $this->show,
            'x1' => $this->x1,
            'y1' => $this->y1,
            'x2' => $this->x2,
            'y2' => $this->y2,
            'zIndex' => $this->zIndex,
            'onInit' => $this->onInit,
            'onSelectStart' => $this->onSelectStart,
            'onSelectChange' => $this->onSelectChange,
            'onSelectEnd' => $this->onSelectEnd,
        ];

        //remove any unset values
        $jsOptions = (array_filter($jsOptions, function($v) {
                    return $v !== null;
                }));

        $this->registerPlugin($jsOptions);

        return;
    }

    protected function registerPlugin($options) {
        $view = $this->getView();
        ImageCropperAsset::register($view);

        $id = $this->id;

        $options = json_encode($options);

        //better way to do this? let me know!
        $options = str_replace('"' . $this->onInit . '"', $this->onInit, $options);
        $options = str_replace('"' . $this->onSelectStart . '"', $this->onSelectStart, $options);
        $options = str_replace('"' . $this->onSelectChange . '"', $this->onSelectChange, $options);
        $options = str_replace('"' . $this->onSelectEnd . '"', $this->onSelectEnd, $options);

        $view->registerJs("jQuery('#{$id}').imgAreaSelect(" . $options . ");");
    }

}