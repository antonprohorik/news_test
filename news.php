<?php
class newsModel{

    public $page = 1;
    public $chunk = 4;
    public $total = 0;
    public $url = '';

    public function __construct($url) {
        $this->url = $url;

        if(!empty(intval(@$_GET["page"]))){
            $this->page = intval($_GET["page"]);
        }
    }

    public function getbanNews(){
        $dbh = new PDO("mysql:dbname=news;host=localhost:3306","root","root");

        $sql = "SELECT * FROM news ORDER BY date DESC LIMIT 0,1;";

        $sth = $dbh->prepare($sql);
        $sth->execute();
        $array = $sth->fetch();
        
        return $array;
    }

    public function getNews(){
        $dbh = new PDO("mysql:dbname=news;host=localhost:3306","root","root");

        $start = ($this->page !=1) ? $this->page * $this->chunk - $this->chunk : 0;

        $sql = "SELECT * FROM news ORDER BY `date` DESC LIMIT ".$start.",4;";
        
        $sth = $dbh->prepare($sql);
        $sth->execute();
        $array = $sth->fetchAll();

        $sth = $dbh->prepare("SELECT COUNT(id) from news");
        $sth->execute();
        $this->total = $sth->fetch()[0];

        return $array;
    }   
}

class newsView{
    public function renderBanNews($array){
        echo('<div class="ban">
                <h1 class="ban_title">'. $array["title"] .'</h1>
                <div class="ban_subtitle">'. $array["announce"] .'</div>
            </div>
            
            <style> .ban{background-image: url(./images/'.$array["image"].')}</style>
            ');
    }


    public function renderNews($array,$url,$page){
        echo('<div class="news">
            <div class="date">
                <time>
                    '. strstr($array["date"],' ', true).'
                </time>
            </div>
            <a href="'.$url .'detail.php'.'?id='.$array["id"].'&page='.$page.'"><h1 class="news_title">
            '. $array["title"] .'
            </h1></a>
            <div class="news_text">
                '. $array["announce"] .'
            </div>
            <a class="more_a" href="'.$url .'detail.php'.'?id='.$array["id"].'&page='.$page.'"><button class="btn more_btn">Подробнее <svg class="btn_arrow" width="32px" height="32px" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" fill="#841844"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <title></title> <g id="Complete"> <g id="arrow-right"> <g> <polyline data-name="Right" fill="none" id="Right-2" points="16.4 7 21.5 12 16.4 17" class="btn_stroke" stroke="#841844" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"></polyline> <line fill="none" class="btn_stroke" stroke="#841844" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" x1="2.5" x2="19.2" y1="12" y2="12"></line> </g> </g> </g> </g></svg></button></a>
            </div>');
    }

    public function renderButtons($total,$page,$url){
        echo('
            <a href="'.($url . "?page=".(($page!=1) ? $page-1:$page)).'">
                <button class="btn page_btn">
                    '.(($page!=1) ? $page-1:$page).'
                </button>
            </a>

            <a href="'.($url . "?page=" .(($page!=1) ? $page:$page+1)).'">
                <button class="btn page_btn">
                    '.(($page!=1) ? $page:$page+1).'
                </button>
            </a>
        ');

        if(($page * 4) < $total){

                echo('            
                <a href="'.($url . "?page=" .(($page!=1) ? $page+1:$page+2)).'">
                    <button class="btn page_btn">
                        '.(($page!=1) ? $page+1:$page+2).'
                    </button>
                </a>
                
                <a href="'.$url.'?page='.($page+1).'">
                <button class="btn next_btn">
                    <div></div>
                </button>
            </a>');
        }

    }
}