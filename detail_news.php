<?php

class detailNewsModel{
    public $id = 1;
    public $page = 1;

    public function __construct() {
        if(!empty(@$_GET['id'])){
            $this->id = @$_GET['id'];
        }

        if(!empty(@$_GET['page'])){
            $this->page = @$_GET['page'];
        }
    }

    public function getDetailNews(){
        $dbh = new PDO("mysql:dbname=news;host=localhost:3306","root","root");

        $sql = 'SELECT * FROM news WHERE id='.$this->id.';';

        $sth = $dbh->prepare($sql);
        $sth->execute();
        $array = $sth->fetch();

        return $array;
    }
}

class detailNewsView{
    public function renderDetailNews($array,$page,$url){
        echo('    <div class="bread_crumbs">
        <a class="bread_crumbs_start" href="'.strstr($url,'/detail.php',true).'?page='.$page.'">Главная /</a><a class="bread_crumbs_end">'.$array["title"].'</a>
    </div>

    <div class="detail_block_title">
        <h1>'.$array["title"].'</h1>
    </div>

    <div class="detail_news_wrapper">
    <div class="detail_news">
        <div class="detail_date">
            <time>
            '. strstr($array["date"],' ', true).'
            </time>
        </div>
        <h1 class="detail_news_title">
        '. $array["announce"] .'
        </h1>
        <div class="detail_news_text">
        '. $array["content"] .'
        </div>
        <a href="'.strstr($url,'/detail.php',true).'?page='.$page.'">
            <button class="btn detail_more_btn"> <svg class="btn_arrow" width="26px" height="26px" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" fill="#000000"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <title></title> <g id="Complete"> <g id="arrow-left"> <g> <polyline data-name="Right" fill="none" id="Right-2" points="7.6 7 2.5 12 7.6 17" class="btn_stroke" stroke="#000000" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"></polyline> <line fill="none" class="btn_stroke" stroke="#000000" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" x1="21.5" x2="4.8" y1="12" y2="12"></line> </g> </g> </g> </g></svg> Назад к новостям</button>
        </a>
    </div>
    <img  class="detail_news_img" src="images/'.$array["image"].'">
    </div>');
    }
}