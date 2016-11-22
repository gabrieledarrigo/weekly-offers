<?php
namespace Tests\Darrigo\WeeklyOffers\Service;

use Darrigo\WeeklyOffers\Model\Instance;
use Darrigo\WeeklyOffers\Validator\InstanceValidator;
use PHPUnit\Framework\TestCase;

/**
 * Class InstanceValidatorTest
 * @package Tests\Darrigo\WeeklyOffers\Service
 * @author Gabriele D'Arrigo - darrigo.g@gmail.com
 */
class InstanceValidatorTest extends TestCase
{
    /**
     * @dataProvider validProvider
     * @param Instance $instance
     */
    public function testItShouldReturnTrueIfInstanceProductIdIsValid(Instance $instance)
    {
        $validator = new InstanceValidator();
        $this->assertTrue($validator->validate($instance));
    }

    /**
     * @dataProvider invalidProvider
     * @param Instance $instance
     */
    public function testItShouldReturnFalseIfInstanceProductIdIsValid(Instance $instance)
    {
        $validator = new InstanceValidator();
        $this->assertFalse($validator->validate($instance));
    }

    /**
     * @return array
     */
    public function validProvider()
    {
        return [
            [new Instance(['product_id' => 12])],
            [new Instance(['product_id' => true])],
            [new Instance(['product_id' => '123123'])],
        ];
    }

    /**
     * @return array
     */
    public function invalidProvider()
    {
        return [
            [new Instance([])],
            [new Instance([0])],
            [new Instance(['product_id' => ''])],
            [new Instance(['productid' => 12])],
            [new Instance(['produc_tid' => 12])],
        ];
    }
}
