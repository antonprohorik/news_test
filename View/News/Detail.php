
<div class="bread_crumbs">
    <a class="bread_crumbs_start" href="/news/">Главная /</a>
    <a class="bread_crumbs_end"><?php echo $detailNews['title']; ?></a>
</div>

<div class="detail_block_title">
    <h1><?php echo $detailNews['title']; ?></h1>
</div>

<div class="detail_news_wrapper">
    <div class="detail_news">
        <div class="detail_date">
            <time><?php echo date('d.m.Y', strtotime($detailNews['date'])); ?></time>
        </div>
        <h1 class="detail_news_title"><?php echo $detailNews['announce']; ?></h1>
        <div class="detail_news_text"><?php echo $detailNews['content']; ?></div>
        <a href="/news/">
            <button class="btn detail_more_btn">
                <svg class="btn_arrow" width="26px" height="26px" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" fill="#000000">
                    <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                    <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                    <g id="SVGRepo_iconCarrier">
                        <title></title>
                        <g id="Complete">
                            <g id="arrow-left">
                                <g>
                                    <polyline data-name="Right" fill="none" id="Right-2" points="7.6 7 2.5 12 7.6 17" class="btn_stroke" stroke="#000000" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"></polyline>
                                    <line fill="none" class="btn_stroke" stroke="#000000" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" x1="21.5" x2="4.8" y1="12" y2="12"></line>
                                </g>
                            </g>
                        </g>
                    </g>
                </svg>
                Назад к новостям
            </button>
        </a>
    </div>
    <img class="detail_news_img" src="<?php echo $detailNews['image_url']; ?>">
</div>

