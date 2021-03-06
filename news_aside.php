<div class="sidebar-section">
    <aside id="recent-posts-3" class="widget widget_recent_entries categoryBlock normall categoriesList ">
        <div class="recentTitle">
            <h5 class="widget_title h5 as"><?= $lang_text['o_recent_news'][$lang] ?></h5>
        </div>
        <ul>
            <?php
            $years = '';
            if ($type == 1) {
                $page = 'news.php';
                $page_detail = 'news_detail.php';
            }
            if ($type == 2) {
                $page = 'hot_sale.php';
                $page_detail = 'hot_sale_detail.php';
            }
            if ($type == 3) {
                $page =  'activity.php';
                $page_detail = 'activity_detail.php';
            }
            $get_data = $connect->query("SELECT A.*,B.username as name, 
                    (SELECT 
                        GROUP_CONCAT(DISTINCT DATE_FORMAT(tbl_news.date, '%Y')) 
                        FROM tbl_news 
                        WHERE tbl_news.type=$type
                        ORDER BY tbl_news.date DESC
                    ) as years
                    FROM tbl_news as A
                    LEFT JOIN tbl_pos_user AS B ON B.id=A.created_by
                    Where A.type=$type ORDER BY A.id DESC Limit 0,10");
            while ($row = mysqli_fetch_object($get_data)) {
                $years = $row->years;
                echo '<li>
                        <a href="' . $page_detail . '?id=' . $row->id . '" class="custom_side_news">' . $row->{'title_' . $lang} . '</a>
                    </li>';
            }
            ?>
        </ul>
    </aside>
    <aside id="tag_cloud-2" class="widget widget_tag_cloud categoryBlock normall categoriesList ">
        <div class="recentTitle">
            <h5 class="widget_title h5 as"><?= $lang_text['o_news_by_year'][$lang] ?></h5>
        </div>
        <div class="tagcloud">
            <?php
            $years = explode(',', $years);
            sort($years);
            foreach ($years as $year) {
                echo '<a href="' . $page . '?year=' . $year . '" class="' . (@$_GET['year'] == $year ? 'active' : '') . ' tag-cloud-link tag-link-101 tag-link-position-1" style="font-size: 8pt;" aria-label="2017 (11 items)">' . $year . '</a>';
            }
            ?>
        </div>
    </aside>
</div>
<style>
    .sidebar-section {
        margin-top: 45px;
    }

    .post_readmore a {
        text-decoration: none;
    }

    .sidebar-section a {
        text-decoration: none;
        color: #555;
    }

    .sidebar-section a.active {
        color: #fff;
        background: red;
    }

    .recentTitle h5 {
        text-transform: uppercase;
    }
</style>