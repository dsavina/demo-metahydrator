<?php
namespace Demo\Service;

use Demo\Model\Bean\User;
use Demo\Model\Dao\UserDao;
use Mouf\Database\TDBM\NoBeanFoundException;
use Mouf\Hydrator\Hydrator;
use Porpaginas\Result;

class UserService
{
    /**
     * @var UserDao
     */
    private $userDao;
    /**
     * @var Hydrator
     */
    private $userHydrator;

    /**
     * UserService constructor.
     * @param UserDao $userDao
     * @param Hydrator $userHydrator
     */
    public function __construct(UserDao $userDao, $userHydrator)
    {
        $this->userDao = $userDao;
        $this->userHydrator = $userHydrator;
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
        /** @var User $user */
        $user = $this->userHydrator->hydrateNewObject($data, User::class);
        $this->userDao->save($user);
        return $user;
    }

    /**
     * @param User $user
     * @param array $data
     */
    public function editUser(User $user, array $data)
    {
        $this->userHydrator->hydrateObject($data, $user);
        $this->userDao->save($user);
    }
}