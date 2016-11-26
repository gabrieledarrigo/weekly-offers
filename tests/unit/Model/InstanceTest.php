<?php
namespace Tests\Darrigo\WeeklyOffers\Model;

use Darrigo\WeeklyOffers\Model\Instance;
use PHPUnit\Framework\TestCase;

/**
 * Class InstanceTest
 * @package Tests\Darrigo\WeeklyOffers\Model
 * @author Gabriele D'Arrigo - darrigo.g@gmail.com
 */
class InstanceTest extends TestCase
{
    public function testItServeToBringWidgetData()
    {
        $raw = ['product_id' => 12, 'product_price' => 99.98];
        $instance = new Instance($raw);

        $this->assertEquals($raw, $instance->__toArray());
    }

    public function testItShouldReturnTheInstanceIdOrAnEmptyString()
    {
        $raw = ['product_id' => 12];
        $instance = new Instance($raw);
        $this->assertEquals($raw['product_id'], $instance->getId());

        $instance = new Instance([]);
        $this->assertEquals('', $instance->getId());
    }

    public function testItShouldReturnTheInstancePriceOrAnEmptyString()
    {
        $raw = ['product_price' => 0.99];
        $instance = new Instance($raw);
        $this->assertEquals($raw['product_price'], $instance->getPrice());

        $instance = new Instance([]);
        $this->assertEquals('', $instance->getPrice());
    }
}