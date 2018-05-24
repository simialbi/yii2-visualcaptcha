<?php
/**
 * @package yii2-visualcaptcha
 * @author Simon Karlen <simi.albi@gmail.com>
 */

namespace simialbi\yii2\visualcaptcha\controllers;

use yii\filters\ContentNegotiator;
use yii\web\Controller;
use yii\web\Response;

/**
 * Class CaptchaController
 * @package simialbi\yii2\visualcaptcha\controllers
 *
 * @property-read \simialbi\yii2\visualcaptcha\Module $module
 */
class CaptchaController extends Controller
{
    public function behaviors()
    {
        return [
            'contentNegotiator' => [
                'class' => ContentNegotiator::class,
                'formats' => [
                    'application/json' => Response::FORMAT_JSON
                ]
            ]
        ];
    }

    /**
     * @param integer $howMany
     * @return array
     */
    public function actionIndex($howMany = 5)
    {
        $captcha = $this->module->captcha;
        $captcha->generate($howMany);

        return $captcha->frontendData;
    }
}