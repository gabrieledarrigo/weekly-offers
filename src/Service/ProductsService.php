<?php
namespace Darrigo\WeeklyOffers\Service;

use Darrigo\WeeklyOffers\Repository\ProductsRepository;

/**
 * Class ProductsService
 * @package Darrigo\WeeklyOffers\Service
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


    public function getProduct($id)
    {
        return $this->repository->findById($id);
    }
}