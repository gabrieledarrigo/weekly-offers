<?php
namespace Tests\Darrigo\WeeklyOffers\Repository;

use Darrigo\WeeklyOffers\Model\Product;
use Darrigo\WpPluginUtils\Dao\DbProxy;
use PhpOption\None;
use PhpOption\Option;
use PHPUnit\Framework\TestCase;
use Darrigo\WeeklyOffers\Repository\ProductsRepository;

/**
 * Class ProductsRepositoryTest
 * @package Tests\Darrigo\WeeklyOffers\Repository
 * @author Gabriele D'Arrigo - darrigo.g@gmail.com
 */
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
