<?php declare(strict_types = 1);

namespace Adbros\Constraints;

use Nette\Utils\Validators;
use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\Constraints\Email;
use Symfony\Component\Validator\ConstraintValidator;
use Symfony\Component\Validator\Exception\UnexpectedTypeException;
use Symfony\Component\Validator\Exception\UnexpectedValueException;

class EmailValidator extends ConstraintValidator
{

	/**
	 * @param mixed $value
	 */
	public function validate($value, Constraint $constraint): void
	{
		if (!$constraint instanceof Email) {
			throw new UnexpectedTypeException($constraint, Email::class);
		}

		if ($value === null || $value === '') {
			return;
		}

		if (!is_string($value)) {
			throw new UnexpectedValueException($value, 'string');
		}

		if (!Validators::isEmail($value)) {
			$this->context->buildViolation($constraint->message)
				->setParameter('{{ value }}', $this->formatValue($value))
				->addViolation();
		}
	}

}
