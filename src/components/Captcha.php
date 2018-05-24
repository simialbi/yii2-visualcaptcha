<?php
/**
 * @package yii2-visualcaptcha
 * @author Simon Karlen <simi.albi@gmail.com>
 */

namespace simialbi\yii2\visualcaptcha\components;

use Yii;
use yii\base\Component;
use yii\base\Exception;
use yii\helpers\ArrayHelper;

/**
 * Class Captcha
 * @package simialbi\yii2\visualcaptcha\components
 *
 * @property string $namespace the value of the parameter sent to the server for the namespace, if it's not set up, no namespace will be sent
 * @property array $frontendData
 * @property array $validImageOption
 * @property array $validAudioOption
 * @property array $sessionImageOptions
 */
class Captcha extends Component
{
    /**
     * @var array All the image options. These can be easily overwritten or extended using
     * addImageOptions( <Array> ), or replaceImageOptions( <Array> ).
     */
    public $imageOptions = [
        [
            'name' => 'Airplane',
            'path' => 'airplane.png'
        ],
        [
            'name' => 'Balloons',
            'path' => 'balloons.png'
        ],
        [
            'name' => 'Camera',
            'path' => 'camera.png'
        ],
        [
            'name' => 'Car',
            'path' => 'car.png'
        ],
        [
            'name' => 'Cat',
            'path' => 'cat.png'
        ],
        [
            'name' => 'Chair',
            'path' => 'chair.png'
        ],
        [
            'name' => 'Clip',
            'path' => 'clip.png'
        ],
        [
            'name' => 'Clock',
            'path' => 'clock.png'
        ],
        [
            'name' => 'Cloud',
            'path' => 'cloud.png'
        ],
        [
            'name' => 'Computer',
            'path' => 'computer.png'
        ],
        [
            'name' => 'Envelope',
            'path' => 'envelope.png'
        ],
        [
            'name' => 'Eye',
            'path' => 'eye.png'
        ],
        [
            'name' => 'Flag',
            'path' => 'flag.png'
        ],
        [
            'name' => 'Folder',
            'path' => 'folder.png'
        ],
        [
            'name' => 'Foot',
            'path' => 'foot.png'
        ],
        [
            'name' => 'Graph',
            'path' => 'graph.png'
        ],
        [
            'name' => 'House',
            'path' => 'house.png'
        ],
        [
            'name' => 'Key',
            'path' => 'key.png'
        ],
        [
            'name' => 'Leaf',
            'path' => 'leaf.png'
        ],
        [
            'name' => 'Light Bulb',
            'path' => 'light-bulb.png'
        ],
        [
            'name' => 'Lock',
            'path' => 'lock.png'
        ],
        [
            'name' => 'Magnifying Glass',
            'path' => 'magnifying-glass.png'
        ],
        [
            'name' => 'Man',
            'path' => 'man.png'
        ],
        [
            'name' => 'Music Note',
            'path' => 'music-note.png'
        ],
        [
            'name' => 'Pants',
            'path' => 'pants.png'
        ],
        [
            'name' => 'Pencil',
            'path' => 'pencil.png'
        ],
        [
            'name' => 'Printer',
            'path' => 'printer.png'
        ],
        [
            'name' => 'Robot',
            'path' => 'robot.png'
        ],
        [
            'name' => 'Scissors',
            'path' => 'scissors.png'
        ],
        [
            'name' => 'Sunglasses',
            'path' => 'sunglasses.png'
        ],
        [
            'name' => 'Tag',
            'path' => 'tag.png'
        ],
        [
            'name' => 'Tree',
            'path' => 'tree.png'
        ],
        [
            'name' => 'Truck',
            'path' => 'truck.png'
        ],
        [
            'name' => 'T-Shirt',
            'path' => 't-shirt.png'
        ],
        [
            'name' => 'Umbrella',
            'path' => 'umbrella.png'
        ],
        [
            'name' => 'Woman',
            'path' => 'woman.png'
        ],
        [
            'name' => 'World',
            'path' => 'world.png'
        ]
    ];
    /**
     * @var array All the audio options. These can be easily overwritten or extended using
     * addImageOptions( <Array> ), or replaceImageOptions( <Array> ).
     */
    public $audioOptions = [
        [
            'path' => '5times2.mp3',
            'value' => '10'
        ],
        [
            'path' => '2times10.mp3',
            'value' => '20'
        ],
        [
            'path' => '5plus1.mp3',
            'value' => '6'
        ],
        [
            'path' => '4plus1.mp3',
            'value' => '5'
        ],
        [
            'path' => '4plus3.mp3',
            'value' => '7'
        ],
        [
            'path' => '6plus6.mp3',
            'value' => '12'
        ],
        [
            'path' => '12times2.mp3',
            'value' => '24'
        ],
        [
            'path' => '99plus1.mp3',
            'value' => '100'
        ],
        [
            'path' => 'add3to1.mp3',
            'value' => '4'
        ],
        [
            'path' => 'addblueandyellow.mp3',
            'value' => 'green'
        ],
        [
            'path' => 'after2.mp3',
            'value' => '3'
        ],
        [
            'path' => 'divide4by2.mp3',
            'value' => '2'
        ],
        [
            'path' => 'milkcolor.mp3',
            'value' => 'white'
        ],
        [
            'path' => 'skycolor.mp3',
            'value' => 'blue'
        ],
        [
            'path' => 'sunastar.mp3',
            'value' => 'yes'
        ],
        [
            'path' => 'yourobot.mp3',
            'value' => 'no'
        ],
        [
            'path' => 'capitaloffrance.mp3',
            'value' => 'paris'
        ],
        [
            'path' => 'skynight.mp3',
            'value' => 'black'
        ],
        [
            'path' => 'thirdmonth.mp3',
            'value' => 'march|3'
        ],
        [
            'path' => 'firstletteralphabet.mp3',
            'value' => 'a'
        ]
    ];
    /**
     * @var string
     */
    public $sessionPrefix = 'visualcaptcha_';

