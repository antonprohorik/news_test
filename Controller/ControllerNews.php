<?php

namespace Controller;

class ControllerNews 
{
    private $model;
    private $baseUrl; 

    public function __construct()
    {
        $this->model = new \Model\ModelNews();
        $this->baseUrl = 'http://test.prokhorik/'; 
    }

    public function actionList($page = 1)
    {
        $chunk = 4;
        $offset = ($page - 1) * $chunk;

        $news = $this->model->getRows($chunk, $offset);
        $total = $this->model->getCount();
        $banNews = $this->model->getLast();

        foreach ($news as &$item) {
            $item['image_url'] = $this->baseUrl . 'images/' . $item['image'];
        }

        foreach ($banNews as &$newsItem) {
            $newsItem['image_url'] = $this->baseUrl . 'images/' . $newsItem['image'];
        }

        $data = compact('news', 'total', 'banNews', 'page', 'chunk');
        $this->renderView('List.php', $data);
    }

    public function actionDetail($id)
    {
        $detailNews = $this->model->getItem((int)$id);
        $detailNews['image_url'] = $this->baseUrl . 'images/' . $detailNews['image'];

        $mainPageUrl = $this->baseUrl;
        
        $data = compact('detailNews', 'mainPageUrl');
        $this->renderView('Detail.php', $data);
    }

    private function renderView($view, $data)
    {
        extract($data);
        ob_start();
        include_once "View/News/" . $view;
        $content = ob_get_clean();

        include_once "View/Layout.php";
    }
}
