<?php
namespace Demo\Controller\Api;

use Demo\Service\UserService;
use Mouf\Database\TDBM\NoBeanFoundException;
use Mouf\Mvc\Splash\Annotations\Get;
use Mouf\Mvc\Splash\Annotations\Post;
use Mouf\Mvc\Splash\Annotations\Put;
use Mouf\Mvc\Splash\Annotations\URL;
use Psr\Http\Message\ServerRequestInterface;
use Zend\Diactoros\Response\JsonResponse;

class UserApiController
{
    /**
     * @var UserService
     */
    private $userService;

    /**
     * UserApiController constructor.
     * @param UserService $userService
     */
    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    /**
     * @param ServerRequestInterface $request
     * @return JsonResponse
     *
     * @URL("api/users")
     * @GET
     */
    public function getUsers()
    {
        $users = $this->userService->getUsers();
        return new JsonResponse($users);
    }

    /**
     * @param ServerRequestInterface $request
     * @return JsonResponse
     *
     * @URL("api/users/{id}")
     * @GET
     */
    public function getUser($id)
    {
        try {
            $user = $this->userService->getUser($id);
            return new JsonResponse($user);
        } catch (NoBeanFoundException $exception) {
            return new JsonResponse(["error" => "user not found"], 404);
        }
    }

    /**
     * @param ServerRequestInterface $request
     * @return JsonResponse
     *
     * @URL("api/users")
     * @POST
     */
    public function createUser(ServerRequestInterface $request)
    {
        $data = $request->getParsedBody();
        $user = $this->userService->createUser($data);
        return new JsonResponse($user, 201);
    }

    /**
     * @param ServerRequestInterface $request
     * @param $id
     * @return JsonResponse
     *
     * @URL("api/users/{id}")
     * @PUT
     */
    public function editUser(ServerRequestInterface $request, $id)
    {
        try {
            $user = $this->userService->getUser($id);
            $data = $request->getParsedBody();
            $this->userService->editUser($user, $data);
            return new JsonResponse($user);
        } catch (NoBeanFoundException $exception) {
            return new JsonResponse(["error" => "user not found"], 404);
        }
    }
}
