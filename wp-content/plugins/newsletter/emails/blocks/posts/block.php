<?php
/*
 * Name: Last posts
 * Section: content
 * Description: Last posts list with different layouts
 * Type: dynamic
 */

/* @var $options array */
/* @var $wpdb wpdb */

$defaults = array(
    'title' => 'Last news',
    'color' => '#999999',
    'font_family' => 'Helvetica, Arial, sans-serif',
    'font_size' => '16',
    'font_color' => '#333333',
    'title_font_family' => 'Helvetica, Arial, sans-serif',
    'title_font_size' => '25',
    'title_font_color' => ' #333333',
    'max' => 4,
    'button_label' => __('Read more...', 'newsletter'),
    'categories' => '',
    'tags' => '',
    'block_background' => '#ffffff',
    'layout' => 'one',
    'language' => '',
    'button_background' => '#256F9C',
    'button_font_color' => '#ffffff',
    'button_font_family' => 'Helvetica, Arial, sans-serif',
    'button_font_size' => 16,
    'block_padding_left' => 15,
    'block_padding_right' => 15,
    'block_padding_top' => 15,
    'block_padding_bottom' => 15
);

$options = array_merge($defaults, $options);

$font_family = $options['font_family'];
$font_size = $options['font_size'];

$title_font_family = $options['title_font_family'];
$title_font_size = $options['title_font_size'];

$show_image = !empty($options['show_image']);

$filters = array();
$filters['posts_per_page'] = (int) $options['max'];

if (!empty($options['categories'])) {
    $filters['category__in'] = $options['categories'];
}

if (!empty($options['tags'])) {
    $filters['tag'] = $options['tags'];
}

// Filter by time?
//$options['block_last_run'] = time();
if (!empty($context['last_run'])) {
    $filters['date_query'] = array(
        'after' => gmdate('c', $context['last_run'])
    );
}

$posts = Newsletter::instance()->get_posts($filters, $options['language']);

if (empty($posts) && !empty($context['last_run'])) {
    return;
}

$out['subject'] = $posts[0]->post_title;

$button_background = $options['button_background'];
$button_label = $options['button_label'];
$button_font_family = $options['button_font_family'];
$button_font_size = $options['button_font_size'];
$button_color = $options['button_font_color'];

$alternative = plugins_url('newsletter') . '/emails/blocks/posts/images/blank.png';
$alternative_2 = plugins_url('newsletter') . '/emails/blocks/posts/images/blank-240x160.png';
?>

