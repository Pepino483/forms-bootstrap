<?php declare(strict_types = 1);

namespace Contributte\FormsBootstrap\Inputs;

use Contributte\FormsBootstrap\Enums\DateTimeFormat;

/**
 * Class DateTimeInput. Textual datetime input.
 *
 * @property string $format expected PHP format for datetime
 */
class DateTimeInput extends DateInput
{

	/** @var string[] */
	public static $additionalHtmlClasses = [];
	
	/** @var string  */
	public $format = DateTimeFormat::DATETIME;
	
	/**
	 * This errorMessage is added for invalid format
	 *
	 * @var string
	 */
	public $invalidFormatMessage = 'invalid/incorrect datetime format';

	/**
	 * @inheritdoc
	 */
	public function __construct($label = null, ?int $maxLength = null)
	{
		parent::__construct($label, $maxLength);
		
		$this->setHtmlType('datetime-local');
	}
	
}