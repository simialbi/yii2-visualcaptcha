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
 * Class AudioController
 * @package simialbi\yii2\visualcaptcha\controllers
 *
 * @property-read \simialbi\yii2\visualcaptcha\Module $module
 */
class AudioController extends Controller
{
    /**
     * @param string $type Audio type. Defaults to mp3
     * @return \yii\web\Response
     * @throws NotFoundHttpException
     */
    public function actionIndex($type = 'mp3')
    {
        $captcha = $this->module->captcha;
        $audioOption = $captcha->validAudioOption;

        if (!$audioOption) {
            throw new NotFoundHttpException(Yii::t('yii', 'Page not found.'));
        }

        $audioFileName = ArrayHelper::getValue($audioOption, 'path', '');
        $audioFilePath = Yii::getAlias('@visualcaptcha/assets/audios/' . $audioFileName);

        if ($type === 'ogg') {
            $audioFileName = substr_replace($audioFileName, '.ogg', -4);
            $audioFilePath = substr_replace($audioFilePath, '.ogg', -4);
        }

        if (!file_exists($audioFilePath)) {
            throw new NotFoundHttpException(Yii::t('yii', 'Page not found.'));
        }

        return Yii::$app->response->sendFile($audioFilePath, $audioFileName, [
            'inline' => true
        ]);
    }
}