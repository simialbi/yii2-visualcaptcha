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
            'path' => '@visualcaptcha/assets/images/airplane.png'
        ],
        [
            'name' => 'Balloons',
            'path' => '@visualcaptcha/assets/images/balloons.png'
        ],
        [
            'name' => 'Camera',
            'path' => '@visualcaptcha/assets/images/camera.png'
        ],
        [
            'name' => 'Car',
            'path' => '@visualcaptcha/assets/images/car.png'
        ],
        [
            'name' => 'Cat',
            'path' => '@visualcaptcha/assets/images/cat.png'
        ],
        [
            'name' => 'Chair',
            'path' => '@visualcaptcha/assets/images/chair.png'
        ],
        [
            'name' => 'Clip',
            'path' => '@visualcaptcha/assets/images/clip.png'
        ],
        [
            'name' => 'Clock',
            'path' => '@visualcaptcha/assets/images/clock.png'
        ],
        [
            'name' => 'Cloud',
            'path' => '@visualcaptcha/assets/images/cloud.png'
        ],
        [
            'name' => 'Computer',
            'path' => '@visualcaptcha/assets/images/computer.png'
        ],
        [
            'name' => 'Envelope',
            'path' => '@visualcaptcha/assets/images/envelope.png'
        ],
        [
            'name' => 'Eye',
            'path' => '@visualcaptcha/assets/images/eye.png'
        ],
        [
            'name' => 'Flag',
            'path' => '@visualcaptcha/assets/images/flag.png'
        ],
        [
            'name' => 'Folder',
            'path' => '@visualcaptcha/assets/images/folder.png'
        ],
        [
            'name' => 'Foot',
            'path' => '@visualcaptcha/assets/images/foot.png'
        ],
        [
            'name' => 'Graph',
            'path' => '@visualcaptcha/assets/images/graph.png'
        ],
        [
            'name' => 'House',
            'path' => '@visualcaptcha/assets/images/house.png'
        ],
        [
            'name' => 'Key',
            'path' => '@visualcaptcha/assets/images/key.png'
        ],
        [
            'name' => 'Leaf',
            'path' => '@visualcaptcha/assets/images/leaf.png'
        ],
        [
            'name' => 'Light Bulb',
            'path' => '@visualcaptcha/assets/images/light-bulb.png'
        ],
        [
            'name' => 'Lock',
            'path' => '@visualcaptcha/assets/images/lock.png'
        ],
        [
            'name' => 'Magnifying Glass',
            'path' => '@visualcaptcha/assets/images/magnifying-glass.png'
        ],
        [
            'name' => 'Man',
            'path' => '@visualcaptcha/assets/images/man.png'
        ],
        [
            'name' => 'Music Note',
            'path' => '@visualcaptcha/assets/images/music-note.png'
        ],
        [
            'name' => 'Pants',
            'path' => '@visualcaptcha/assets/images/pants.png'
        ],
        [
            'name' => 'Pencil',
            'path' => '@visualcaptcha/assets/images/pencil.png'
        ],
        [
            'name' => 'Printer',
            'path' => '@visualcaptcha/assets/images/printer.png'
        ],
        [
            'name' => 'Robot',
            'path' => '@visualcaptcha/assets/images/robot.png'
        ],
        [
            'name' => 'Scissors',
            'path' => '@visualcaptcha/assets/images/scissors.png'
        ],
        [
            'name' => 'Sunglasses',
            'path' => '@visualcaptcha/assets/images/sunglasses.png'
        ],
        [
            'name' => 'Tag',
            'path' => '@visualcaptcha/assets/images/tag.png'
        ],
        [
            'name' => 'Tree',
            'path' => '@visualcaptcha/assets/images/tree.png'
        ],
        [
            'name' => 'Truck',
            'path' => '@visualcaptcha/assets/images/truck.png'
        ],
        [
            'name' => 'T-Shirt',
            'path' => '@visualcaptcha/assets/images/t-shirt.png'
        ],
        [
            'name' => 'Umbrella',
            'path' => '@visualcaptcha/assets/images/umbrella.png'
        ],
        [
            'name' => 'Woman',
            'path' => '@visualcaptcha/assets/images/woman.png'
        ],
        [
            'name' => 'World',
            'path' => '@visualcaptcha/assets/images/world.png'
        ]
    ];
    /**
     * @var array All the audio options. These can be easily overwritten or extended using
     * addImageOptions( <Array> ), or replaceImageOptions( <Array> ).
     */
    public $audioOptions = [
        [
            'path' => '@visualcaptcha/assets/audios/5times2.mp3',
            'value' => '10'
        ],
        [
            'path' => '@visualcaptcha/assets/audios/2times10.mp3',
            'value' => '20'
        ],
        [
            'path' => '@visualcaptcha/assets/audios/5plus1.mp3',
            'value' => '6'
        ],
        [
            'path' => '@visualcaptcha/assets/audios/4plus1.mp3',
            'value' => '5'
        ],
        [
            'path' => '@visualcaptcha/assets/audios/4plus3.mp3',
            'value' => '7'
        ],
        [
            'path' => '@visualcaptcha/assets/audios/6plus6.mp3',
            'value' => '12'
        ],
        [
            'path' => '@visualcaptcha/assets/audios/12times2.mp3',
            'value' => '24'
        ],
        [
            'path' => '@visualcaptcha/assets/audios/99plus1.mp3',
            'value' => '100'
        ],
        [
            'path' => '@visualcaptcha/assets/audios/add3to1.mp3',
            'value' => '4'
        ],
        [
            'path' => '@visualcaptcha/assets/audios/addblueandyellow.mp3',
            'value' => 'green'
        ],
        [
            'path' => '@visualcaptcha/assets/audios/after2.mp3',
            'value' => '3'
        ],
        [
            'path' => '@visualcaptcha/assets/audios/divide4by2.mp3',
            'value' => '2'
        ],
        [
            'path' => '@visualcaptcha/assets/audios/milkcolor.mp3',
            'value' => 'white'
        ],
        [
            'path' => '@visualcaptcha/assets/audios/skycolor.mp3',
            'value' => 'blue'
        ],
        [
            'path' => '@visualcaptcha/assets/audios/sunastar.mp3',
            'value' => 'yes'
        ],
        [
            'path' => '@visualcaptcha/assets/audios/yourobot.mp3',
            'value' => 'no'
        ],
        [
            'path' => '@visualcaptcha/assets/audios/capitaloffrance.mp3',
            'value' => 'paris'
        ],
        [
            'path' => '@visualcaptcha/assets/audios/skynight.mp3',
            'value' => 'black'
        ],
        [
            'path' => '@visualcaptcha/assets/audios/thirdmonth.mp3',
            'value' => 'march|3'
        ],
        [
            'path' => '@visualcaptcha/assets/audios/firstletteralphabet.mp3',
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
     * @throws \Exception
     */
    public function generate(int $numberOfOptions = 5)
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
        } while (
            $oldImageOption &&
            ArrayHelper::getValue($oldImageOption, 'path') === ArrayHelper::getValue($newImageOption, 'path')
        );

        $this->validImageOption = $newImageOption;

        do {
            $newAudioOption = $this->utilArraySample($this->audioOptions);
        } while (
            $oldAudioOption &&
            ArrayHelper::getValue($oldAudioOption, 'path') === ArrayHelper::getValue($newAudioOption, 'path')
        );

        $this->validAudioOption = $newAudioOption;

        $this->frontendData = [
            'values' => $imageValues,
            'imageName' => Yii::t(
                'simialbi/visualcaptcha/names',
                ArrayHelper::getValue($this->validImageOption, 'name')
            ),
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
    private function utilArraySample(array $arr, int $count = 1): array
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
    private function utilRandomHex(int $count): string
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
     * @return array|null
     */
    public function getFrontendData(): ?array
    {
        return Yii::$app->session->get($this->sessionPrefix . 'frontendData');
    }

    /**
     * Set data to be used by the frontend
     * @param array|null $frontendData
     */
    public function setFrontendData(?array $frontendData)
    {
        Yii::$app->session->set($this->sessionPrefix . 'frontendData', $frontendData);
    }

    /**
     * @return string|null
     */
    public function getNamespace(): ?string
    {
        return $this->_namespace;
    }

    /**
     *
     * @param string|null $namespace
     */
    public function setNamespace(?string $namespace)
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
     * @return array|null
     */
    public function getValidImageOption(): ?array
    {
        return Yii::$app->session->get($this->sessionPrefix . 'validImageOption');
    }

    /**
     * Set the current validImageOption
     * @param array|null $validImageOption
     */
    public function setValidImageOption(?array $validImageOption)
    {
        Yii::$app->session->set($this->sessionPrefix . 'validImageOption', $validImageOption);
    }

    /**
     * Get the current validAudioOption
     * @return array|null
     */
    public function getValidAudioOption(): ?array
    {
        return Yii::$app->session->get($this->sessionPrefix . 'validAudioOption');
    }

    /**
     * Get the current validAudioOption
     * @param array|null $validAudioOption
     */
    public function setValidAudioOption(?array $validAudioOption)
    {
        Yii::$app->session->set($this->sessionPrefix . 'validAudioOption', $validAudioOption);
    }

    /**
     * Return generated image options
     * @return array|null
     */
    public function getSessionImageOptions(): ?array
    {
        return Yii::$app->session->get($this->sessionPrefix . 'images');
    }

    /**
     * Set generated image options
     * @param array|null $images
     */
    public function setSessionImageOptions(?array $images)
    {
        Yii::$app->session->set($this->sessionPrefix . 'images', $images);
    }

    /**
     * Validate the sent image value with the validImageOption
     * @param string $sentOption
     * @return boolean
     * @throws \Exception
     */
    public function validateImage(string $sentOption): bool
    {
        return ($sentOption == ArrayHelper::getValue($this->validImageOption, 'value'));
    }

    /**
     * Validate the sent audio value with the validAudioOption
     * @param string $sentOption
     * @return boolean
     * @throws \Exception
     */
    public function validateAudio(string $sentOption): bool
    {
        $validAnswers = explode('|', strtoupper(ArrayHelper::getValue($this->validAudioOption, 'value')));
        return (in_array(strtoupper($sentOption), $validAnswers));
    }

    /**
     * Return the image string from cache to avoid I/O
     * @param string $filePath
     * @return string
     */
    public function getImage(string $filePath): string
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
