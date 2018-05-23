<?php
/**
 * @package yii2-visualcaptcha
 * @author Simon Karlen <simi.albi@gmail.com>
 */

namespace simialbi\yii2\visualcaptcha\controllers;

use Yii;
use yii\filters\ContentNegotiator;
use yii\helpers\ArrayHelper;
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

    /**
     * Try captcha code
     */
    public function actionTry()
    {
        $captcha = $this->module->captcha;
        $frontendData = $captcha->frontendData;
        $params = [];

        if (!$frontendData) {
            $params['status'] = 'noCaptcha';
        } else {
            if ($imageAnswer = Yii::$app->request->getBodyParam(ArrayHelper::getValue($frontendData,
                'imageFieldName'))) {
                if ($captcha->validateImage($imageAnswer)) {
                    $params['status'] = 'validImage';
                } else {
                    $params['status'] = 'failedImage';
                }
            } elseif ($audioAnswer = Yii::$app->request->getBodyParam(ArrayHelper::getValue($frontendData,
                'audioFieldName'))) {
                if ($captcha->validateAudio($audioAnswer)) {
                    $params['status'] = 'validAudio';
                } else {
                    $params['status'] = 'failedAudio';
                }
            } else {
                $params['status'] = 'failedPost';
            }

            $howMany = count($captcha->sessionImageOptions);
            $captcha->generate($howMany);
        }

        array_unshift($params, Yii::$app->user->returnUrl);

        return $this->redirect($params);
    }
}