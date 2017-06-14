<?php
namespace Demo\Parser;

use MetaHydrator\Exception\ParsingException;
use MetaHydrator\Parser\AbstractParser;
use Mouf\Database\TDBM\TDBMService;

class TDBMRetriever extends AbstractParser
{
    /**
     * @var TDBMService
     */
    protected $tdbmService;
    /**
     * @var string
     */
    protected $table;
    /**
     * @var array<string,string>
     */
    protected $columnMapping;

    /**
     * TDBMRetriever constructor.
     * @param TDBMService $tdbmService
     * @param string $table
     * @param array<string,string> $columnMapping
     * @param string $errorMessage
     */
    public function __construct(TDBMService $tdbmService, string $table, array $columnMapping, $errorMessage = "")
    {
        parent::__construct($errorMessage);
        $this->tdbmService = $tdbmService;
        $this->table = $table;
        $this->columnMapping = $columnMapping;
    }

    /**
     * @param $rawValue
     * @return mixed
     *
     * @throws ParsingException
     */
    public function parse($rawValue)
    {
        if ($rawValue === null || $rawValue === []) {
            return null;
        }
        if (!is_array($rawValue)) {
            throw new ParsingException($this->getErrorMessage());
        }
        $object = $this->retrieveObject($rawValue);
        if ($object !== null) {
            return $object;
        } else {
            throw new ParsingException($this->getErrorMessage());
        }
    }

    /**
     * @param array $params
     * @return \Mouf\Database\TDBM\AbstractTDBMObject|null
     */
    protected function retrieveObject(array $params)
    {
        $clauses = [];
        $sqlParams = [];
        $i = 0;
        foreach ($this->columnMapping as $key => $column) {
            if (!isset($params[$key])) {
                return null;
            }
            $value = $params[$key];
            if (!is_scalar($value)) {
                $this->throw();
            }
            $sqlParams["p$i"] = $value;
            $clauses[] = "$this->table.$column = :p$i";
        }
        return $this->tdbmService->findObject($this->table, implode(' AND ', $clauses), $sqlParams);
    }
}