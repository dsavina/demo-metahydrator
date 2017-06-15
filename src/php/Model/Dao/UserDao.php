<?php

/*
 * This file has been automatically generated by TDBM.
 * You can edit this file as it will not be overwritten.
 */

namespace Demo\Model\Dao;

use Demo\Model\Bean\User;
use Demo\Model\Dao\Generated\AbstractUserDao;

/**
 * The UserDao class will maintain the persistence of User class into the users table.
 */
class UserDao extends AbstractUserDao
{
    /**
     * @inheritdoc
     */
    public function save(User $obj)
    {
        if ($obj->getAddress() !== null) {
            $this->tdbmService->save($obj->getAddress());
        }
        parent::save($obj);
    }

    /**
     * @inheritdoc
     */
    public function delete(User $obj, $cascade = false): void
    {
        if ($obj->getAddress() !== null) {
            $this->tdbmService->delete($obj->getAddress());
        }
        parent::delete($obj, $cascade);
    }
}