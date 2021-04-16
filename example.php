<?php
namespace php_rss;
use php_rss\models\RssHeaderModel;
use php_rss\models\RssItemModel;

spl_autoload_register(function($classname){
    $classname = str_replace('\\','/',$classname);
    $classname = dirname(__DIR__).'/'.$classname.'.php';
    if(file_exists($classname))
        require_once $classname;
});

// From DB...
$data = [
    ['title'=>'Title 1','link'=>'https://www.dsadasdsadsad.com/1'],
    ['title'=>'Title 2','link'=>'https://www.dsadasdsadsad.com/2','pubDate'=>'2021-03-14']
];

$RSS = new RSS();

$rssHeaderModel = new RssHeaderModel([
    'hostname'=>'example-website.com',
    'link'=>'https://my-example.example-website.com',
    'title'=>'RSS lib',
    'description'=>'RSS lib description'
]);

$items = [];
foreach($data as $item)
    $items[] = new RssItemModel($item);

echo $RSS->setHeader($rssHeaderModel)->setItems($items)->build();