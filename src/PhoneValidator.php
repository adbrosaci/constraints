<?php declare(strict_types = 1);

namespace Adbros\Constraints;

use libphonenumber\NumberParseException;
use libphonenumber\PhoneNumberUtil;
use Nette\Utils\Strings;
use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;
use Symfony\Component\Validator\Exception\UnexpectedTypeException;
use Symfony\Component\Validator\Exception\UnexpectedValueException;

class PhoneValidator extends ConstraintValidator
{

	/**
	 * @param mixed $value
	 */
	public function validate($value, Constraint $constraint): void
	{
		if (!$constraint instanceof Phone) {
			throw new UnexpectedTypeException($constraint, Phone::class);
		}

		if ($value === null || $value === '') {
			return;
		}

		if (!is_string($value)) {
			throw new UnexpectedValueException($value, 'string');
		}

		$phoneNumberUtil = PhoneNumberUtil::getInstance();

		try {
			$phoneNumber = $phoneNumberUtil->parse($value, $constraint->defaultRegion);
			$phoneIsValid = $phoneNumberUtil->isValidNumber($phoneNumber);

		} catch (NumberParseException $e) {
			$phoneIsValid = false;
		}

		if (Strings::match($value, '~[a-z]+~i') !== null) {
			$phoneIsValid = false;
		}

		if (!$phoneIsValid) {
			$this->context->buildViolation($constraint->message)
				->setParameter('{{ value }}', $this->formatValue($value))
				->addViolation();
		}
	}

}
