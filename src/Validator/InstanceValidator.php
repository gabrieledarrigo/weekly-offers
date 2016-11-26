<?php
namespace Darrigo\WeeklyOffers\Validator;

use Darrigo\WeeklyOffers\Model\Instance;
use Darrigo\WpPluginUtils\Utils\ArrayCheck;
use Darrigo\WpPluginUtils\Utils\IsEmpty;

/**
 * Class InstanceValidator
 * @package Darrigo\WeeklyOffers\Validator
 * @author Gabriele D'Arrigo - darrigo.g@gmail.com
 */
class InstanceValidator
{
    use ArrayCheck, IsEmpty;

    const TO_VALIDATE = [
        Instance::PRODUCT_ID,
        Instance::PRODUCT_PRICE
    ];

    public function validate(Instance $instance, $toValidate)
    {
        if ($this->isEmpty($instance->__toArray()) || in_array($toValidate, self::TO_VALIDATE) === false) {
            return false;
        }

        if ($this->isValueSet($instance->__toArray(), $toValidate) === false ||
            $this->isEmpty($instance->__toArray()[$toValidate])
        ) {
            return false;
        }

        return true;
    }
}