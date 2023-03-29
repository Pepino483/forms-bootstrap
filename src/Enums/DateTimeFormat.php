<?php declare(strict_types = 1);

namespace Contributte\FormsBootstrap\Enums;

use DateTime;

class DateTimeFormat
{

	public const DATE = 'Y-m-d';
	public const DATETIME = 'Y-m-d\TH:i:s';

	public const MYSQL_WITH_MICROSECONDS = 'Y-m-d H:i:s.u';
	public const MYSQL_WITHOUT_MICROSECONDS = 'Y-m-d H:i:s';

	/**
	 * Checks if give time string is indeed in the format specified.
	 * Some leading zeros check might be omitted.
	 */
	public static function validate(string $format, string $timeString): bool
	{
		$time = DateTime::createFromFormat($format, $timeString);

		return ($time !== false) && ($timeString === $time->format($format));
	}
	
}