    /**
     * @var string the value of the parameter sent to the server for the namespace, if it's not set up,
     * no namespace will be sent
     */
    private $_namespace;

    /**
     * Generate a new valid option
     * @param integer $numberOfOptions Number of options. This parameter is optional. Defaults to 5.
     */
    public function generate($numberOfOptions = 5)
    {
        $imageValues = [];

        $oldImageOption = $this->validImageOption;
        $oldAudioOption = $this->validAudioOption;

        $this->frontendData = null;
        $this->validImageOption = null;
        $this->validAudioOption = null;
        $this->sessionImageOptions = null;

        $numberOfOptions = intval($numberOfOptions);

        if ($numberOfOptions < 4) {
            $numberOfOptions = 4;
        }

        shuffle($this->imageOptions);

        $images = $this->utilArraySample($this->imageOptions, $numberOfOptions);

        foreach ($images as &$image) {
            $randomValue = $this->utilRandomHex(10);
            $imageValues[] = $randomValue;

            ArrayHelper::setValue($image, 'value', $randomValue);
        }

        $this->sessionImageOptions = $images;

        do {
            $newImageOption = $this->utilArraySample($this->sessionImageOptions);
        } while ($oldImageOption && ArrayHelper::getValue($oldImageOption,
            'path') === ArrayHelper::getValue($newImageOption, 'path'));

        $this->validImageOption = $newImageOption;

        do {
            $newAudioOption = $this->utilArraySample($this->audioOptions);
        } while ($oldAudioOption && ArrayHelper::getValue($oldAudioOption,
            'path') === ArrayHelper::getValue($newAudioOption, 'path'));

        $this->validAudioOption = $newAudioOption;

        $this->frontendData = [
            'values' => $imageValues,
            'imageName' => Yii::t('simialbi/visualcaptcha/names',
                ArrayHelper::getValue($this->validImageOption, 'name')),
            'imageFieldName' => $this->namespace ? $this->namespace . '[' . $this->utilRandomHex(10) . ']' : $this->utilRandomHex(10),
            'audioFieldName' => $this->namespace ? $this->namespace . '[' . $this->utilRandomHex(10) . ']' : $this->utilRandomHex(10)
        ];
    }

