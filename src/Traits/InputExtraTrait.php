<?php declare(strict_types = 1);

namespace Contributte\FormsBootstrap\Traits;

use Nette\Utils\Html;

/**
 * Trait InputExtraTrait.
 * Implements extra input functionality
 */
trait InputExtraTrait
{

	/** @var Html|null */
	private $append = null;

	/** @var Html|null */
	private $prepend = null;

	/** @var bool */
	private $inputGroup = false;

	public function getAppend(): ? Html
	{
		return $this->append;
	}

	public function setAppend(?Html $html): self
	{
		$this->append = $html;

		return $this;
	}

	public function getPrepend(): ? Html
	{
		return $this->prepend;
	}

	public function setPrepend(?Html $html): self
	{
		$this->prepend = $html;

		return $this;
	}

	public function getInputGroup(): bool
	{
		return $this->inputGroup;
	}

	public function setInputGroup(bool $inputGroup): self
	{
		$this->inputGroup = $inputGroup;

		return $this;
	}

}
