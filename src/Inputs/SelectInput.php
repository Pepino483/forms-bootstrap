<?php declare(strict_types = 1);

namespace Contributte\FormsBootstrap\Inputs;

use Contributte\FormsBootstrap\BootstrapForm;
use Contributte\FormsBootstrap\Enums\BootstrapVersion;
use Contributte\FormsBootstrap\Traits\ChoiceInputTrait;
use Contributte\FormsBootstrap\Traits\InputExtraTrait;
use Contributte\FormsBootstrap\Traits\InputPromptTrait;
use Contributte\FormsBootstrap\Traits\StandardValidationTrait;
use Nette\Forms\Controls\SelectBox;
use Nette\Utils\Html;

/**
 * Class SelectInput.
 * Single select.
 */
class SelectInput extends SelectBox implements IValidationInput
{

	use ChoiceInputTrait;
	use InputPromptTrait;
	use StandardValidationTrait;
	use InputExtraTrait;

	/**
	 * @param string|Html|null       $label
	 * @param array<string|int, array<string|int, string>|string>|null $items
	 */
	public function __construct($label = null, ?array $items = null)
	{
		parent::__construct($label);
		if ($items !== null) {
			$this->setItems($items);
		}
	}

	/**
	 * @inheritdoc
	 */
	public function getControl(): Html
	{
		$select = parent::getControl();

		$select->class[] = 'form-select';

		if ($this->isControlDisabled()) {
			$select->setAttribute('disabled', true);
		}

		return $select;
	}

}
