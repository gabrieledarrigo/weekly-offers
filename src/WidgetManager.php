<?php

namespace Darrigo\WeeklyOffers;

use Darrigo\WeeklyOffers\Config\WidgetSettings;
use Darrigo\WeeklyOffers\Container\Definitions;
use Darrigo\WeeklyOffers\Model\EmptyResult;
use Darrigo\WeeklyOffers\Model\ViewModel;
use Darrigo\WeeklyOffers\Service\ProductsService;
use Darrigo\WeeklyOffers\View\View;
use \DI\ContainerBuilder;

/**
 * Class WidgetManager
 * @package Darrigo\WeeklyOffers
 */
class WidgetManager extends \WP_Widget
{
    /**
     * @var string
     */
    public $id = 'wko-widget';

    /**
     * @var \DI\Container
     */
    private $container;

    /**
     * @var ProductsService
     */
    private $productService;

    /**
     * WidgetManager constructor.
     */
    public function __construct()
    {
        // Sorry I cannot inject it since \WP_Widget doesn't accept
        // constructor args : (
        $this->container = (new ContainerBuilder())->addDefinitions(Definitions::defitinion())->build();
        $this->productService = $this->container->get(ProductsService::class);

        parent::__construct(
            $this->id, __(WidgetSettings::TITLE), ['description' => __(WidgetSettings::DESCRIPTION)]
        );
    }

    /**
     * @param array $args
     * @param array $instance
     */
    public function widget($args, $instance)
    {
        /** @var ViewModel $result */
        $result = $this->productService
            ->getProduct(isset($instance['product_id']) ? (int) $instance['product_id'] : null)
            ->getOrElse(new EmptyResult());

//        echo '<pre>';
//        var_dump([
//            'widget' => [
//                'name' => $this->name,
//            ],
//            'product' => $result->__toArray()
//        ]);
//        echo '</pre>';

        (new View(dirname(dirname(__FILE__)) . '/resources/templates/_product.php', [
            'widget' => [
                'name' => $this->name,
            ],
            'product' => $result->__toArray()
        ]))->render();
    }

    /**
     * @param array $instance
     * @return void
     */
    public function form($instance)
    {
        /** @var ViewModel $result */
        $result = $this->productService
            ->getProduct(isset($instance['product_id']) ? (int) $instance['product_id'] : null)
            ->getOrElse(new EmptyResult());

        (new View(dirname(dirname(__FILE__)) . '/resources/templates/_form.php', [
            'fields' => [
                'id' => $this->get_field_id('product_id'),
                'name' => $this->get_field_name('product_id'),
            ],
            'product' => $result->__toArray()
        ]))->render();
    }

    public function update($newInstance, $oldInstance)
    {
        $instance = [];
        $instance['product_id'] = (!empty($newInstance['product_id'])) ? $newInstance['product_id'] : '';
        return $instance;
    }
}