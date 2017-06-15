<?php

/*
 * This file has been automatically generated by TDBM.
 * DO NOT edit this file, as it might be overwritten.
 * If you need to perform changes, edit the AddressDao class instead!
 */

namespace Demo\Model\Dao\Generated;

use Mouf\Database\TDBM\TDBMService;
use Mouf\Database\TDBM\ResultIterator;
use Mouf\Database\TDBM\ArrayIterator;
use Demo\Model\Bean\Address;

/**
 * The AbstractAddressDao class will maintain the persistence of Address class into the addresses table.
 *
 */
class AbstractAddressDao
{

    /**
     * @var TDBMService
     */
    protected $tdbmService;

    /**
     * The default sort column.
     *
     * @var string
     */
    private $defaultSort = null;

    /**
     * The default sort direction.
     *
     * @var string
     */
    private $defaultDirection = 'asc';

    /**
     * Sets the TDBM service used by this DAO.
     *
     * @param TDBMService $tdbmService
     */
    public function __construct(TDBMService $tdbmService)
    {
        $this->tdbmService = $tdbmService;
    }

    /**
     * Persist the Address instance.
     *
     * @param Address $obj The bean to save.
     */
    public function save(Address $obj)
    {
        $this->tdbmService->save($obj);
    }

    /**
     * Get all Address records.
     *
     * @return Address[]|ResultIterator|ResultArray
     */
    public function findAll() : iterable
    {
        if ($this->defaultSort) {
            $orderBy = 'addresses.'.$this->defaultSort.' '.$this->defaultDirection;
        } else {
            $orderBy = null;
        }
        return $this->tdbmService->findObjects('addresses', null, [], $orderBy);
    }
    
    /**
     * Get Address specified by its ID (its primary key)
     * If the primary key does not exist, an exception is thrown.
     *
     * @param string|int $id
     * @param bool $lazyLoading If set to true, the object will not be loaded right away. Instead, it will be loaded when you first try to access a method of the object.
     * @return Address
     * @throws TDBMException
     */
    public function getById(int $id, $lazyLoading = false) : Address
    {
        return $this->tdbmService->findObjectByPk('addresses', ['id' => $id], [], $lazyLoading);
    }
    
    /**
     * Deletes the Address passed in parameter.
     *
     * @param Address $obj object to delete
     * @param bool $cascade if true, it will delete all object linked to $obj
     */
    public function delete(Address $obj, $cascade = false) : void
    {
        if ($cascade === true) {
            $this->tdbmService->deleteCascade($obj);
        } else {
            $this->tdbmService->delete($obj);
        }
    }


    /**
     * Get a list of Address specified by its filters.
     *
     * @param mixed $filter The filter bag (see TDBMService::findObjects for complete description)
     * @param array $parameters The parameters associated with the filter
     * @param mixed $orderBy The order string
     * @param array $additionalTablesFetch A list of additional tables to fetch (for performance improvement)
     * @param int $mode Either TDBMService::MODE_ARRAY or TDBMService::MODE_CURSOR (for large datasets). Defaults to TDBMService::MODE_ARRAY.
     * @return Address[]|ResultIterator|ResultArray
     */
    protected function find($filter = null, array $parameters = [], $orderBy=null, array $additionalTablesFetch = [], $mode = null) : iterable
    {
        if ($this->defaultSort && $orderBy == null) {
            $orderBy = 'addresses.'.$this->defaultSort.' '.$this->defaultDirection;
        }
        return $this->tdbmService->findObjects('addresses', $filter, $parameters, $orderBy, $additionalTablesFetch, $mode);
    }

    /**
     * Get a list of Address specified by its filters.
     * Unlike the `find` method that guesses the FROM part of the statement, here you can pass the $from part.
     *
     * You should not put an alias on the main table name. So your $from variable should look like:
     *
     *   "addresses JOIN ... ON ..."
     *
     * @param string $from The sql from statement
     * @param mixed $filter The filter bag (see TDBMService::findObjects for complete description)
     * @param array $parameters The parameters associated with the filter
     * @param mixed $orderBy The order string
     * @param int $mode Either TDBMService::MODE_ARRAY or TDBMService::MODE_CURSOR (for large datasets). Defaults to TDBMService::MODE_ARRAY.
     * @return Address[]|ResultIterator|ResultArray
     */
    protected function findFromSql($from, $filter = null, array $parameters = [], $orderBy = null, $mode = null) : iterable
    {
        if ($this->defaultSort && $orderBy == null) {
            $orderBy = 'addresses.'.$this->defaultSort.' '.$this->defaultDirection;
        }
        return $this->tdbmService->findObjectsFromSql('addresses', $from, $filter, $parameters, $orderBy, $mode);
    }

    /**
     * Get a single Address specified by its filters.
     *
     * @param mixed $filter The filter bag (see TDBMService::findObjects for complete description)
     * @param array $parameters The parameters associated with the filter
     * @param array $additionalTablesFetch A list of additional tables to fetch (for performance improvement)
     * @return Address|null
     */
    protected function findOne($filter = null, array $parameters = [], array $additionalTablesFetch = []) : ?Address
    {
        return $this->tdbmService->findObject('addresses', $filter, $parameters, $additionalTablesFetch);
    }

    /**
     * Get a single Address specified by its filters.
     * Unlike the `find` method that guesses the FROM part of the statement, here you can pass the $from part.
     *
     * You should not put an alias on the main table name. So your $from variable should look like:
     *
     *   "addresses JOIN ... ON ..."
     *
     * @param string $from The sql from statement
     * @param mixed $filter The filter bag (see TDBMService::findObjects for complete description)
     * @param array $parameters The parameters associated with the filter
     * @return Address|null
     */
    protected function findOneFromSql($from, $filter = null, array $parameters = []) : ?Address
    {
        return $this->tdbmService->findObjectFromSql('addresses', $from, $filter, $parameters);
    }

    /**
     * Sets the default column for default sorting.
     *
     * @param string $defaultSort
     */
    public function setDefaultSort(string $defaultSort) : void
    {
        $this->defaultSort = $defaultSort;
    }
}