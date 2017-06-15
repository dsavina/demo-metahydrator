<?php
namespace Demo\Service;

use Demo\Model\Bean\User;
use Demo\Model\Dao\UserDao;
use Mouf\Database\TDBM\NoBeanFoundException;
use Porpaginas\Result;

class UserService
{
    /**
     * @var UserDao
     */
    private $userDao;

    /**
     * UserService constructor.
     * @param UserDao $userDao
     */
    public function __construct(UserDao $userDao)
    {
        $this->userDao = $userDao;
    }

    /**
     * @return User[]|Result
     */
    public function getUsers()
    {
        return $this->userDao->findAll();
    }

    /**
     * @param $id
     * @return User
     *
     * @throws NoBeanFoundException
     */
    public function getUser($id)
    {
        return $this->userDao->getById(intval($id));
    }

    /**
     * @param $data
     * @return User
     */
    public function createUser($data)
    {
        // TODO
        return [
            'todo' => 'everything'
        ];
    }

    /**
     * @param User $user
     * @param array $data
     */
    public function editUser(User $user, array $data)
    {
        // TODO
    }
}