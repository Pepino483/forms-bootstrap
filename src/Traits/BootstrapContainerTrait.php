<?php declare(strict_types = 1);

namespace Contributte\FormsBootstrap\Traits;

use Contributte\FormsBootstrap\BootstrapContainer;
use Contributte\FormsBootstrap\BootstrapForm;
use Contributte\FormsBootstrap\Inputs\ButtonInput;
use Contributte\FormsBootstrap\Inputs\CheckboxInput;
use Contributte\FormsBootstrap\Inputs\CheckboxListInput;
use Contributte\FormsBootstrap\Inputs\DateInput;
use Contributte\FormsBootstrap\Inputs\DateTimeInput;
use Contributte\FormsBootstrap\Inputs\MultiselectInput;
use Contributte\FormsBootstrap\Inputs\RadioInput;
use Contributte\FormsBootstrap\Inputs\SelectInput;
use Contributte\FormsBootstrap\Inputs\SubmitButtonInput;
use Contributte\FormsBootstrap\Inputs\TextAreaInput;
use Contributte\FormsBootstrap\Inputs\TextInput;
use Contributte\FormsBootstrap\Inputs\UploadInput;
use Nette\ComponentModel\IComponent;
use Nette\Forms\Container;
use Nette\Forms\Controls\BaseControl;
use Nette\Forms\Controls\Button;
use Nette\Forms\Controls\Checkbox;
use Nette\Forms\Controls\CheckboxList;
use Nette\Forms\Controls\DateTimeControl;
use Nette\Forms\Controls\MultiSelectBox;
use Nette\Forms\Controls\RadioList;
use Nette\Forms\Controls\SelectBox;
use Nette\Forms\Controls\SubmitButton;
use Nette\Forms\Controls\TextArea;
use Nette\Forms\Controls\TextInput as NetteTextInput;
use Nette\Forms\Controls\UploadControl;
use Nette\Forms\Form;
use Nette\Utils\Html;

/**
 * Trait BootstrapContainerTrait.
 * Implements methods to add inputs.
 *
 * @method BaseControl getComponent(string $name)
 */
trait BootstrapContainerTrait
{

	/**
	 * @param string|Html|null $content
	 * @return ButtonInput
	 */
	public function addButton(string $name, $content = null): Button
	{
		$comp = new ButtonInput($content);
		$comp->setBtnClass('btn-secondary');
		$this->addComponent($comp, $name);

		return $comp;
	}

	/**
	 * @param string|null $caption
	 * @return CheckboxInput
	 */
	public function addCheckbox(string $name, $caption = null): Checkbox
	{
		$comp = new CheckboxInput($caption);
		$this->addComponent($comp, $name);

		return $comp;
	}

	/**
	 * @param string|null $label
	 * @param string[]|null $items
	 * @return CheckboxListInput
	 */
	public function addCheckboxList(string $name, $label = null, ?array $items = null): CheckboxList
	{
		$comp = new CheckboxListInput($label, $items);
		$this->addComponent($comp, $name);

		return $comp;
	}

	// phpcs:ignore
	abstract public function addComponent(IComponent $component, ?string $name, ?string $insertBefore = null); //

	/**
	 * @param string $name
	 * @return BootstrapContainer
	 */
	public function addContainer($name): Container
	{
		$control = new BootstrapContainer();
		$control->setCurrentGroup($this->getCurrentGroup());
		if ($this->getCurrentGroup() !== null) {
			$this->getCurrentGroup()->add($control);
		}

		$this->addComponent($control, (string) $name);

		return $control;
	}

	/**
	 * Adds a datetime input.
	 */
	public function addDate(string $name, $label = null): DateTimeControl
	{
		$comp = new DateTimeInput($label, DateTimeControl::TypeDate);
		//$comp->setNullable(BootstrapForm::$allwaysUseNullable);
		$this->addComponent($comp, $name);

		return $comp;
	}

	/**
	 * @param string $name
	 * @param null $label
	 * @param bool $withSeconds
	 * @return DateTimeControl
	 * Adds a time input.
	 */
	public function addTime(string $name, $label = null, bool $withSeconds = false): DateTimeControl
	{
		$comp = new DateTimeInput($label, DateTimeControl::TypeTime, $withSeconds);
		//$comp->setNullable(BootstrapForm::$allwaysUseNullable);
		$this->addComponent($comp, $name);

		return $comp;
	}

	/**
	 * @param string|Html|null $label
	 * Adds a datetime input.
	 */
	public function addDateTime(string $name, $label = null, bool $withSeconds = false): DateTimeControl
	{
		$comp = new DateTimeInput($label, DateTimeControl::TypeDateTime, $withSeconds);
		//$comp->setNullable(BootstrapForm::$allwaysUseNullable);
		$this->addComponent($comp, $name);

		return $comp;
	}

	/**
	 * @param Html|string|null $label
	 * @return TextInput
	 */
	public function addEmail(string $name, $label = null): NetteTextInput
	{
		return $this->addText($name, $label)
			->setNullable(BootstrapForm::$allwaysUseNullable)
			->addRule(Form::EMAIL);
	}

