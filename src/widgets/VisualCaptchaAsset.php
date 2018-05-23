<?php
/**
 * @package yii2-visualcaptcha
 * @author Simon Karlen <simi.albi@gmail.com>
 */

namespace simialbi\yii2\visualcaptcha\widgets;


use simialbi\yii2\web\AssetBundle;

class VisualCaptchaAsset extends AssetBundle
{
    /**
     * {@inheritdoc}
     */
    public $sourcePath = '@vendor/desirepath/visualcaptcha-frontend/dist';

    /**
     * {@inheritdoc}
     */
    public $css = [
        'visualcaptcha.css'
    ];

    /**
     * {@inheritdoc}
     */
    public $js = [
        'visualcaptcha.jquery.js'
    ];

    /**
     * {@inheritdoc}
     */
    public $depends = [
        'yii\web\JqueryAsset'
    ];
}