<?php
namespace Darrigo\WeeklyOffers\Validator;

use Darrigo\WeeklyOffers\Model\Instance;
use Darrigo\WeeklyOffers\Utils\ArrayCheck;
use Darrigo\WeeklyOffers\Utils\IsEmpty;

/**
 * Class InstanceValidator
 * @package Darrigo\WeeklyOffers\Validator
 * @author Gabriele D'Arrigo - darrigo.g@gmail.com
 */
class InstanceValidator
{
    use ArrayCheck, IsEmpty;

    /**
     * @param Instance $instance
     * @return bool
     */
    public function validate(Instance $instance)
    {
        if ($this->isEmpty($instance->__toArray())) {
            return false;
        }

        if (
            $this->isValueSet($instance->__toArray(), Instance::PRODUCT_ID) === false || $this->isEmpty($instance->__toArray()[Instance::PRODUCT_ID])
        ) {
            return false;
        }

        return true;
    }
}