    /**
     * Return samples from array
     * @param array $arr
     * @param integer $count
     * @return array
     */
    private function utilArraySample($arr, $count = 1)
    {
        if ($count == 1) {
            return $arr[array_rand($arr)];
        } else {
            // Limit the sample size to the length of the array
            if ($count > count($arr)) {
                $count = count($arr);
            }
            $result = [];
            $rand = array_rand($arr, $count);
            foreach ($rand as $key) {
                $result[] = $arr[$key];
            }

            return $result;
        }
    }

    /**
     * Create a hex string from random bytes
     * @param integer $count
     * @return string
     */
    private function utilRandomHex($count)
    {
        try {
            $bytes = Yii::$app->security->generateRandomKey($count);
        } catch (Exception $e) {
            $bytes = openssl_random_pseudo_bytes($count);
        }

        return bin2hex($bytes);
    }

    /**
     * Get data to be used by the frontend
     * @return array
     */
    public function getFrontendData()
    {
        return Yii::$app->session->get($this->sessionPrefix . 'frontendData');
    }

    /**
     * Set data to be used by the frontend
     * @param array $frontendData
     */
    public function setFrontendData($frontendData)
    {
        Yii::$app->session->set($this->sessionPrefix . 'frontendData', $frontendData);
    }

    /**
     * @return string
     */
    public function getNamespace()
    {
        return $this->_namespace;
    }

    /**
     *
     * @param string $namespace
     */
    public function setNamespace($namespace)
    {
        $this->_namespace = $namespace;

        if ($pos = (strpos($this->sessionPrefix, '/') !== false)) {
            $this->sessionPrefix = substr($this->sessionPrefix, $pos + 1);
        }
        if (!empty($namespace)) {
            $this->sessionPrefix = $namespace . '/' . $this->sessionPrefix;
        }
    }

    /**
     * Get the current validImageOption
     * @return array
     */
    public function getValidImageOption()
    {
        return Yii::$app->session->get($this->sessionPrefix . 'validImageOption');
    }

    /**
     * Set the current validImageOption
     * @param array $validImageOption
     */
    public function setValidImageOption($validImageOption)
    {
        Yii::$app->session->set($this->sessionPrefix . 'validImageOption', $validImageOption);
    }

    /**
     * Get the current validAudioOption
     * @return array
     */
    public function getValidAudioOption()
    {
        return Yii::$app->session->get($this->sessionPrefix . 'validAudioOption');
    }

    /**
     * Get the current validAudioOption
     * @param array $validAudioOption
     */
    public function setValidAudioOption($validAudioOption)
    {
        Yii::$app->session->set($this->sessionPrefix . 'validAudioOption', $validAudioOption);
    }

    /**
     * Return generated image options
     * @return array
     */
    public function getSessionImageOptions()
    {
        return Yii::$app->session->get($this->sessionPrefix . 'images');
    }

    /**
     * Set generated image options
     * @param array $images
     */
    public function setSessionImageOptions($images)
    {
        Yii::$app->session->set($this->sessionPrefix . 'images', $images);
    }

    /**
     * Validate the sent image value with the validImageOption
     * @param string $sentOption
     * @return boolean
     */
    public function validateImage($sentOption)
    {
        return ($sentOption == ArrayHelper::getValue($this->validImageOption, 'value'));
    }

    /**
     * Validate the sent audio value with the validAudioOption
     * @param string $sentOption
     * @return boolean
     */
    public function validateAudio($sentOption)
    {
        $validAnswers = explode('|', strtoupper(ArrayHelper::getValue($this->validAudioOption, 'value')));
        return (in_array(strtoupper($sentOption), $validAnswers));
    }

    /**
     * Return the image string from cache to avoid I/O
     * @param string $filePath
     * @return bool|string
     */
    public function getImage($filePath)
    {
        if (Yii::$app->cache) {
            $cacheKey = md5($filePath);

            $img = Yii::$app->cache->getOrSet($cacheKey, function () use ($filePath) {
                return file_get_contents($filePath);
            });
        } else {
            $img = file_get_contents($filePath);
        }

        // Add some noise randomly, so images can't be saved and matched easily by filesize or checksum
        $img .= $this->utilRandomHex(rand(0, 1500));

        return $img;
    }
}