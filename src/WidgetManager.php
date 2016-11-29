<?php
namespace Darrigo\WeeklyOffers;

use Darrigo\WeeklyOffers\Container\Definitions;
use Darrigo\WeeklyOffers\Model\Instance;
use Darrigo\WeeklyOffers\Model\Product;
use Darrigo\WeeklyOffers\Service\ProductsService;
use Darrigo\WeeklyOffers\Validator\InstanceValidator;
use Darrigo\WpPluginUtils\Model\Collection;
use Darrigo\WpPluginUtils\Model\EmptyResult;
use Darrigo\WpPluginUtils\View\View;
use \DI\ContainerBuilder;

/**
 * Class WidgetManager
 * @package Darrigo\WeeklyOffers
 * @author Gabriele D'Arrigo - darrigo.g@gmail.com
 */
class WidgetManager extends \WP_Widget
{
    /**
     * @var \DI\Container
     */
    private $container;

    /**
     * @var ProductsService
     */
    private $productService;

    /**
     * @var InstanceValidator
     */
    private $instanceValidator;

    /**
     * WidgetManager constructor.
     */
    public function __construct()
    {
        // Sorry I cannot inject it since \WP_Widget doesn't accept
        // constructor args : (
        $this->container = (new ContainerBuilder())->addDefinitions(Definitions::get())->build();
        $this->productService = $this->container->get(ProductsService::class);
        $this->instanceValidator = $this->container->get(InstanceValidator::class);

        parent::__construct(
            $this->container->get('widget.id'),
            $this->container->get('widget.title'),
            ['description' => $this->container->get('widget.description')]
        );
    }

    /**
     * @param array $args
     * @param array $instance
     */
    public function widget($args, $instance)
    {
        $instance = new Instance($instance);

        /** @var Product $result */
        $result = $this->productService
            ->getProduct($instance->getId())
            ->getOrElse(new EmptyResult());

        (new View($this->container->get('view.product'), new Collection([
            'widget' => [
                'name' => $this->name,
            ],
            'product' => array_merge($result->__toArray(), [
                'price' => $instance->getPrice()
            ])
        ])))->render();
    }

    /**
     * @param array $instance
     * @return void
     */
    public function form($instance)
    {
        $instance = new Instance($instance);

        /** @var Product $result */
        $result = $this->productService
            ->getProduct($instance->getId())
            ->getOrElse(new EmptyResult());

        (new View($this->container->get('view.form'), new Collection([
            'fields' => [
                'product_id' => [
                    'id' => $this->get_field_id('product_id'),
                    'name' => $this->get_field_name('product_id'),
                ],
                'product_price' => [
                    'id' => $this->get_field_id('product_price'),
                    'name' => $this->get_field_name('product_price'),
                ]
            ],
            'product' => array_merge($result->__toArray(), [
                'price' => $instance->getPrice()
            ])
        ])))->render();
    }

    /**
     * @param array $newInstance
     * @param array $oldInstance
     * @return array
     */
    public function update($newInstance, $oldInstance)
    {
        $instance = new Instance($newInstance);
        return $instance->__toArray();
    }
}