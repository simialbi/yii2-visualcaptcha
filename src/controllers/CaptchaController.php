<?php
/**
 * @package yii2-visualcaptcha
 * @author Simon Karlen <simi.albi@gmail.com>
 */

namespace simialbi\yii2\visualcaptcha\controllers;

use Yii;
use yii\filters\AccessControl;
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
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::class,
                'rules' => [
                    [
                        'allow' => true,
                        'actions' => ['index'],
                        'matchCallback' => function () {
                            if (empty(Yii::$app->request->referrer)) {
                                return false;
                            }
                            $referrer = parse_url(Yii::$app->request->referrer, PHP_URL_HOST);
                            $host = Yii::$app->request->hostName;

                            return strcasecmp($referrer, $host) === 0;
                        }
                    ]
                ]
            ],
            'contentNegotiator' => [
                'class' => ContentNegotiator::class,
                'formats' => [
                    'application/json' => Response::FORMAT_JSON
                ]
            ]
        ];
    }

    /**
     * @param integer $howMany Number of options. This parameter is optional. Defaults to 5.
     * @param string|null $namespace string the value of the parameter sent to the server for the namespace,
     * if it's not set up, no namespace will be sent
     * @return array
     */
    public function actionIndex($howMany = 5, $namespace = null)
    {
        $captcha = $this->module->captcha;
        $captcha->namespace = $namespace;
        $captcha->generate($howMany);

        return $captcha->frontendData;
    }
}
