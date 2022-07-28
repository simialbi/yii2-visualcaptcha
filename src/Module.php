<?php
/**
 * @package yii2-visualcaptcha
 * @author Simon Karlen <simi.albi@gmail.com>
 */

namespace simialbi\yii2\visualcaptcha;

use yii\base\BootstrapInterface;

/**
 * Visual captcha module
 *
 * @property-read components\Captcha $captcha
 */
class Module extends \simialbi\yii2\base\Module implements BootstrapInterface
{
    /**
     * {@inheritdoc}
     */
    public $defaultRoute = 'captcha';

    /**
     * {@inheritdoc}
     * @throws \yii\base\InvalidConfigException
     */
    public function init()
    {
        parent::init();

        $this->registerTranslations();

        if (!$this->has('captcha')) {
            $this->set('captcha', new components\Captcha());
        }
    }

    /**
     * Returns the captcha component
     * @return null|components\Captcha
     * @throws \yii\base\InvalidConfigException
     */
    public function getCaptcha(): ?components\Captcha
    {
        $captcha = $this->get('captcha');
        /* @var components\Captcha $captcha */

        return $captcha;
    }

    /**
     * {@inheritdoc}
     */
    public function bootstrap($app)
    {
        $app->setAliases([
            '@visualcaptcha' => __DIR__
        ]);
        $app->urlManager->addRules([
            '/' . $this->id . '/start/<howMany:\d+>' => $this->id . '/captcha/index',
            '/' . $this->id . '/image/<index:\d+>' => $this->id . '/image/index',
            '/' . $this->id . '/audio/<type:(mp3|ogg)>' => $this->id . '/audio/index'
        ]);
    }
}
