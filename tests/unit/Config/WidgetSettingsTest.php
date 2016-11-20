<?php
namespace Tests\Darrigo\WeeklyOffers\Config;

use PHPUnit\Framework\TestCase;
use Darrigo\WeeklyOffers\Config\WidgetSettings;

class WidgetSettingsTest extends TestCase
{
    public function testProperties()
    {
        $this->assertNotNull(WidgetSettings::TITLE);
        $this->assertNotNull(WidgetSettings::DESCRIPTION);
    }
}