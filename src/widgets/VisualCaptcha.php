<?php
/**
 * @package yii2-visualcaptcha
 * @author Simon Karlen <simi.albi@gmail.com>
 */

namespace simialbi\yii2\visualcaptcha\widgets;


use simialbi\yii2\widgets\InputWidget;
use Yii;
use yii\helpers\ArrayHelper;
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
     */
    public function init(): void
    {
        parent::init();

        if (!isset($this->namespace)) {
            $this->namespace = $this->hasModel()
                ? Html::getInputName($this->model, $this->attribute)
                : $this->name;
            $this->namespace .= '[' . $this->options['id'] . ']';
        }

        $this->registerTranslations();

        $this->clientOptions = ArrayHelper::merge([
            'language' => [
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
            ],
            'imgPath' => rtrim(Yii::getAlias($this->imgPath), '/') . '/',
            'captcha' => [
                'url' => Url::to(['/' . $this->moduleId]),
                'numberOfImages' => $this->numberOfImages,
                'namespace' => $this->namespace,
                'namespaceFieldName' => 'namespace',
                'routes' => [
                    'start' => '/start',
                    'image' => '/image',
                    'audio' => '/audio'
                ]
            ]
        ], $this->clientOptions);
    }

    /**
     * {@inheritdoc}
     */
    public function run(): string
    {
        parent::run();

        $options = $this->options;
        Html::removeCssClass($options, 'form-control');

        $html = Html::tag('div', '', $options);
        $this->registerPlugin('visualCaptcha');

        return $html;
    }
}
