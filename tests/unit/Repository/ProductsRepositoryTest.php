<?php
namespace Tests\Darrigo\WeeklyOffers\Repository;

use Darrigo\WeeklyOffers\Model\Product;
use PhpOption\None;
use PhpOption\Option;
use PHPUnit\Framework\TestCase;
use Darrigo\WeeklyOffers\Dao\DbProxy;
use Darrigo\WeeklyOffers\Repository\ProductsRepository;

class ProductsRepositoryTest extends TestCase
{
    protected $db;

    public function setUp()
    {
        $this->db = $this
            ->getMockBuilder(DbProxy::class)
            ->disableOriginalConstructor()
            ->getMock();
    }

    public function testItShouldQueryTheDbReturningAnOptionTypeWrappingAProduct()
    {
        $id = 9611;
        $sql = "SELECT
            p.ID AS id,
            p.post_title AS title,
            p.post_name AS permalink,
            (SELECT pm.meta_value FROM wp_postmeta AS pm WHERE pm.post_id = p.ID AND pm.meta_key = 'link_shop') AS external_link
        FROM wp_posts AS p
        WHERE p.ID = %d";

        $expectedQuery = sprintf($sql, $id);

        $this->db->expects($this->once())
            ->method('prepare')
            ->with($sql, [$id])
            ->willReturn($expectedQuery);

        $this->db->expects($this->once())
            ->method('getRow')
            ->with($this->equalTo($expectedQuery))
            ->willReturn((object) [
                'id' => $id,
                'title' => 'Costume Drago',
                'permalink' => 'http://mazzucchellis.local/prodotti/costume-drago/',
                'external_link' => 'http://www.google.com'
            ]);

        $repository = new ProductsRepository($this->db);
        $result = $repository->findById($id);

        $this->assertInstanceOf(Option::class, $result);
        $this->assertInstanceOf(Product::class, $result->get());
        $this->assertEquals($id, $result->get()->getId());
    }

    public function testItShouldQueryTheDbReturningAnOptionTypeWrappingAnEmptyValue()
    {
        $id = 9799;
        $sql = "SELECT
            p.ID AS id,
            p.post_title AS title,
            p.post_name AS permalink,
            (SELECT pm.meta_value FROM wp_postmeta AS pm WHERE pm.post_id = p.ID AND pm.meta_key = 'link_shop') AS external_link
        FROM wp_posts AS p
        WHERE p.ID = %d";

        $expectedQuery = sprintf($sql, $id);

        $this->db->expects($this->once())
            ->method('prepare')
            ->with($sql, [$id])
            ->willReturn($expectedQuery);

        $this->db->expects($this->once())
            ->method('getRow')
            ->with($this->equalTo($expectedQuery))
            ->willReturn(null);

        $repository = new ProductsRepository($this->db);
        $result = $repository->findById($id);

        $this->assertInstanceOf(Option::class, $result);
        $this->assertInstanceOf(None::class, $result);
        $this->assertTrue($result->isEmpty());
    }
}