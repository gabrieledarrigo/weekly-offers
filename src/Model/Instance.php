<?php
namespace Darrigo\WeeklyOffers\Model;

use Darrigo\WeeklyOffers\Utils\ArrayCheck;
use Darrigo\WeeklyOffers\Utils\IsEmpty;

/**
 * Class Instance
 * @package Darrigo\WeeklyOffers\Model
 * @author Gabriele D'Arrigo - darrigo.g@gmail.com
 */
final class Instance implements ToArray
{
    use ArrayCheck, IsEmpty;

    const PRODUCT_ID = 'product_id';

    /**
     * @var array
     */
    protected $instance = [];

    /**
     * Instance constructor.
     * @param array $instance
     */
    public function __construct(array $instance)
    {
        $this->instance = $instance;
    }

    /**
     * @return array
     */
    public function __toArray()
    {
        return $this->instance;
    }
}