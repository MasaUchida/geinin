{{wp_nav_menu()}}
    <img src="<?php the_post_thumbnail_url(); ?>" alt="">
    <h1><?php the_title(); ?></h1>
    <p><?php the_time( get_option( 'date_format' ) ); ?></p>
    <p><?php the_content(); ?></p> 
    <dl>
        <dt>デビューした日</dt>
        <dd>
            <?php
                the_field('started_date');
            ?>
        </dd>
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
        <dt>受賞履歴</dt>
        
    </dl>
    <?php $singleLink = get_the_permalink();?>
    <p><?php echo $singleLink ?></p>