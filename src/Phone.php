<?php declare(strict_types = 1);

namespace Adbros\Constraints;

use libphonenumber\PhoneNumberUtil;
use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\Exception\InvalidArgumentException;

/**
 * @Annotation
 */
class Phone extends Constraint
{

	/** @var string */
	public $message = 'This value is not a valid phone.';

	/** @var string|null */
	public $defaultRegion;

	public function __construct(
		$options = null,
		array $groups = null, // phpcs:ignore SlevomatCodingStandard.TypeHints.NullableTypeForNullDefaultValue.NullabilitySymbolRequired
		$payload = null,
		string $defaultRegion = null // phpcs:ignore SlevomatCodingStandard.TypeHints.NullableTypeForNullDefaultValue.NullabilitySymbolRequired
	)
	{
		if (is_array($options) && array_key_exists('defaultRegion', $options) && (PhoneNumberUtil::getInstance())->getCountryCodeForRegion($options['defaultRegion']) === 0) {
			throw new InvalidArgumentException('The "defaultRegion" parameter value is not valid.');
		}

		parent::__construct($options, $groups, $payload);

		$this->defaultRegion = $defaultRegion ?? $this->defaultRegion;
	}

}
