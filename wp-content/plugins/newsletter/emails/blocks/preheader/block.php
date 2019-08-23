<?php
/*
 * Name: Preheader
 * Section: header
 * Description: Preheader
 * 
 */

/* @var $options array */
/* @var $wpdb wpdb */

$default_options = array(
    'view' => 'View online',
    'text' => 'Few words summary',
    'block_background' => '#ffffff',
    'font_family' => $font_family,
    'font_size' => 13,
    'font_color' => '#999999',
    'font_weight' => 'normal',
    'block_padding_left'=>15,
    'block_padding_right'=>15,
    'block_padding_bottom'=>15,
    'block_padding_top'=>15
);

$options = array_merge($default_options, $options);
?>
<style>
    .preheader-table {
        width: 100%!important
        border: 0;
        border-collapse: collapse;
    }
    .preheader-link {
        padding: 10px; 
        font-size: <?php echo $options['font_size'] ?>px; 
        font-family: <?php echo $options['font_family'] ?>; 
        font-weight: <?php echo $options['font_weight'] ?>; 
        color: <?php echo $options['font_color'] ?>;
    }
    .preheader-view-link {
        font-size: <?php echo $options['font_size'] ?>px; 
        font-family: <?php echo $options['font_family'] ?>; 
        font-weight: <?php echo $options['font_weight'] ?>; 
        color: <?php echo $options['font_color'] ?>;
        text-decoration: none;
    }
</style>

<table width="100%" border="0" cellpadding="0" align="center" cellspacing="0" inline-class="preheader-table">
    <tr>
        <td class="preheader-link" width="50%" valign="top" align="left">
            <?php echo $options['text'] ?>
        </td>
        <td class="preheader-link" width="50%" valign="top" align="right">
            <a href="{email_url}" target="_blank" rel="noopener" class="preheader-view-link"><?php echo $options['view'] ?></a>
        </td>
    </tr>
</table>

