<?php
/*
Plugin Name: Interactive Animation
Plugin URI: http://site.ery
Author: Artem Palamarchuk
Author URI: http://ffggg.ru
Description: The plugin to make the fine process execution animation, splitted into the pieces(steps)
Version: 1.0
License: GPL2
*/

class Interactive_Animation {
    
    
    public function __construct() {
        $this->id = $this->generateRandomString();
        $this->scenarios = [];
    }
    
    public $scenarios;
    
    public $id;
    
    public function getHtml() {
        include(__DIR__."/idwn/loader.php");
    }
    
    
    public function generateRandomString($length = 10) {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }
    
    public function start() {
        include (__DIR__."/idwn/start.php");
    
    }
    
    public function stop() {
        include (__DIR__."/idwn/stop.php");
    }
    
    public function init_scenarios($atts) {
        $this->scenarios = [];
        $atts = shortcode_atts(['text' => 'Animation action', 'time' => '2000'],$atts,'init_scenarios');
        $i = 0;
        foreach(explode(",",$atts['text']) as $one) {
            $this->scenarios[] = [ 'text' => $one, 'time' => intval ( explode(",",$atts['time'])[$i] ) ];
            ++$i;
        }
        $this->getHtml();
        return json_encode(['text' => $atts['text'], 'time' => $atts['time'], 'id' => $this->id]);
    }
    
    public function int_start($atts) {
        $this->scenarios = [];
        $atts = json_decode($atts['data'],true);
        $this->id = $atts['id'];
        $i = 0;
        foreach(explode(",",$atts['text']) as $one) {
            $this->scenarios[] = [ 'text' => $one, 'time' => intval ( explode(",",$atts['time'])[$i] ) ];
            ++$i;
        }
        $this->start();
    }
    
    
     public function int_stop($atts) {
        $this->scenarios = [];
        $atts = json_decode($atts['data'], true);
        $this->id = $atts['id'];
        $i = 0;
        foreach(explode(",",$atts['text']) as $one) {
            $this->scenarios[] = [ 'text' => $one, 'time' => intval ( explode(",",$atts['time'])[$i] ) ];
            ++$i;
        }
        $this->stop();
    }
    
    
}

define(INT_ANIMATION_URL,plugin_dir_url( __FILE__ ));

add_shortcode('int_animation_init',[new Interactive_Animation(),'init_scenarios']);

add_shortcode('int_animation_start',[new Interactive_Animation(),'int_start']);

add_shortcode('int_animation_stop',[new Interactive_Animation(),'int_stop']);

wp_enqueue_style("int_animation_style",INT_ANIMATION_URL."style.css");

