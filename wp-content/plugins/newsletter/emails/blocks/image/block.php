<?php
/*
 * Name: Single image
 * Section: content
 * Description: A single image with link
 */

/* @var $options array */
/* @var $wpdb wpdb */

$defaults = array(
    'image' => '',
    'url' => '',
    'block_background' => '#ffffff',
    'block_padding_left' => 0,
    'block_padding_right' => 0,
    'block_padding_bottom' => 15,
    'block_padding_top' => 15
);

$options = array_merge($defaults, $options);

if (empty($options['image']['id'])) {
    // A placeholder can be set by a preset and it is kept indefinitely
    if (!empty($options['placeholder'])) {
        $image = $options['placeholder'];
    } else {
        $image = 'https://source.unsplash.com/600x250/daily';
    }
} else {
    $image = tnp_media_resize($options['image']['id'], array(600, 0));
}

$url = $options['url'];
?>

<?php if (!empty($url)) { ?>
    <a href="<?php echo $url ?>" target="_blank"><img src="<?php echo $image ?>" border="0" alt="" style="max-width: 100%!important; height: auto!important; display: inline-block;"></a>                
<?php } else { ?>
    <img src="<?php echo $image ?>" border="0" alt="" style="max-width: 100%!important; height: auto!important; display: inline-block;">              
<?php } ?>
