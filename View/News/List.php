<div class="ban">
    <h1 class="ban_title"><?php echo $banNews[0]['title']; ?></h1>
    <div class="ban_subtitle"><?php echo $banNews[0]['announce']; ?></div>
    <style>
        .ban { background-image: url(<?php echo $banNews[0]['image_url']; ?>); }
    </style>
</div>

<div class="block_title"><h1>Новости</h1></div>
<div class="news_wrapper">
    <?php foreach ($news as $item) { ?>
        <div class="news_item">
            <div class="date">
                <time><?php echo date('d.m.Y', strtotime($item['date'])); ?></time>
            </div>
            <a href="/news/<?php echo $item['id']; ?>/">
                <h1 class="news_title"><?php echo $item['title']; ?></h1>
            </a>
            <div class="news_text"><?php echo $item['announce']; ?></div>
            <a class="more_a" href="/news/<?php echo $item['id'];?>/">
                <button class="btn more_btn">Подробнее
                    <svg class="btn_arrow" width="32px" height="32px" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" fill="#841844">
                        <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                        <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                        <g id="SVGRepo_iconCarrier">
                            <title></title>
                            <g id="Complete">
                                <g id="arrow-right">
                                    <g>
                                        <polyline data-name="Right" fill="none" id="Right-2" points="16.4 7 21.5 12 16.4 17" class="btn_stroke" stroke="#841844" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"></polyline>
                                        <line fill="none" class="btn_stroke" stroke="#841844" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" x1="2.5" x2="19.2" y1="12" y2="12"></line>
                                    </g>
                                </g>
                            </g>
                        </g>
                    </svg>
                </button>
            </a>
        </div>
    <?php } ?>
</div>

<div class="page_buttons">
    <?php 
    $totalPages = ceil($total / $chunk);
    $startPage = max(1, $page - 1);
    $endPage = min($totalPages, $page + 1);

    if ($endPage - $startPage < 2) {
        if ($startPage == 1) {
            $endPage = min($totalPages, $startPage + 2);
        } elseif ($endPage == $totalPages) {
            $startPage = max(1, $endPage - 2);
        }
    }

    $currentUrl = ($page == 1) ? '/news/' : "/news/page-$page/";

    for ($i = $startPage; $i <= $endPage; $i++) { 
        $url = ($i == 1) ? '/news/' : "/news/page-$i/";

        ?>
        <a href="<?php echo $url; ?>">
            <button class="btn page_btn"><?php echo $i; ?></button>
        </a>
    <?php }

    if ($page < $totalPages) { 
        $nextUrl = "/news/page-" . ($page + 1) . "/";
    ?>
        <a href="<?php echo $nextUrl; ?>">
            <button class="btn next_btn"><div></div></button>
        </a>
    <?php } ?>
</div>