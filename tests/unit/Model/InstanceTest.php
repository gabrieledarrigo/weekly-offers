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
        $raw = ['product_id' => 12];
        $instance = new Instance($raw);

        $this->assertEquals($raw, $instance->__toArray());
    }
}