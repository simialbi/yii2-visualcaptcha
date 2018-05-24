<?php
/**
 * @package yii2-visualcaptcha
 * @author Simon Karlen <simi.albi@gmail.com>
 */

namespace simialbi\yii2\visualcaptcha\controllers;


use Yii;
use yii\helpers\ArrayHelper;
use yii\web\Controller;
use yii\web\NotFoundHttpException;

/**
 * Class ImageController
 * @package simialbi\yii2\visualcaptcha\controllers
 *
 * @property-read \simialbi\yii2\visualcaptcha\Module $module
 */
class ImageController extends Controller
{
    /**
     * @param integer $index
     * @param boolean $retina
     * @param string|null $namespace string the value of the parameter sent to the server for the namespace,
     * if it's not set up, no namespace will be sent
     * @return \yii\web\Response
     *
     * @throws NotFoundHttpException
     * @throws \yii\web\RangeNotSatisfiableHttpException
     */
    public function actionIndex($index, $retina = false, $namespace = null)
    {
        $captcha = $this->module->captcha;
        $captcha->namespace = $namespace;
        $imageOption = ArrayHelper::getValue($captcha->sessionImageOptions, $index);

        if (!$imageOption) {
            throw new NotFoundHttpException(Yii::t('yii', 'Page not found.'));
        }

        $imageFileName = ArrayHelper::getValue($imageOption, 'path', '');
        $imageFilePath = Yii::getAlias('@visualcaptcha/assets/images/' . $imageFileName);

        if ($retina) {
            $imageFileName = substr_replace($imageFileName, '@2x.png', -4);
            $imageFilePath = substr_replace($imageFilePath, '@2x.png', -4);
        }

        if (!file_exists($imageFilePath)) {
            throw new NotFoundHttpException(Yii::t('yii', 'Page not found.'));
        }

        $img = $captcha->getImage($imageFilePath);

        return Yii::$app->response->sendContentAsFile($img, $imageFileName, [
            'inline' => true
        ]);
    }
}