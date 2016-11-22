<?php
namespace Tests\Darrigo\WeeklyOffers\Model;

use PHPUnit\Framework\TestCase;
use Darrigo\WeeklyOffers\Model\Product;

/**
 * Class ProductTest
 * @package Tests\Darrigo\WeeklyOffers\Model
 * @author Gabriele D'Arrigo - darrigo.g@gmail.com
 */
class ProductTest extends TestCase
{
    /**
     * @dataProvider productsProvider
     * @param $id
     * @param $title
     * @param $externalLink
     */
    public function testItMapAProduct($id, $title, $externalLink)
    {
        $product = new Product($id, $title, $externalLink);

        $this->assertEquals($id, $product->getId());
        $this->assertEquals($title, $product->getTitle());
        $this->assertEquals($externalLink, $product->getExternalLink());
    }

    public function productsProvider()
    {
        return [
            [9611, 'Costume Drago', 'http://www.google.com'],
            [9609, 'Costume Masha', 'http://www.yahoo.com'],
        ];
    }
}