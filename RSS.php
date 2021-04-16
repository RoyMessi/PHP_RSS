<?php
namespace php_rss;

use \php_rss\models\RssHeaderModel;
use \php_rss\models\RssItemModel;

class RSS{
    use \php_rss\traits\RSSTemplatesTrait;

    /**
     * @var RssHeaderModel
     */
    private $rssHeaderModel;

    /**
     * @var array<RssItemModel>
     */
    private $items = [];

    private $activePreviewMode = false;

    /**
     * @return RssHeaderModel
     */
    protected function getRssHeaderModel(){
        return $this->rssHeaderModel;
    }

    /**
     * @param RssHeaderModel $rssHeaderModel
     * @return $this
     * @throws InvalidArgumentException
     */
    public function setHeader(RssHeaderModel $rssHeaderModel){
        if(! $rssHeaderModel instanceof RssHeaderModel)
            throw new InvalidArgumentException("rssHeaderModel isn't an instance of RssHeaderModel");
        $this->rssHeaderModel = $rssHeaderModel;
        return $this;
    }
    
    /**
     * @param Array<RssItemModel> $data
     */
    public function setItems(array $data=[]){
        $this->items = [];
        foreach($data as $value){
            if(! $value instanceof RssItemModel)
                continue;
            $this->items[] = $value;
        }
        return $this;
    }

    /**
     * @param bool $bool
     * @return $this
     */
    public function activePreviewMode($bool=true){
        if(!is_bool($bool))
            throw new InvalidArgumentException('bool is not a Boolean');
        $this->activePreviewMode = $bool;
        return $this;
    }

    /**
     * @param String $rtn
     */
    private function previewMode($rtn){
        header('Content-Type: text/plain');
        return $rtn;
    }


    /**
     * @return String
     */
    public function build(){
        if(is_null($this->rssHeaderModel))
            throw new InvalidArgumentException('rssHeaderModel cannot be NULL');
        $rtn = $this->getHeaderTpl($this->rssHeaderModel);
        foreach($this->items as $item)
            $rtn.=$this->getItemTpl($item);
        $rtn.=$this->getFooterTpl();

        if($this->activePreviewMode)
            return $this->previewMode($rtn);
        return $rtn;
    }
}