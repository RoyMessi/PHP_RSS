<?php
namespace php_rss\models;

class RSSItemModel extends RSSModel{
    public $title = '';
    public $link = '';
    public $content = '';
    public $description = '';
    public $author = '';
    public $pubDate;

    public function setPubDate($date){
        $this->pubDate = date("D, d M Y H:i:s O", strtotime($date));
    }

    public function setPubDateFromTimestamp($time){
        $this->pubDate = date("D, d M Y H:i:s O", $time);
    }
}