<?php
namespace Demo\Controller\Api;

use Demo\Service\CompanyService;
use Mouf\Database\TDBM\NoBeanFoundException;
use Mouf\Mvc\Splash\Annotations\Get;
use Mouf\Mvc\Splash\Annotations\Post;
use Mouf\Mvc\Splash\Annotations\Put;
use Mouf\Mvc\Splash\Annotations\URL;
use Psr\Http\Message\ServerRequestInterface;
use Zend\Diactoros\Response\JsonResponse;

class CompanyApiController
{
    /**
     * @var CompanyService
     */
    private $companyService;

    /**
     * CompanyApiController constructor.
     * @param CompanyService $companyService
     */
    public function __construct(CompanyService $companyService)
    {
        $this->companyService = $companyService;
    }

    /**
     * @param $id
     * @return JsonResponse
     *
     * @URL("api/companies")
     * @GET
     */
    public function getCompanies()
    {
        $companies = $this->companyService->getCompanies();
        return new JsonResponse($companies);
    }

    /**
     * @param $id
     * @return JsonResponse
     *
     * @URL("api/companies/{id}")
     * @GET
     */
    public function getCompany($id)
    {
        try {
            $company = $this->companyService->getCompany($id);
            return new JsonResponse($company);
        } catch (NoBeanFoundException $exception) {
            return new JsonResponse(['error' => 'company not found'], 404);
        }
    }

    /**
     * @param ServerRequestInterface $request
     * @return JsonResponse
     *
     * @URL("api/companies")
     * @POST
     */
    public function createCompany(ServerRequestInterface $request)
    {
        $data = $request->getParsedBody();
        $company = $this->companyService->createCompany($data);
        return new JsonResponse($company, 201);
    }

    /**
     * @param ServerRequestInterface $request
     * @param $id
     * @return JsonResponse
     *
     * @URL("api/companies/{id}")
     * @PUT
     */
    public function editCompany(ServerRequestInterface $request, $id)
    {
        try {
            $company = $this->companyService->getCompany($id);
            $data = $request->getParsedBody();
            $this->companyService->editCompany($company, $data);
            return new JsonResponse($company);
        } catch (NoBeanFoundException $exception) {
            return new JsonResponse(['error' => 'company not found'], 404);
        }
    }
}