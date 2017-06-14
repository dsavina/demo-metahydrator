<?php
namespace Demo\Validator;

use MetaHydrator\Exception\ValidationException;
use MetaHydrator\Validator\AbstractValidator;

class RegexValidator extends AbstractValidator
{
    /**
     * @var string
     */
    private $pattern;

    /**
     * RegexValidator constructor.
     * @param string $pattern
     * @param string $errorMessage
     */
    public function __construct(string $pattern, $errorMessage = "")
    {
        parent::__construct($errorMessage);
        $this->pattern = $pattern;
    }

    /**
     * @param mixed $value
     * @param $contextObject
     *
     * @throws ValidationException
     */
    public function validate($value, $contextObject = null)
    {
        if ($value === null || $value === "") {
            return;
        }
        if (!preg_match($this->pattern, strval($value))) {
            $this->throw();
        }
    }
}
