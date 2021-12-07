<?php declare(strict_types = 1);

namespace Adbros\Constraints\Tests\Cases;

use Adbros\Constraints\EmailValidator;
use Symfony\Component\Validator\Test\ConstraintValidatorTestCase;

class EmailValidatorTest extends ConstraintValidatorTestCase
{

	protected function createValidator(): EmailValidator
	{
		return new EmailValidator();
	}
}
