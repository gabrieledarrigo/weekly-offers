<?php
namespace Tests\Darrigo\WeeklyOffers\Config;

use PHPUnit\Framework\TestCase;
use Darrigo\WeeklyOffers\Config\WidgetSettings;

/**
 * Class WidgetSettingsTest
 * @package Tests\Darrigo\WeeklyOffers\Config
 * @author Gabriele D'Arrigo - darrigo.g@gmail.com
 */
class WidgetSettingsTest extends TestCase
{
    public function testProperties()
    {
        $this->assertNotNull(WidgetSettings::ID);
        $this->assertNotNull(WidgetSettings::TITLE);
        $this->assertNotNull(WidgetSettings::DESCRIPTION);
    }
}