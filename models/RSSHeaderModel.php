<?php
namespace php_rss\models;

class RSSHeaderModel extends RSSModel{
    public $hostname = '';
    public $title = '';
    public $link = '';
    public $description = '';
    public $language = 'en-us';

    public function getBuildDate(){
        return date("D, d M Y H:i:s O");
    }
}