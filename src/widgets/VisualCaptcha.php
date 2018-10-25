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
     * @var string path to the following interface icons:
     *   * accessibility.png
     *   * accessibility@2x.png
     *   * refresh.png
     *   * refresh@2x.png
     */
    public $imgPath = '@web/img/';

    /**
     * @var string the value of the parameter sent to the server for the namespace, if it's not set up,
     * it will be auto generated
     */
    public $namespace;

    /**
     * {@inheritdoc}
     * @throws \ReflectionException
     */
    public function init()
    {
        parent::init();

        if (!isset($this->namespace)) {
            $this->namespace = $this->hasModel()
                ? Html::getInputName($this->model, $this->attribute)
                : $this->name;
            $this->namespace .= '[' . $this->options['id'] . ']';
        }

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
        $this->clientOptions['imgPath'] = rtrim(Yii::getAlias($this->imgPath), '/') . '/';
        $this->clientOptions['captcha'] = [
            'url' => Url::to(['/' . $this->moduleId]),
            'numberOfImages' => $this->numberOfImages,
            'namespace' => $this->namespace,
            'namespaceFieldName' => 'namespace',
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

//        $html = $this->renderInputHtml('hidden');
//        $this->options['id'] .= '-container';
        $html = Html::tag('div', '', $this->options);
        $this->registerPlugin('visualCaptcha');

        return $html;
    }
}