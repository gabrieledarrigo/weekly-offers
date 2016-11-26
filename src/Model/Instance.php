<?php
namespace Darrigo\WeeklyOffers\Model;

use Darrigo\WpPluginUtils\Model\ToArray;
use Darrigo\WpPluginUtils\Utils\ArrayCheck;
use Darrigo\WpPluginUtils\Utils\IsEmpty;


/**
 * Class Instance
 * @package Darrigo\WeeklyOffers\Model
 * @author Gabriele D'Arrigo - darrigo.g@gmail.com
 */
final class Instance implements ToArray
{
    use ArrayCheck, IsEmpty;

    const PRODUCT_ID = 'product_id';

    const PRODUCT_PRICE = 'product_price';

    const EMPTY_VALUE = '';

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
     * @return mixed
     */
    public function getId()
    {
        return $this->isValueSet($this->instance, self::PRODUCT_ID)
            ? $this->instance[self::PRODUCT_ID]
            : self::EMPTY_VALUE;
    }

    /**
     * @return mixed
     */
    public function getPrice()
    {
        return $this->isValueSet($this->instance, self::PRODUCT_PRICE)
            ? $this->instance[self::PRODUCT_PRICE]
            : self::EMPTY_VALUE;
    }

    /**
     * @return array
     */
    public function __toArray()
    {
        return [
            self::PRODUCT_ID => $this->getId(),
            self::PRODUCT_PRICE => $this->getPrice(),
        ];
    }
}