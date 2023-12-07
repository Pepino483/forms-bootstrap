<?php declare(strict_types = 1);

namespace Contributte\FormsBootstrap\Inputs;

use Contributte\FormsBootstrap\Enums\DateTimeFormat;
use Nette\Forms\Controls\DateTimeControl;
use Nette\Utils\Html;

class DateTimeInput extends DateTimeControl
{

	/** @var string[] */
	public static $additionalHtmlClasses = [];

	/**
	 * @inheritdoc
	 */
	public function __construct($label = null, bool $withSeconds = false)
	{
		parent::__construct($label, self::TypeDateTime, $withSeconds);
		$this->setFormat(DateTimeFormat::DATETIME);
	}

	public function getControl(): Html
	{
		$control = parent::getControl();
		$control->class[] = implode(' ', static::$additionalHtmlClasses);

		return $control;
	}

}
