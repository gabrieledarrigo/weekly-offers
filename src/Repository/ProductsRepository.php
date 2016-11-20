<?php
namespace Darrigo\WeeklyOffers\Repository;

use Darrigo\WeeklyOffers\Dao\DbProxy;
use Darrigo\WeeklyOffers\Model\Product;
use PhpOption\None;
use PhpOption\Some;

/**
 * Class ProductRepository
 * @package Darrigo\WeeklyOffers\Repository
 */
class ProductsRepository implements FindableInterface
{
    /**
     * @var DbProxy
     */
    protected $db;

    /**
     * ProductRepository constructor.
     * @param DbProxy $db
     */
    public function __construct(DbProxy $db)
    {
        $this->db = $db;
    }

    /**
     * @param $id
     * @return None|Some
     */
    public function findById($id)
    {
        $sql = "SELECT
            p.ID AS id,
            p.post_title AS title,
            p.post_name AS permalink,
            (SELECT pm.meta_value FROM wp_postmeta AS pm WHERE pm.post_id = p.ID AND pm.meta_key = 'link_shop') AS external_link
        FROM wp_posts AS p
        WHERE p.ID = %d";
        $query = $this->db->prepare($sql, [$id]);
        $result = $this->db->getRow($query);

        if ($result === null) {
            return None::create();
        }

        return new Some(new Product($result->id, $result->title, $result->permalink, $result->external_link));
    }
}