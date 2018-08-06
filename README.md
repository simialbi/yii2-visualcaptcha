# yii2-visualcaptcha

## Resources
 * [visualCaptcha](https://visualcaptcha.net/)
 * [yii2](https://github.com/yiisoft/yii2) framework

## Installation 

The preferred way to install this extension is through [composer](http://getcomposer.org/download/).

Either run

```
$ php composer.phar require --prefer-dist simialbi/yii2-visualcaptcha
```

or add 

```
"simialbi/yii2-visualcaptcha": "*"
```

to the ```require``` section of your `composer.json`

## Usage

### Setup Module

Add the module `visualcaptcha` to the modules and bootstrap section of your configuration file:
```php
[
    'bootstrap' => ['log', 'visualcaptcha'],
    'modules' => [
        'visualcaptcha' => [
            'class' => 'simialbi\yii2\visualcaptcha\Module'
        ]
    ]
]
```


## Example Usage

### Define Model
```php
<?php
namespace app\models;

use simialbi\yii2\visualcaptcha\validators\VisualCaptchaValidator;
use yii\base\Model;

class MyForm extends Model {
	public $name;
	public $email;
	public $subject;
	public $body;
	public $verifyCode;

	/**
	 * {@inheritdoc}
	 */
	public function rules() {
		return [
			[['name', 'email', 'subject', 'body', 'verifyCode'], 'required'],
			['email', 'email'],
			['verifyCode', VisualCaptchaValidator::class]
		];
	}
}
```

### Use in view

```php
<?php

use simialbi\yii2\visualcaptcha\widgets\VisualCaptcha;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\MyForm */

$this->title = 'Visual Captcha';
$this->params['breadcrumbs'][] = $this->title;

?>
<div class="my-visualcaptcha">
    <?php $form = ActiveForm::begin(['id' => 'test-form']); ?>
	
    <?=$form->field($model, 'name')->textInput(['autofocus' => true]);?>
    <?=$form->field($model, 'email');?>
    <?=$form->field($model, 'subject');?>
    <?=$form->field($model, 'body')->textarea(['rows' => 6]);?>
    <?=$form->field($model, 'verifyCode')->widget(VisualCaptcha::class, [
        'numberOfImages' => 10,
        'clientOptions' => [
            // change templates
            'templates' => [
                'button' => '
                    <div class="visualCaptcha-{class}-button">
                        <a href="javascript:;">
                            <img src="{path}{class}{retinaExtra}.png" title="{classTitle}" alt="{classAlt}">
                        </a>
                    </div>',
                'buttonGroup' => '
                     <div class="visualCaptcha-button-group">
                         {btnRefresh}
                         {btnAccessibility}
                     </div>'
            ]
        ]
    ]);?>

    <div class="form-group">
        <?=Html::submitButton('Submit', ['class' => ['btn', 'btn-primary']]);?>
    </div>

    <?php ActiveForm::end(); ?>
?>
</div>
```

## License

**yii2-visualcaptcha** is released under MIT license. See bundled [LICENSE](LICENSE) for details.
