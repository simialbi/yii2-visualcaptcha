<?php
/**
 * @package yii2-visualcaptcha
 * @author Simon Karlen <simi.albi@gmail.com>
 */

namespace simialbi\yii2\visualcaptcha;

use simialbi\yii2\web\AssetBundle;

/**
 * Visual Captcha Asset bundle
 */
class VisualCaptchaAsset extends AssetBundle
{
    /**
     * {@inheritdoc}
     */
    public $sourcePath = '@vendor/simialbi/yii2-visualcaptcha/src/assets';

    /**
     * {@inheritdoc}
     */
    public $css = [
        'css/visualcaptcha.css'
    ];

    /**
     * {@inheritdoc}
     */
    public $js = [
        'js/visualcaptcha.jquery.min.js'
    ];

    /**
     * {@inheritdoc}
     */
    public $depends = [
        'yii\web\JqueryAsset'
    ];
}