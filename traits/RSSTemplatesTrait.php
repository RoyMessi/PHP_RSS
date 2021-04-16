<?php
namespace php_rss\traits;

use \php_rss\models\RssHeaderModel;
use \php_rss\models\RssItemModel;

trait RSSTemplatesTrait{

    private function getCopyright($hostname){
        return 'Copyright (C) '.date('Y').' '.$hostname;
    }

    /**
     * @param RSSHeaderModel $rssHeaderModel
     * @return string
     */
    protected function getHeaderTpl($rssHeaderModel){
        $lastBuildDate = $rssHeaderModel->getBuildDate();
        $copyright = $this->getCopyright($rssHeaderModel->hostname);
        return <<<EOF
<?xml version="1.0" encoding="ISO-8859-1"?>
<rss version="2.0" xmlns:atom="http://www.w3.org/2005/Atom">
<channel>
<atom:link href="https://www.{$rssHeaderModel->hostname}/rss.xml" rel="self" type="application/rss+xml" />
<lastBuildDate>{$lastBuildDate}</lastBuildDate>
<title>{$rssHeaderModel->title}</title>
<link>{$rssHeaderModel->link}</link>
<description>{$rssHeaderModel->description}</description>
<language>{$rssHeaderModel->language}</language>
<copyright>{$copyright}</copyright>

EOF;
    }
    /**
     * @param RSSItemModel $rssItemModel
     * @return string
     */
    protected function getItemTpl($rssItemModel){
        $rtn = "\n<item>\n";
        $rtn.= "<guid>{$rssItemModel->link}</guid>\n";
        $rtn.= "<link>{$rssItemModel->link}</link>\n";
        $rtn.= "<title><![CDATA[{$rssItemModel->title}]]></title>\n";
        if($rssItemModel->author!='')
            $rtn.= "<author><![CDATA[{$rssItemModel->author}]]></author>\n";
        $rtn.= "<pubDate>{$rssItemModel->pubDate}</pubDate>\n";
        if($rssItemModel->content!='')
            $rtn.= "<content:encoded><![CDATA[{$rssItemModel->content}]]></content:encoded>\n";
        if($rssItemModel->description!='')
            $rtn.= "<description:encoded><![CDATA[{$rssItemModel->description}]]></description:encoded>\n";
        $rtn.= "</item>\n";
        return $rtn;
    }
    protected function getFooterTpl(){
        return "\n</channel>\n</rss>";
    }
}