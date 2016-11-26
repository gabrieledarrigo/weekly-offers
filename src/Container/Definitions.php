<?php
namespace Darrigo\WeeklyOffers\Container;

use Darrigo\WeeklyOffers\Config\WidgetSettings;
use Darrigo\WeeklyOffers\Repository\ProductsRepository;
use Darrigo\WeeklyOffers\Service\ProductsService;
use Darrigo\WeeklyOffers\Validator\InstanceValidator;
use Darrigo\WpPluginUtils\Dao\DbProxy;

/**
 * Class Definitions
 * @package Darrigo\WeeklyOffers\Container
 * @author Gabriele D'Arrigo - darrigo.g@gmail.com
 */
final class Definitions
{
    /**
     * @return array
     */
    private static function values()
    {
        return [
            'widget.id' => WidgetSettings::ID,
            'widget.title' => WidgetSettings::TITLE,
            'widget.description' => WidgetSettings::DESCRIPTION,
            'view.form' => realpath(dirname(dirname(__DIR__))) . '/resources/templates/_form.php',
            'view.product' => realpath(dirname(dirname(__DIR__))) . '/resources/templates/_product.php',
        ];
    }

    /**
     * @return array
     */
    private static function services()
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
            },
            InstanceValidator::class => function() {
                return new InstanceValidator();
            }
        ];
    }

    /**
     * @return array
     */
    public static function get()
    {
        return array_merge(self::values(), self::services());
    }
}