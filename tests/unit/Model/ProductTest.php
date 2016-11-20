<?php
namespace Tests\Darrigo\WeeklyOffers\Model;

use PHPUnit\Framework\TestCase;
use Darrigo\WeeklyOffers\Model\Product;

class ProductTest extends TestCase
{
    /**
     * @dataProvider productsProvider
     */
    public function testItMapAProduct($id, $title, $permalink, $externalLink)
    {
        $product = new Product($id, $title, $permalink, $externalLink);

        $this->assertEquals($id, $product->getId());
        $this->assertEquals($title, $product->getTitle());
        $this->assertEquals($permalink, $product->getPermalink());
        $this->assertEquals($externalLink, $product->getExternalLink());
    }

    public function productsProvider()
    {
        return [
            [9611, 'Costume Drago', 'http://mazzucchellis.local/prodotti/costume-drago/', 'http://www.google.com'],
            [9609, 'Costume Masha', 'http://mazzucchellis.local/prodotti/costume-masha/', 'http://www.yahoo.com'],
        ];
    }
}