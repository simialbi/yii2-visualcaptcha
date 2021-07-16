<?php
/**
 * @package yii2-visualcaptcha
 * @author Simon Karlen <simi.albi@gmail.com>
 */

namespace simialbi\yii2\visualcaptcha\validators;

use Yii;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\validators\Validator;

/**
 * Class VisualCaptchaValidator
 * @package simialbi\yii2\visualcaptcha\validators
 *
 * @property-read \simialbi\yii2\visualcaptcha\components\Captcha $captcha
 */
class VisualCaptchaValidator extends Validator
{
    /**
     * @var bool whether to skip this validator if the input is empty.
     */
    public $skipOnEmpty = false;
    /**
     * @var string module ID (case-sensitive). To retrieve grand child modules,
     * use ID path relative to this module (e.g. `admin/content`).
     */
    public $moduleId = 'visualcaptcha';

    /**
     * {@inheritdoc}
     */
    public function init()
    {
        parent::init();
        if ($this->message === null) {
            $this->message = Yii::t('yii', 'The verification code is incorrect.');
        }
    }

    /**
     * {@inheritdoc}
     * @throws \yii\base\NotSupportedException
     */
    public function validateAttribute($model, $attribute)
    {
        $namespace = Yii::$app->request->getBodyParam('namespace', Html::getInputName($model, $attribute));
        $namespaceString = str_replace([Html::getInputName($model, $attribute), '[', ']'], '', $namespace);
        $value = ArrayHelper::getValue($model->$attribute, $namespaceString, $model->$attribute);
        $result = $this->validateValue($value, $namespace);
        if (!empty($result)) {
            $this->addError($model, $attribute, $result[0], $result[1]);
        }
    }

    /**
     * {@inheritdoc}
     * @param string|null $namespace string the value of the parameter sent to the server for the namespace,
     * if it's not set up, no namespace will be sent
     */
    protected function validateValue($value, $namespace = null)
    {
        $this->captcha->namespace = $namespace;
        $imageFieldName = trim(str_replace(
            $namespace,
            '',
            ArrayHelper::getValue($this->captcha->frontendData, 'imageFieldName', '')
        ), '[]');
        $audioFieldName = trim(str_replace(
            $namespace,
            '',
            ArrayHelper::getValue($this->captcha->frontendData, 'audioFieldName', '')
        ), '[]');

        if ($imageFieldName && $val = ArrayHelper::getValue($value, $imageFieldName)) {
            return $this->captcha->validateImage($val) ? null : [$this->message, []];
        } elseif ($audioFieldName && $val = ArrayHelper::getValue($value, $audioFieldName)) {
            return $this->captcha->validateAudio($val) ? null : [$this->message, []];
        }
        return [$this->message, []];
    }

    /**
     * Get captcha component
     * @return \simialbi\yii2\visualcaptcha\components\Captcha
     */
    protected function getCaptcha()
    {
        $module = Yii::$app->getModule($this->moduleId);
        /* @var $module \simialbi\yii2\visualcaptcha\Module */

        return $module->captcha;
    }
}
