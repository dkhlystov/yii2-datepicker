<?php

namespace dkhlystov\widgets;

use yii\helpers\Html;
use yii\helpers\Json;
use yii\widgets\InputWidget;

use dkhlystov\widgets\assets\DatepickerAsset;

class Datepicker extends InputWidget
{

	/**
	 * @var array additional options for jquery bootstrap datepicker widget
	 */
	public $clientOptions = ['format' => 'yyyy-mm-dd'];

	/**
	 * @inheritdoc
	 */
	public $options = ['class' => 'form-control'];

	/**
	 * @inheritdoc
	 */
	public function init()
	{
		parent::init();

		if (empty($this->options['id']))
			$this->options['id'] = $this->id;

		$this->registerClientScripts();
	}

	/**
	 * @inheritdoc
	 */
	public function run()
	{
		echo Html::activeTextInput($this->model, $this->attribute, $this->options);
	}

	/**
	 * Registration client scripts and initializing plugin
	 * @return void
	 */
	private function registerClientScripts()
	{
		$view = $this->getView();

		DatepickerAsset::register($view);

		$options = Json::htmlEncode($this->clientOptions);

		$view->registerJs("$('#{$this->options['id']}').datepicker($.extend({zIndexOffset: 100}, $options));");
	}

}
