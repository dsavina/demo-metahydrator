<?php
namespace Demo\Service;

use Demo\Model\Bean\Company;
use Demo\Model\Dao\CompanyDao;
use MetaHydrator\Exception\HydratingException;
use Mouf\Database\TDBM\NoBeanFoundException;
use Mouf\Hydrator\Hydrator;
use Porpaginas\Result;

class CompanyService
{
    /**
     * @var CompanyDao
     */
    private $companyDao;
    /**
     * @var Hydrator
     */
    private $companyHydrator;

    /**
     * CompanyService constructor.
     * @param CompanyDao $companyDao
     * @param Hydrator $companyHydrator
     */
    public function __construct(CompanyDao $companyDao, $companyHydrator)
    {
        $this->companyDao = $companyDao;
        $this->companyHydrator = $companyHydrator;
    }

    /**
     * @return Company[]|Result
     */
    public function getCompanies()
    {
        return $this->companyDao->findAll();
    }

    /**
     * @param $id
     * @return Company
     *
     * @throws NoBeanFoundException
     */
    public function getCompany($id)
    {
        return $this->companyDao->getById(intval($id));
    }

    /**
     * @param array $data
     * @return Company
     *
     * @throws HydratingException
     */
    public function createCompany(array $data)
    {
        /** @var Company $company */
        $company = $this->companyHydrator->hydrateNewObject($data, Company::class);
        $this->companyDao->save($company);
        return$company;
    }

    /**
     * @param Company $company
     * @param array $data
     *
     * @throws HydratingException
     */
    public function editCompany(Company $company, array $data)
    {
        $this->companyHydrator->hydrateObject($data, $company);
        $this->companyDao->save($company);
    }
}