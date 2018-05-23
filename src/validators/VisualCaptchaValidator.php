<?php
/**
 * @package yii2-visualcaptcha
 * @author Simon Karlen <simi.albi@gmail.com>
 */

namespace simialbi\yii2\visualcaptcha\validators;

use Yii;
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
     */
    public function clientValidateAttribute($model, $attribute, $view)
    {
        return 'jQuery(\'#\' + attribute.id).data(\'captcha\').getCaptchaData().valid;';
    }

    /**
     * {@inheritdoc}
     */
    protected function validateValue($value)
    {
        return ($this->captcha->validateImage($value) || $this->captcha->validateAudio($value));
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