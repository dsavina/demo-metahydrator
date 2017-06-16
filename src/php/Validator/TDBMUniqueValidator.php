<?php
namespace Demo\Validator;

use MetaHydrator\Exception\ValidationException;
use MetaHydrator\Validator\AbstractValidator;
use Mouf\Database\TDBM\DuplicateRowException;
use Mouf\Database\TDBM\TDBMService;

class TDBMUniqueValidator extends AbstractValidator
{
    /**
     * @var TDBMService
     */
    private $tdbmService;
    /**
     * @var string
     */
    private $table;
    /**
     * @var string
     */
    private $column;

    /**
     * TDBMUniqueValidator constructor.
     * @param TDBMService $tdbmService
     * @param string $table
     * @param string $column
     * @param string $errorMessage
     */
    public function __construct(TDBMService $tdbmService, string $table, string $column, $errorMessage = "")
    {
        parent::__construct($errorMessage);
        $this->tdbmService = $tdbmService;
        $this->table = $table;
        $this->column = $column;
    }

    /**
     * @param mixed $value
     * @param $contextObject
     *
     * @throws ValidationException
     */
    public function validate($value, $contextObject = null)
    {
        if ($value !== null && $value !== '') {
            try {
                $conflictedObject = $this->tdbmService->findObject($this->table, "$this->column = :value", ['value' => $value]);
                if ($conflictedObject !== null && $conflictedObject !== $contextObject) {
                    $this->throw();
                }
            } catch (DuplicateRowException $exception) {
                $this->throw();
            }
        }
    }
}