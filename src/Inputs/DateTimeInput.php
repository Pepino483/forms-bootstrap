<?php declare(strict_types = 1);

namespace Contributte\FormsBootstrap\Inputs;

use Contributte\FormsBootstrap\BootstrapUtils;
use Nette\Forms\Controls\DateTimeControl;
use Nette\Utils\Html;

class DateTimeInput extends DateTimeControl
{

	/**
	 * @inheritdoc
	 */
	public function __construct($label = null, bool $withSeconds = false)
	{
		parent::__construct($label, self::TypeDateTime, $withSeconds);
	}

	/**
	 * @return Html
	 */
	public function getControl(): Html
	{
		$control = parent::getControl();
		BootstrapUtils::standardizeClass($control);
		$control->class[] = 'form-control';
		return $control;
	}

}
