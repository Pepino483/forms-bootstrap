<?php declare(strict_types = 1);

namespace Contributte\FormsBootstrap\Inputs;

use Contributte\FormsBootstrap\Enums\DateTimeFormat;
use Nette\Forms\Controls\DateTimeControl;
use Nette\Utils\Html;

class DateInput extends DateTimeControl
{

	/** @var string[] */
	public static $additionalHtmlClasses = [];

	/**
	 * @param Html|string|null $label
	 */
	public function __construct($label = null)
	{
		parent::__construct($label);
		$this->format = DateTimeFormat::DATE;
	}

	public function getControl(): Html
	{
		$control = parent::getControl();
		$control->class[] = implode(' ', static::$additionalHtmlClasses);

		return $control;
	}

}
