<?php

namespace Hcode;

use Rain\Tpl;

class Page{
    private $tpl, $options = [];
    private $defaults = [
        "data"=>[]
    ];
    // __construct responsavél por criar as views no index.html
    public function __construct($opts=[])
    {
    $this->options = array_merge($this->defaults,$opts);

     $config = [
         "tpl_dir"=>$_SERVER["DOCUMENT_ROOT"] . "/views/",
         "cache_dir"=>$_SERVER["DOCUMENT_ROOT"] . "/cache-views/" 
     ];
     
     Tpl::configure($config);

     $this->tpl = new Tpl;

     $this->setData($this->options["data"]);

     $this->tpl->draw("header");
     
    }

    private function setData($data=[])
    {
        foreach($data as $key => $value ){
            $this->tpl->assign($key,$value);
        }
    }


    public function setTpl($name,$data = [], $returnHTML=false )
    {
        $this->setData($data);
        
       return $this->tpl->draw($name,$returnHTML);
    }

    public function __destruct()
    {
        $this->tpl->draw("footer");
    }

     
}




?>