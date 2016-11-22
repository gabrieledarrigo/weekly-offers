<?php
namespace Darrigo\WeeklyOffers\Service;

use Darrigo\WeeklyOffers\Repository\ProductsRepository;

/**
 * Class ProductsService
 * @package Darrigo\WeeklyOffers\Service
 * @author Gabriele D'Arrigo - darrigo.g@gmail.com
 */
class ProductsService
{
    /**
     * @var ProductsRepository
     */
    protected $repository;

    /**
     * ProductsService constructor.
     * @param ProductsRepository $repository
     */
    public function __construct(ProductsRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @param $id
     * @return \PhpOption\None|\PhpOption\Some
     */
    public function getProduct($id)
    {
        return $this->repository->findById($id);
    }
}