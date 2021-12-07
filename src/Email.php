<?php declare(strict_types = 1);

namespace Adbros\Constraints;

use Symfony\Component\Validator\Constraint;

/**
 * @Annotation
 */
class Email extends Constraint
{

	/** @var string */
	public $message = 'This value is not a valid email address.';

}
