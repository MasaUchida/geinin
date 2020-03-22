
{{get_header();}}

<?php
$args = array(
  'post_type' => 'geinin', /* カスタム投稿名が「gourmet」の場合 */
  'posts_per_page' => 5, /* 表示する数 */
); ?>
<?php $my_query = new WP_Query( $args ); ?>
<ul style="list-style: none;">
<?php while ( $my_query->have_posts() ) : $my_query->the_post() ?>
<!-- ▽ ループ開始 ▽ -->
  <li>
    <div style="background-image: url({{the_post_thumbnail_url()}})"></div>
    <!-- 投稿番号が最大　= 最新
    の投稿のサムネイルをキーイメージとして表示する
    手法：
    1.サムネイルのidを取得
    2.サムネイルのidを配列にpush
    3.配列にMAXをかける
    4.帰ってきたidのサムネイルを表示
    ※ループの外で一度だけ行うこと
    -->
    <img src="{{ the_post_thumbnail_url() }}" alt="">
    <h3>{{the_title()}}</h3>
    <p>{{the_time( get_option( 'date_format' ))}}</p>
    <p>{{the_content()}}</p> 
    <dl>
        <dt>デビューした日</dt>
        <dd>{{the_field('started_date')}}</dd>
    </dl>
    <dl>
        <dt>所属事務所</dt>
        <dd>
        <?php
                $field = get_field('talent_office');
                if ($field != ''){
                    echo $field;
                    }
                    else
                    {
                        echo "事務所不明";
                    }
            ?>  
        </dd>
    </dl>
    <?php $singleLink = get_the_permalink();?>
    <p><?php echo $singleLink ?></p>
    <a href = "<?php echo $singleLink ?>"><?php the_title(); ?>について詳しく見る</a>
  </li>
<!-- △ ループ終了 △ -->
<?php endwhile; ?>
</ul>
