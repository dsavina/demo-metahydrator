<?php
namespace Demo\Service;

use Demo\Model\Bean\Company;
use Demo\Model\Dao\CompanyDao;
use Mouf\Database\TDBM\NoBeanFoundException;
use Porpaginas\Result;

class CompanyService
{
    /**
     * @var CompanyDao
     */
    private $companyDao;

    /**
     * CompanyService constructor.
     * @param CompanyDao $companyDao
     */
    public function __construct(CompanyDao $companyDao)
    {
        $this->companyDao = $companyDao;
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
     */
    public function createCompany(array $data)
    {
        // TODO
        return [
            'todo' => 'everything'
        ];
    }

    /**
     * @param Company $company
     * @param array $data
     */
    public function editCompany(Company $company, array $data)
    {
        // TODO
    }
}