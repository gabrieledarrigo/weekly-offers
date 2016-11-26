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
    public function testItShouldReturnTrueIfInstanceProductIdAndPriceAreValid(Instance $instance)
    {
        $validator = new InstanceValidator();
        $this->assertTrue($validator->validate($instance, Instance::PRODUCT_ID));
        $this->assertTrue($validator->validate($instance, Instance::PRODUCT_PRICE));
    }

    /**
     * @dataProvider invalidProvider
     * @param Instance $instance
     */
    public function testItShouldReturnFalseIfInstanceProductIdAndPriceAreValid(Instance $instance)
    {
        $validator = new InstanceValidator();
        $this->assertFalse($validator->validate($instance, Instance::PRODUCT_ID));
        $this->assertFalse($validator->validate($instance, Instance::PRODUCT_PRICE));
    }

    /**
     * @return array
     */
    public function validProvider()
    {
        return [
            [new Instance([
                'product_id' => 12,
                'product_price' => 99
            ])],
            [new Instance([
                'product_id' => true,
                'product_price' => 1

            ])],
            [new Instance([
                'product_id' => '123123',
                'product_price' => 999.123
            ])],[new Instance([
                'product_id' => '123123',
                'product_price' => 0.0000000000000000000000001
            ])],
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
            [new Instance([
                'produc_tid' => 12,
                'product_price' => ''
            ])],
            [new Instance([
                'product_id' => false,
                'product_price' => null
            ])],
            [new Instance([
                'product_id' => null,
                'productsss_price' => 1
            ])],
        ];
    }
}
