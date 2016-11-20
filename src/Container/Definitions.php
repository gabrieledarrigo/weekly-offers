<?php

namespace Darrigo\WeeklyOffers\Container;

use Darrigo\WeeklyOffers\Dao\DbProxy;
use Darrigo\WeeklyOffers\Repository\ProductsRepository;
use Darrigo\WeeklyOffers\Service\ProductsService;

final class Definitions
{
    public static final function definition()
    {
        return [
            DbProxy::class => function() {
                global $wpdb;
                return new DbProxy($wpdb);
            },
            ProductsRepository::class => function(DbProxy $dbProxy) {
                return new ProductsRepository($dbProxy);
            },
            ProductsService::class => function(ProductsRepository $productsRepository) {
                return new ProductsService($productsRepository);
            }
        ];
    }
}