<?php declare(strict_types = 1);

namespace Contributte\FormsBootstrap;

use Contributte\FormsBootstrap\Enums\BootstrapVersion;
use Contributte\FormsBootstrap\Traits\AddRowTrait;
use Contributte\FormsBootstrap\Traits\BootstrapContainerTrait;
use Nette\Application\UI\Form;
use Nette\ComponentModel\IContainer;
use Nette\Forms\FormRenderer;
use Nette\InvalidArgumentException;
use Nette\Utils\Html;

/**
 * Form rendered using Bootstrap 5
 *
 * @property bool $ajax
 * @property int  $renderMode
 * @property bool $showValidation     If valid fields should explicitly be green if valid
 * @property bool $autoShowValidation If true, valid inputs will be explicitly green on unsuccessful submit
 * @property bool $showFormFeedback	  If true, render form feedback before form
 */
class BootstrapForm extends Form
{

	use BootstrapContainerTrait;
	use AddRowTrait;

	/** @var string Class to be added if this is ajax. Defaults to 'ajax' */
	public $ajaxClass = 'ajax';

	/** @var Html */
	protected $elementPrototype;

	/** @var bool */
	private $isAjax = true;

	/** @var bool */
	private $showValidation = false;

	/** @var bool */
	private $autoShowValidation = true;
	
	/** @var bool */
	private $controlValidation = true;
	
	/** @var bool */
	private $showControlFeedback = true;
	
	/** @var bool */
	private $showFormFeedback = true;

	/** @var bool */
	public static $allwaysUseNullable = false;

	/** @var int */
	private static $bootstrapVersion = BootstrapVersion::V5;

	/**
	 * @param IContainer|null $container
	 */
	public function __construct($container = null)
	{
		parent::__construct($container);
		$this->setRenderer(new BootstrapRenderer());

		$prototype = Html::el('form', [
			'action' => '',
			'method' => self::POST,
			'class'  => [],
		]);
		$this->elementPrototype = $prototype;

		/**
		 * @param BootstrapForm $form
		 */
		$this->onError[] = function ($form): void {
			$form->showValidation = $this->autoShowValidation;
		};
	}

	public static function switchBootstrapVersion(int $version): void
	{
		self::$bootstrapVersion = in_array($version, [BootstrapVersion::V4, BootstrapVersion::V5], true)
			? $version
			: BootstrapVersion::V4;
	}

	public static function getBootstrapVersion(): int
	{
		return self::$bootstrapVersion;
	}

	public function getElementPrototype(): Html
	{
		return $this->elementPrototype;
	}


	/**
	 * @return BootstrapRenderer
	 */
	public function getRenderer(): FormRenderer
	{
		/** @var BootstrapRenderer $renderer */
		$renderer = parent::getRenderer();

		return $renderer;
	}

	/**
	 * @return static
	 */
	public function setRenderer(?FormRenderer $renderer = null)
	{
		if (!$renderer instanceof BootstrapRenderer) {
			throw new InvalidArgumentException('Renderer must be a BootstrapRenderer class');
		}

		parent::setRenderer($renderer);

		return $this;
	}

	public function getRenderMode(): int
	{
		return $this->getRenderer()->getMode();
	}

	/**
	 * @return bool if form is ajax. True by default.
	 */
	public function isAjax(): bool
	{
		return $this->isAjax;
	}

	public function isAutoShowValidation(): bool
	{
		return $this->autoShowValidation;
	}

	public function setAutoShowValidation(bool $autoShowValidation): BootstrapForm
	{
		$this->autoShowValidation = $autoShowValidation;

		return $this;
	}
	
	/**
	 * If valid fields should explicitly be green
	 */
	public function isShowValidation(): bool
	{
		return $this->showValidation;
	}

	/**
	 * If valid fields should explicitly be green
	 *
	 * @return static
	 */
	public function setShowValidation(bool $showValidation)
	{
		$this->showValidation = $showValidation;

		return $this;
	}

	public function isControlValidation(): bool
	{
		return $this->controlValidation;
	}
	
	public function setControlValidation(bool $controlValidation): BootstrapForm
	{
		$this->controlValidation = $controlValidation;
		
		return $this;
	}
	
	public function isShowControlFeedback(): bool
	{
		return $this->showControlFeedback;
	}
	
	public function setShowControlFeedback(bool $showControlFeedback): BootstrapForm
	{
		$this->showControlFeedback = $showControlFeedback;
		
		return $this;
	}
	
	public function isShowFormFeedback(): bool
	{
		return $this->showFormFeedback;
	}
	
	public function setShowFormFeedback(bool $showFormFeedback): BootstrapForm
	{
		$this->showFormFeedback = $showFormFeedback;
		
		return $this;
	}

	/**
	 * @return static
	 */
	public function setAjax(bool $isAjax = true)
	{
		$this->isAjax = $isAjax;

		BootstrapUtils::standardizeClass($this->getElementPrototype());
		$prototypeClass = $this->getElementPrototype()->class;

		$present = in_array($this->ajaxClass, $prototypeClass);
		if ($present && !$isAjax) {
			// remove the class
			$prototypeClass = array_diff($prototypeClass, [$this->ajaxClass]);
		} elseif (!$present && $isAjax) {
			// add class
			$prototypeClass[] = $this->ajaxClass;
		}

		$this->getElementPrototype()->class = $prototypeClass;

		return $this;
	}

	/**
	 * @return static
	 */
	public function setRenderMode(int $renderMode)
	{
		$this->getRenderer()->setMode($renderMode);

		return $this;
	}

}
