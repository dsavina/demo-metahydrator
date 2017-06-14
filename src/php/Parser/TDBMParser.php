<?php
namespace Demo\Parser;

use MetaHydrator\Exception\HydratingException;
use MetaHydrator\Exception\ParsingException;
use Mouf\Database\TDBM\TDBMService;
use Mouf\Hydrator\Hydrator;

class TDBMParser extends TDBMRetriever
{
    /**
     * @var Hydrator
     */
    private $hydrator;

    /**
     * TDBMParser constructor.
     * @param TDBMService $tdbmService
     * @param string $table
     * @param array<string,string> $columnMapping
     * @param Hydrator $hydrator
     * @param string $errorMessage
     */
    public function __construct(TDBMService $tdbmService, $table, array $columnMapping, Hydrator $hydrator, $errorMessage = "")
    {
        parent::__construct($tdbmService, $table, $columnMapping, $errorMessage);
        $this->hydrator = $hydrator;
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
        try {
            return $this->hydrate($rawValue, $object);
        } catch (HydratingException $exception) {
            throw new ParsingException($exception->getErrorsMap());
        }
    }

    protected function hydrate($rawValue, $object)
    {
        if ($object === null) {
            $object = $this->hydrator->hydrateNewObject($rawValue, $this->tdbmService->getBeanClassName($this->table));
        } else {
            $this->hydrator->hydrateObject($rawValue, $object);
        }
        return $object;
    }
}