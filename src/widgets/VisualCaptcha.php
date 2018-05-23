<?php
/**
 * @package yii2-visualcaptcha
 * @author Simon Karlen <simi.albi@gmail.com>
 */

namespace simialbi\yii2\visualcaptcha\widgets;


use simialbi\yii2\widgets\InputWidget;
use Yii;
use yii\helpers\Html;
use yii\helpers\Url;

class VisualCaptcha extends InputWidget
{
    /**
     * @var string module ID (case-sensitive). To retrieve grand child modules,
     * use ID path relative to this module (e.g. `admin/content`).
     */
    public $moduleId = 'visualcaptcha';

    /**
     * @var integer number of generated image options for visualCaptcha
     */
    public $numberOfImages = 6;

    /**
     * {@inheritdoc}
     */
    public function init()
    {
        parent::init();

        $this->registerTranslations();

        $this->clientOptions['language'] = [
            'accessibilityAlt' => Yii::t(
                'simialbi/visualcaptcha/input-widget',
                'Sound icon'
            ),
            'accessibilityTitle' => Yii::t(
                'simialbi/visualcaptcha/input-widget',
                'Accessibility option: listen to a question and answer it!'
            ),
            'accessibilityDescription' => Yii::t(
                'simialbi/visualcaptcha/input-widget',
                'Type below the <strong>answer</strong> to what you hear. Numbers or words:'
            ),
            'explanation' => Yii::t(
                'simialbi/visualcaptcha/input-widget',
                'Click or touch the <strong>ANSWER</strong>'
            ),
            'refreshAlt' => Yii::t(
                'simialbi/visualcaptcha/input-widget',
                'Refresh/reload icon'
            ),
            'refreshTitle' => Yii::t(
                'simialbi/visualcaptcha/input-widget',
                'Refresh/reload: get new images and accessibility option!'
            )
        ];
        $this->clientOptions['imgPath'] = Yii::getAlias('@visualcaptcha/assets/img/');
        $this->clientOptions['captcha'] = [
            'url' => Url::to([$this->moduleId]),
            'numberOfImages' => $this->numberOfImages,
            'routes' => [
                'start' => '/start',
                'image' => '/image',
                'audio' => '/audio'
            ]
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function run()
    {
        parent::run();

        $html = $this->renderInputHtml('hidden');
        $this->options['id'] .= '-container';
        $html .= Html::tag('div', '', ['id' => $this->options['id']]);
        $this->registerPlugin('visualCaptcha');

        return $html;
    }
}