	/**
	 * Adds error to a specific component
	 */
	public function addInputError(string $componentName, string $message): void
	{
		$this->getComponent($componentName)->addError($message);
	}

	/**
	 * @param string|Html|null $label
	 * @return TextInput
	 */
	public function addInteger(string $name, $label = null): NetteTextInput
	{
		return $this->addText($name, $label)
			->setNullable(BootstrapForm::$allwaysUseNullable)
			->addRule(Form::INTEGER, 'Formát políčka "%s" není v pořádku.', $label);
	}

	/**
	 * @param string|Html|null $label
	 * @param string[]|null $items
	 * @return MultiselectInput
	 */
	public function addMultiSelect(string $name, $label = null, ?array $items = null, ?int $size = null): MultiSelectBox
	{
		$comp = new MultiselectInput($label, $items);
		if ($size !== null) {
			$comp->setHtmlAttribute('size', $size);
		}

		$this->addComponent($comp, $name);

		return $comp;
	}

	/**
	 * @param string|Html|null $label
	 * @return UploadInput
	 */
	public function addMultiUpload(string $name, $label = null): UploadControl
	{
		return $this->addUpload($name, $label, true);
	}

	/**
	 * @param string|Html|null $label
	 * @return TextInput
	 */
	public function addPassword(string $name, $label = null, ?int $cols = null, ?int $maxLength = null): NetteTextInput
	{
		return $this->addText($name, $label, $cols, $maxLength)
			->setHtmlType('password');
	}

	/**
	 * @param string|Html|null $label
	 * @param string[]|null $items
	 */
	public function addRadioList(string $name, $label = null, ?array $items = null): RadioList
	{
		$comp = new RadioInput($label, $items);
		$this->addComponent($comp, $name);

		return $comp;
	}

	/**
	 * @param string|Html|null $label
	 * @param array<string|int, array<string|int, string>|string> $items
	 * @return SelectInput
	 */
	public function addSelect(string $name, $label = null, ?array $items = null, ?int $size = null): SelectBox
	{
		$comp = new SelectInput($label, $items);
		if ($size !== null) {
			$comp->setHtmlAttribute('size', $size);
		}

		$this->addComponent($comp, $name);

		return $comp;
	}

	/**
	 * @param string|Html|null $caption
	 * @return SubmitButtonInput
	 */
	public function addSubmit(string $name, $caption = null): SubmitButton
	{
		$comp = new SubmitButtonInput($caption);
		$comp->setBtnClass('btn-primary');
		$this->addComponent($comp, $name);

		return $comp;
	}

	/**
	 * @param string|Html|null $label
	 * @param int|null $cols ignored
	 * @param int|null $maxLength ignored
	 * @return TextInput
	 */
	public function addText(string $name, $label = null, ?int $cols = null, ?int $maxLength = null): NetteTextInput
	{
		$comp = new TextInput($label);
		$comp->setNullable(BootstrapForm::$allwaysUseNullable);

		if ($cols !== null) {
			$comp->setHtmlAttribute('cols', $cols);
		}

		if ($maxLength !== null) {
			$comp->setHtmlAttribute('maxlength', $cols);
		}

		$this->addComponent($comp, $name);

		return $comp;
	}

	/**
	 * @param string|Html|null $label
	 * @param int|null $cols ignored
	 * @param int|null $rows ignored
	 * @return TextAreaInput
	 */
	public function addTextArea(string $name, $label = null, ?int $cols = null, ?int $rows = null): TextArea
	{
		$comp = new TextAreaInput($label);
		$comp->setNullable(BootstrapForm::$allwaysUseNullable);

		if ($cols !== null) {
			$comp->setHtmlAttribute('cols', $cols);
		}

		if ($rows !== null) {
			$comp->setHtmlAttribute('rows', $rows);
		}

		$this->addComponent($comp, $name);

		return $comp;
	}

	/**
	 * @param string|Html|null $label
	 * @return UploadInput
	 */
	public function addUpload(string $name, $label = null, bool $multiple = false): UploadControl
	{
		$comp = new UploadInput($label, $multiple);
		$this->addComponent($comp, $name);

		return $comp;
	}

	/**
	 *
	 * @param string $name
	 * @param null|object|string $label
	 * @return TextInput
	 */
	public function addFloat(string $name, $label = null): TextInput
	{
		$input = $this->addText($name, $label);
		$input->setNullable(BootstrapForm::$allwaysUseNullable)
			->addRule(Form::MAX_LENGTH, null, 255)
			->addRule(Form::FLOAT, 'Formát políčka "%s" není v pořádku.', $label);

		return $input;
	}

	/**
	 *
	 * @param string $name
	 * @param string|null $label
	 * @return TextInput
	 */
	public function addNumeric(string $name, ?string $label = null): TextInput
	{
		$input =  $this->addText($name, $label);
		$input->setNullable(BootstrapForm::$allwaysUseNullable)
			->addRule(Form::MAX_LENGTH, null, 255)
			->addRule(Form::NUMERIC, 'Formát políčka "%s" není v pořádku.', $label);

		return $input;
	}

}
