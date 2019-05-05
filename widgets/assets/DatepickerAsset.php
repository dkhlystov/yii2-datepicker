<?php

namespace dkhlystov\widgets\assets;

use Yii;
use yii\web\AssetBundle;

class DatepickerAsset extends AssetBundle
{
    /**
     * @inheritdoc
     */
    public $sourcePath = '@bower/bootstrap-datepicker/dist';

    /**
     * @inheritdoc
     */
    public $depends = [
        'yii\web\JqueryAsset',
    ];

    /**
     * @var string using styles bootstrap-datepicker|bootstrap-datepicker3|null
     */
    public static $style = 'bootstrap-datepicker3';

    /**
     * @var string plugin language
     */
    public static $language;

    /**
     * @var boolean
     */
    public static $juiNoConflict = false;

    /**
     * @inheritdoc
     */
    public function init()
    {
        parent::init();

        if (self::$juiNoConflict) {
            $this->depends[] = 'yii\jui\JuiAsset';
        }

        $this->js[] = 'js/bootstrap-datepicker' . (YII_DEBUG ? '' : '.min') . '.js';
        if (!empty(self::$style)) {
            $this->css[] = 'css/' . self::$style . (YII_DEBUG ? '' : '.min') . '.css';
        }

        $this->registerLocale();
    }

    /**
     * Registration of language file
     * @return void
     */
    protected function registerLocale()
    {
        if (self::$language != 'en') {
            $this->js[] = 'locales/bootstrap-datepicker.' . self::$language . '.min.js';
        }
    }
}
