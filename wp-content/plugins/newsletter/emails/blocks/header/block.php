<?php
/*
 * Name: Header
 * Section: header
 * Description: Default header with company info
 */

$default_options = array(
    'font_family' => $font_family,
    'font_size' => 14,
    'font_color' => '#444444',
    'font_weight' => 'normal',
    'block_background' => '#ffffff',
    'block_padding_top'=>15,
    'block_padding_bottom'=>15,
    'block_padding_left'=>15,
    'block_padding_right'=>15
);
$options = array_merge($default_options, $options);

if (empty($info['header_logo']['id'])) {
    $image = false;
} else {
    $image = tnp_media_resize($info['header_logo']['id'], array(200, 80));
    if (is_wp_error($image)) {
        $image = false;
    }
}

$empty = empty($info['header_logo']['id']) && empty($info['header_sub']) && empty($info['header_title']);

?>

<?php if ($empty) { ?>
<p>Please, set your company info.</p>
<?php } else { ?>
<style>
    .header-text {
        padding: 10px; 
        text-align: right; 
        font-size: <?php echo $options['font_size'] ?>px; 
        font-family: <?php echo $options['font_family'] ?>; 
        font-weight: <?php echo $options['font_weight'] ?>; 
        color: <?php echo $options['font_color'] ?>;
    }
    .header-logo {
        font-family: <?php echo $options['font_family'] ?>; 
        font-size: <?php echo $options['font_size']*1.1 ?>px; 
        line-height: normal;
        font-weight: <?php echo $options['font_weight'] ?>;
        color: <?php echo $options['font_color'] ?>;
    }
</style>

<table border="0" cellpadding="0" cellspacing="0" width="100%">
    <tr>
        <td align="left" width="50%" inline-class="header-logo">
            <?php if ($image) { ?>
            <a href="#" target="_blank">
                <img alt="<?php echo esc_attr($info['header_title']) ?>" src="<?php echo $image ?>" style="display: block; max-width: 100%" border="0">
            </a>
            <?php } else { ?>
            <?php } ?>
        </td>
        <td width="50%" align="right" class="mobile-hide" inline-class="header-text">
            <?php echo $info['header_sub'] ?>
        </td>
    </tr>
</table>

<?php } ?>