<?php
namespace Darrigo\WeeklyOffers;

use Darrigo\WeeklyOffers\Container\Definitions;
use Darrigo\WeeklyOffers\Model\EmptyResult;
use Darrigo\WeeklyOffers\Model\Instance;
use Darrigo\WeeklyOffers\Model\ViewModel;
use Darrigo\WeeklyOffers\Service\ProductsService;
use Darrigo\WeeklyOffers\Validator\InstanceValidator;
use Darrigo\WeeklyOffers\View\View;
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
        /** @var ViewModel $result */
        $result = $this->productService
            ->getProduct($this->getProductId($instance))
            ->getOrElse(new EmptyResult());

        (new View($this->container->get('view.product'), [
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
            ->getProduct($this->getProductId($instance))
            ->getOrElse(new EmptyResult());

        (new View($this->container->get('view.form'), [
            'fields' => [
                'id' => $this->get_field_id('product_id'),
                'name' => $this->get_field_name('product_id'),
            ],
            'product' => $result->__toArray()
        ]))->render();
    }

    /**
     * @param array $newInstance
     * @param array $oldInstance
     * @return array
     */
    public function update($newInstance, $oldInstance)
    {
        $instance = new Instance($newInstance);

        if ($this->instanceValidator->validate($instance) === false) {
            return (new Instance([Instance::PRODUCT_ID => '']))->__toArray();
        }

        return $instance->__toArray();
    }

    /**
     * @param array $instance
     * @return int|string
     */
    private function getProductId(array $instance)
    {
        return $this->instanceValidator->validate(new Instance($instance))
            ? (int) $instance[Instance::PRODUCT_ID]
            : '';
    }
}