<?php if ($options['layout'] == 'one') { ?>
    <style>
        .posts-post-date {
            padding: 0 0 5px 25px; 
            font-size: 13px;
            font-family: <?php echo $font_family ?>; 
            font-weight: normal; 
            color: #aaaaaa;
        }

        .posts-post-title {
            padding: 0 0 5px 25px; 
            font-size: <?php echo $title_font_size ?>px; 
            font-family: <?php echo $title_font_family ?>;
            font-weight: normal; 
            color: <?php echo $options['title_font_color'] ?>;
            line-height: normal;
        }

        .posts-post-excerpt {
            padding: 10px 0 15px 25px;
            font-family: <?php echo $font_family ?>; 
            color: <?php echo $options['font_color'] ?>;
            font-size: <?php echo $font_size ?>px; 
            line-height: 1.5em;
        }

        .posts-button-table {
            background-color: <?php echo $button_background ?>; 
            /*border:1px solid #353535;*/
            border-radius:5px;
            align: right;
        }
        .posts-button-td {
            color: <?php echo $button_color ?>;
            font-family:<?php echo $font_family ?>; 
            font-size:<?php echo $button_font_size ?>px;
            font-weight:normal; 
            letter-spacing:normal;
            line-height:normal; 
            padding-top:15px; 
            padding-right:30px; 
            padding-bottom:15px; 
            padding-left:30px;
            text-align: right;
        }
        .posts-button-a {
            color:<?php echo $button_color ?>;
            font-size:<?php echo $button_font_size ?>px;
            font-weight:normal; 
            text-decoration:none;
        }
    </style>
    <!-- COMPACT ARTICLE SECTION -->



    <table border="0" cellpadding="0" cellspacing="0" width="100%" class="responsive-table">

        <?php foreach ($posts as $post) { ?>
        <?php
        $url = tnp_post_permalink($post);
        ?>

            <tr>
                <?php if ($show_image) { ?>
                    <td valign="top" style="padding: 30px 0 0 0; width: 105px!important" class="mobile-hide">
                        <a href="<?php echo tnp_post_permalink($post) ?>" target="_blank">
                            <img src="<?php echo tnp_post_thumbnail_src($post, array(105, 105, true), $alternative) ?>" width="105" height="105" border="0" style="display: block; font-family: Arial; color: #666666; font-size: 14px; min-width: 105px!important; width: 105px!important;">
                        </a>
                    </td>
                <?php } ?>
                <td style="padding: 30px 0 0 0;" class="no-padding">
                    <!-- ARTICLE -->
                    <table border="0" cellspacing="0" cellpadding="0" width="100%">
                        <?php if (!empty($options['show_date'])) { ?>
                            <tr>
                                <td align="left" inline-class="posts-post-date" class="padding-meta">
                                    <?php echo tnp_post_date($post) ?>
                                </td>
                            </tr>
                        <?php } ?>
                        <tr>
                            <td align="left" inline-class="posts-post-title" class="padding-copy tnpc-row-edit" data-type="title">
                                <?php echo tnp_post_title($post) ?>
                            </td>  
                        </tr>
                        <tr>
                            <td align="left" inline-class="posts-post-excerpt" class="padding-copy tnpc-row-edit" data-type="text">
                                <?php echo tnp_post_excerpt($post) ?>
                            </td>
                        </tr>
                        <tr>
                            <td align="left" class="padding">
                                <table border="0" cellpadding="0" cellspacing="0" inline-class="posts-button-table" align="right">
                                    <tr>
                                        <td align="center" valign="middle" inline-class="posts-button-td">
                                            <a href="<?php echo esc_attr($url) ?>" target="_blank" inline-class="posts-button-a"><?php echo $button_label ?></a>
                                        </td>
                                    </tr>
                                </table>    
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>

        <?php } ?>

    </table>



<?php } else { ?>

    <style>
        .posts-post-date {
            padding: 10px 0 0 15px; 
            font-size: 13px;
            font-family: <?php echo $font_family ?>; 
            font-weight: normal; 
            color: #aaaaaa;
        }        
        .posts-post-title {
            padding: 15px 0 0 0; 
            font-family: <?php echo $title_font_family ?>; 
            color: <?php echo $options['title_font_color'] ?>;
            font-size: <?php echo $title_font_size ?>px; 
            line-height: 1.3em; 
        }
        .posts-post-excerpt {
            padding: 5px 0 0 0; 
            font-family: <?php echo $font_family ?>; 
            color: <?php echo $options['font_color'] ?>;
            font-size: <?php echo $font_size ?>px; 
            line-height: 1.4em;
        }
        .posts-button-table {
            background-color: <?php echo $button_background ?>; 
            /*border:1px solid #353535;*/
            border-radius:5px;
            align: right;
        }
        .posts-button-td {
            color: <?php echo $button_color ?>;
            font-family:<?php echo $font_family ?>; 
            font-size:<?php echo $button_font_size ?>px;
            font-weight:normal; 
            letter-spacing:normal;
            line-height:normal; 
            padding-top:15px; 
            padding-right:30px; 
            padding-bottom:15px; 
            padding-left:30px;
            text-align: right;
        }
        .posts-button-a {
            color:<?php echo $button_color ?>;
            font-size:<?php echo $button_font_size ?>px;
            font-weight:normal; 
            text-decoration:none;
        }        
    </style>
    <!-- TWO COLUMN SECTION -->


    <!-- TWO COLUMNS -->
    <table cellspacing="0" cellpadding="0" border="0" width="100%">
        <?php foreach (array_chunk($posts, 2) AS $row) { ?>        
            <tr>
                <td valign="top" style="padding: 10px;" class="mobile-wrapper">

                    <!-- LEFT COLUMN -->
                    <table cellpadding="0" cellspacing="0" border="0" width="47%" align="left" class="responsive-table">
                        <tr>
                            <td style="padding: 20px 0 40px 0;">
                                <table cellpadding="0" cellspacing="0" border="0" width="100%">
                                    <?php if ($show_image) { ?>
                                        <tr>
                                            <td align="center" valign="middle" class="tnpc-row-edit" data-type="image">
                                                <a href="<?php echo tnp_post_permalink($row[0]) ?>" target="_blank">
                                                    <img src="<?php echo tnp_post_thumbnail_src($row[0], array(240, 160, true), $alternative_2) ?>" width="240" height="160" border="0" class="img-max">
                                                </a>
                                            </td>
                                        </tr>
                                    <?php } ?>
                                    <tr>
                                        <td align="center" inline-class="posts-post-title" class="tnpc-row-edit" data-type="title"><?php echo tnp_post_title($row[0]) ?></td>
                                    </tr>
                                    <?php if (!empty($options['show_date'])) { ?>
                                    <tr>
                                        <td  align="center" inline-class="posts-post-date">
                                            <?php echo tnp_post_date($row[0]) ?>
                                        </td>
                                    </tr>
                                    <?php } ?>
                                    <tr>
                                        <td align="center" inline-class="posts-post-excerpt" class="tnpc-row-edit" data-type="text"><?php echo tnp_post_excerpt($row[0]) ?></td>
                                    </tr>
                                    <tr>
                                        <td align="center">
                                            <br>
                                            <table border="0" cellpadding="0" cellspacing="0" inline-class="posts-button-table" align="center">
                                                <tr>
                                                    <td align="center" valign="middle" inline-class="posts-button-td">
                                                        <a href="<?php echo tnp_post_permalink($row[0]) ?>" target="_blank" inline-class="posts-button-a"><?php echo $button_label ?></a>
                                                    </td>
                                                </tr>
                                            </table> 
                                        </td>
                                    </tr>
                                </table>
                            </td>
                        </tr>
                    </table>

                    <?php if (!empty($row[1])) { ?>
                        <!-- RIGHT COLUMN -->
                        <table cellpadding="0" cellspacing="0" border="0" width="47%" align="right" class="responsive-table">
                            <tr>
                                <td style="padding: 20px 0 40px 0;">
                                    <table cellpadding="0" cellspacing="0" border="0" width="100%">
                                        <?php if ($show_image) { ?>
                                            <tr>
                                                <td align="center" valign="middle" class="tnpc-row-edit" data-type="image">
                                                    <a href="<?php echo tnp_post_permalink($row[1]) ?>" target="_blank">
                                                        <img src="<?php echo tnp_post_thumbnail_src($row[1], array(240, 160, true), $alternative_2) ?>" width="240" height="160" border="0" class="img-max">
                                                    </a>
                                                </td>
                                            </tr>
                                        <?php } ?>
                                        <tr>
                                            <td align="center" inline-class="posts-post-title" class="tnpc-row-edit" data-type="title"><?php echo tnp_post_title($row[1]) ?></td>
                                        </tr>
                                        <?php if (!empty($options['show_date'])) { ?>
                                        <tr>
                                            <td  align="center" inline-class="posts-post-date">
                                                <?php echo tnp_post_date($row[1]) ?>
                                            </td>
                                        </tr>
                                        <?php } ?>
                                        <tr>
                                            <td align="center" inline-class="posts-post-excerpt" class="tnpc-row-edit" data-type="text"><?php echo tnp_post_excerpt($row[1]) ?></td>
                                        </tr>
                                        <tr>
                                        <td align="center">
                                            <br>
                                            <table border="0" cellpadding="0" cellspacing="0" inline-class="posts-button-table" align="center">
                                                <tr>
                                                    <td align="center" valign="middle" inline-class="posts-button-td">
                                                        <a href="<?php echo tnp_post_permalink($row[1]) ?>" target="_blank" inline-class="posts-button-a"><?php echo $button_label ?></a>
                                                    </td>
                                                </tr>
                                            </table> 
                                        </td>
                                    </tr>
                                    </table>
                                </td>
                            </tr>
                        </table>
                    <?php } ?>

                </td>
            </tr>

        <?php } ?>

    </table>



<?php } ?>
