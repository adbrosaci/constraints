<?php declare(strict_types = 1);

namespace Adbros\Constraints\Tests\Cases;

use Adbros\Constraints\Phone;
use Adbros\Constraints\PhoneValidator;
use Symfony\Component\Validator\Test\ConstraintValidatorTestCase;

class PhoneValidatorTest extends ConstraintValidatorTestCase
{

	protected function createValidator(): PhoneValidator
	{
		return new PhoneValidator();
	}

	public function testNullIsValid(): void
	{
		$this->validator->validate(null, new Phone());

		$this->assertNoViolation();
	}

	public function testEmptyStringIsValid(): void
	{
		$this->validator->validate('', new Phone());

		$this->assertNoViolation();
	}

	/**
	 * @dataProvider getValidPhones
	 */
	public function testValidPhones(string $phone): void
	{
		$this->validator->validate($phone, new Phone());

		$this->assertNoViolation();
	}

	/**
	 * @return string[][]
	 */
	public function getValidPhones(): array
	{
		return [
			['+420723123456'],
			['+420606123456'],
		];
	}

	/**
	 * @dataProvider getInvalidPhones
	 */
	public function testInvalidPhones(string $phone): void
	{
		$this->validator->validate($phone, new Phone());

		$this->buildViolation('This value is not a valid phone.')
			->setParameter('{{ value }}', '"' . $phone . '"')
			->assertRaised();
	}

	/**
	 * @return string[][]
	 */
	public function getInvalidPhones(): array
	{
		return [
			['+421723123456'],
			['+421606123456'],
		];
	}

	/**
	 * @dataProvider getValidDefaultRegionPhones
	 */
	public function testValidDefaultRegionPhones(string $phone): void
	{
		$this->validator->validate($phone, new Phone(['defaultRegion' => 'CZ']));

		$this->assertNoViolation();
	}

	/**
	 * @return string[][]
	 */
	public function getValidDefaultRegionPhones(): array
	{
		return [
			['723123456'],
			['606123456'],
		];
	}

	/**
	 * @dataProvider getInvalidDefaultRegionPhones
	 */
	public function testInvalidDefaultRegionPhones(string $phone): void
	{
		$this->validator->validate($phone, new Phone(['defaultRegion' => 'SK']));

		$this->buildViolation('This value is not a valid phone.')
			->setParameter('{{ value }}', '"' . $phone . '"')
			->assertRaised();
	}

	/**
	 * @return string[][]
	 */
	public function getInvalidDefaultRegionPhones(): array
	{
		return [
			['723123456'],
			['606123456'],
		];
	}

}
