<?php declare(strict_types = 1);

namespace Adbros\Constraints\Tests\Cases;

use Adbros\Constraints\Phone;
use PHPUnit\Framework\TestCase;
use Symfony\Component\Validator\Exception\InvalidArgumentException;

class PhoneTest extends TestCase
{

	public function testDefaultConstructor(): void
	{
		$phone = new Phone();

		$this->assertNull($phone->defaultRegion);
	}

	public function testDefaultRegionConstructor(): void
	{
		$phone = new Phone(['defaultRegion' => 'CZ']);

		$this->assertSame('CZ', $phone->defaultRegion);
	}

	public function testInvalidDefaultRegionConstructor(): void
	{
		$this->expectException(InvalidArgumentException::class);
		$this->expectExceptionMessage('The "defaultRegion" parameter value is not valid.');

		new Phone(['defaultRegion' => 'XX']);
	}

}
