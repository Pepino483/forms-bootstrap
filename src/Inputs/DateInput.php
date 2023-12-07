<?php declare(strict_types = 1);

namespace Contributte\FormsBootstrap\Inputs;

use Contributte\FormsBootstrap\BootstrapUtils;
use Contributte\FormsBootstrap\Enums\DateTimeFormat;
use Nette\Forms\Controls\DateTimeControl;
use Nette\Utils\Html;

class DateInput extends DateTimeControl
{

	/**
	 * @param Html|string|null $label
	 */
	public function __construct($label = null)
	{
		parent::__construct($label);
		$this->setFormat(DateTimeFormat::DATE);
	}

	public function getControl(): Html
	{
		$control = parent::getControl();
		BootstrapUtils::standardizeClass($control);

		$control->class[] = 'form-control';

		return $control;
	}

}
