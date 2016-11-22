<?php
namespace Tests\Darrigo\WeeklyOffers\Repository;

use PHPUnit\Framework\TestCase;
use Darrigo\WeeklyOffers\Dao\DbProxy;

/**
 * Class DbProxyTest
 * @package Tests\Darrigo\WeeklyOffers\Repository
 * @author Gabriele D'Arrigo - darrigo.g@gmail.com
 */
class DbProxyTest extends TestCase
{
    protected $wpdb;

    public function setUp()
    {
        $this->wpdb = $this
            ->getMockBuilder(\wpdb::class)
            ->disableOriginalConstructor()
            ->getMock();
    }

    public function testItShouldRunAQueryAgainstWpDb()
    {
        $sql = "SELECT 1";
        $db = new DbProxy($this->wpdb);

        $this->wpdb->expects($this->once())
            ->method('get_results')
            ->with($sql, OBJECT);

        $db->getResults($sql);
    }

    public function testItShouldRunAQueryToRetrieveARow()
    {
        $sql = "SELECT 1";
        $db = new DbProxy($this->wpdb);

        $this->wpdb->expects($this->once())
            ->method('get_row')
            ->with($sql, OBJECT);

        $db->getRow($sql);
    }

    public function testItShouldPrepareAQuery()
    {
        $id = 9799;
        $sql = "SELECT *
                  FROM wp_posts
                  WHERE ID = %d";

        $expectedQuery = sprintf($sql, $id);

        $this->wpdb->expects($this->once())
            ->method('prepare')
            ->with($sql, [$id])
            ->willReturn($expectedQuery);

        $db = new DbProxy($this->wpdb);
        $prepared = $db->prepare($sql, [$id]);

        $this->assertEquals($expectedQuery, $prepared);
    }
}
