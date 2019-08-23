<?php
/*
 * Name: Last posts
 * Section: content
 * Description: Last opsts list with different layouts
 */

/* @var $options array */
/* @var $wpdb wpdb */

$defaults = array(
    'button_url' => '',
    'title' => 'An Awesome Title',
    'text' => 'This is just a simple text you should change',
    'font_family' => 'Helvetica, Arial, sans-serif',
    'font_size' => '14',
    'font_weight' => 'normal',
    'font_color' => '#000000',
    'title_font_family' => 'Helvetica, Arial, sans-serif',
    'title_font_size' => '20',
    'title_font_weight' => 'normal',
    'title_font_color' => '#000000',
    'block_background' => '#ffffff',
    'layout' => 'full',
    'button_label' => 'Click Here',
    'button_color' => '#ffffff',
    'button_background' => '#256F9C',
    'layout' => 'full',
    'block_padding_top'=>20,
    'block_padding_bottom'=>20
);

$options = array_merge($defaults, $options);
$layout = $options['layout'];

if ($layout == 'full') {
    $options = array_merge(array('block_padding_left'=>0, 'block_padding_right'=>0), $options);
} else {
    $options = array_merge(array('block_padding_left'=>15, 'block_padding_right'=>15), $options);
}
$url = $options['button_url'];

$font_family = $options['font_family'];
$font_size = $options['font_size'];
$font_weight = $options['font_weight'];
$font_color = $options['font_color'];

$title_font_family = $options['title_font_family'];
$title_font_size = $options['title_font_size'];
$title_font_weight = $options['title_font_weight'];
$title_font_color = $options['title_font_color'];

$button_color = $options['button_color'];
$button_background = $options['button_background'];
$button_label = $options['button_label'];
$layout = $options['layout'];

if (!empty($options['image']['id'])) {
    if ($layout == 'full') {
        $image = tnp_media_resize($options['image']['id'], array(600, 0));
    } else {
        $image = tnp_media_resize($options['image']['id'], array(300, 200, true));
    }
} else {
    $image = false;
}
?>

<?php if ($layout == 'full') { ?>

    <style>
        .hero-title {
            font-size: <?php echo $title_font_size ?>px; 
            color: <?php echo $title_font_color ?>; 
            padding-top: 30px; 
            font-family: <?php echo $title_font_family ?>;
            font-weight: <?php echo $title_font_weight ?>; 
        }
        .hero-text {
            padding: 20px 0 0 0; 
            font-size: <?php echo $font_size ?>px; 
            line-height: 150%; 
            color: <?php echo $font_color ?>; 
            font-family: <?php echo $font_family ?>; 
        }
        .hero-button-table {
            background-color: <?php echo $button_background ?>; 
            /*border:1px solid #353535;*/
            border-radius:5px;
        }
        .hero-button-td {
            color: <?php echo $button_color ?>;
            font-family:<?php echo $font_family ?>; 
            font-size:16px; 
            font-weight:normal; 
            letter-spacing:-.5px; 
            line-height:150%; 
            padding-top:15px; 
            padding-right:30px; 
            padding-bottom:15px; 
            padding-left:30px;
        }
        .hero-button-a {
            color:<?php echo $button_color ?>;
            text-decoration:none;
        }
        .hero-image {
            max-width: 100%!important; 
            display: block;
            border: 0px;
        }   
    </style>


    <!-- HERO IMAGE -->
    <table width="100%" border="0" cellspacing="0" cellpadding="0">
        <tr>
            <td class="padding-copy tnpc-row-edit">
                <a href="<?php echo $url ?>" target="_blank" rel="noopener nofollow">
                    <img src="<?php echo $image ?>" border="0" alt="" inline-class="hero-image">
                </a>
            </td>
        </tr>
        <tr>
            <td>
                <!-- COPY -->
                <table width="100%" border="0" cellspacing="0" cellpadding="0">
                    <tr>
                        <td align="center" inline-class="hero-title">
                            <span><?php echo $options['title'] ?></span>
                        </td>
                    </tr>
                    <tr>
                        <td align="center" inline-class="hero-text">
                            <span><?php echo $options['text'] ?></span>
                        </td>
                    </tr>

                    <tr>
                        <td align="center">
                            <br>
                            <table border="0" cellpadding="0" cellspacing="0" inline-class="hero-button-table" align="center">
                                <tr>
                                    <td align="center" valign="middle" inline-class="hero-button-td">
                                        <a href="<?php echo esc_attr($url) ?>" target="_blank" inline-class="hero-button-a"><?php echo $button_label ?></a>
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

<?php if ($layout == 'left') { ?>

    <style>
        .hero-title {
            font-size: <?php echo $title_font_size ?>px; 
            color: #333333; 
            padding-top: 0; 
            font-family: <?php echo $title_font_family ?>;
            font-weight: <?php echo $title_font_weight ?>; 
        }
        .hero-text {
            padding: 20px 0 0 0; 
            font-size: <?php echo $font_size ?>px; 
            line-height: 150%; 
            color: #666666; 
            font-family: <?php echo $font_family ?>; 
            font-weight: <?php echo $font_weight ?>; 
        }
        .hero-button-table {
            background-color: <?php echo $button_background ?>; 
            /*border:1px solid #353535;*/
            border-radius:5px;
        }
        .hero-button-td {
            color: <?php echo $button_color ?>;
            font-family:<?php echo $font_family ?>; 
            font-size:<?php echo $font_size ?>px; 
            font-weight:bold; 
            letter-spacing:-.5px; 
            line-height:150%; 
            padding-top:10px; 
            padding-right:30px; 
            padding-bottom:10px; 
            padding-left:30px;
        }
        .hero-button-a {
            color:<?php echo $button_color ?>;
            text-decoration:none;
        }
    </style>

    <table width="290" align="left" class="hero-table">
        <tr>
            <td align="center" valign="top">
                <img src="<?php echo $image ?>" border="0" alt="" style="max-width: 100%!important; height: auto!important; display: block;" class="img-max">                
            </td>
        </tr>
    </table>

    <table width="290" align="right" class="hero-table hero-table-right">
        <tr>
            <td>
                <table width="100%" border="0" cellspacing="0" cellpadding="0">
                    <tr>
                        <td align="center" inline-class="hero-title">
                            <span><?php echo $options['title'] ?></span>
                        </td>
                    </tr>
                    <tr>
                        <td align="center" inline-class="hero-text">
                            <span><?php echo $options['text'] ?></span>
                        </td>
                    </tr>
                </table>
                <br>
                <table border="0" cellpadding="0" cellspacing="0" align="center" inline-class="hero-button-table">
                    <tr>
                        <td align="center" valign="middle" inline-class="hero-button-td">
                            <a href="<?php echo esc_attr($url) ?>" target="_blank" inline-class="hero-button-a"><?php echo $button_label ?></a>
                        </td>
                    </tr>
                </table>

            </td>
        </tr>
    </table>


<?php } ?>

