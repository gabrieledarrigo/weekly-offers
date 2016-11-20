<?php
/*
  Plugin Name: Offerte della settimana
  Description: Plugin per la gestione delle offerte della settimana.
  Author: Gabriele D'Arrigo - darrigo.g@gmail.com
  Version: 1.0
 */
require __DIR__ . '/vendor/autoload.php';

add_action('widgets_init', function() {
    register_sidebar([
        'id' => 'sidebar-weekly-offers',
        'name' => 'Offerte della settimana',
        'before_widget' => '',
        'after_widget' => '',
        'before_title' => '',
        'after_title' => ''
    ]);

    return register_widget('Darrigo\WeeklyOffers\WidgetManager');
});