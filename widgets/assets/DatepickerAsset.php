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
		'yii\bootstrap\BootstrapAsset',
		'yii\web\JqueryAsset',
	];

	/**
	 * @var string plugin laguage
	 */
	private static $_lang;

	/**
	 * @inheritdoc
	 */
	public function init()
	{
		parent::init();

		$this->css[] = 'css/bootstrap-datepicker3' . (YII_DEBUG ? '' : '.min') . '.css';
		$this->js[] = 'js/bootstrap-datepicker' . (YII_DEBUG ? '' : '.min') . '.js';

		$this->registerLocale();
	}

	/**
	 * Registration of language file
	 * @return void
	 */
	protected function registerLocale()
	{
		self::$_lang = strtolower(substr(Yii::$app->language, 0, 2));

		if (self::$_lang != 'en')
			$this->js[] = 'locales/bootstrap-datepicker.' . self::$_lang . '.min.js';
	}

	/**
	 * @inheritdoc
	 * Set default widget language the same as applicaion laguage
	 */
	public static function register($view)
	{
		parent::register($view);

		$view->registerJs('$.fn.datepicker.defaults.language = "' . self::$_lang . '";');
	}

}
