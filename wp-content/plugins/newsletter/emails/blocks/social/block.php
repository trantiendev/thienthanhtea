<?php
/*
 * Name: Social links
 * Section: footer
 * Description: Link with icons to social profiles
 * 
 */

/* @var $options array */
/* @var $wpdb wpdb */

$default_options = array(
    'block_padding_left' => 15,
    'block_padding_right' => 15,
    'block_padding_bottom' => 15,
    'block_padding_top' => 15,
    'block_background'=> '#ffffff'
);
$options = array_merge($default_options, $options);

$social_icon_url = plugins_url('newsletter') . '/emails/themes/default/images';
$configured = false;
?>


<table border="0" cellspacing="0" cellpadding="0" align="center" class="responsive-table">
    <tr>
        <td align="center">
            <?php
            if (!empty($block_options['facebook_url'])) {
                $configured = true;
                ?>
                <span class="tnpc-row-edit" data-type="image">
                    <a href="<?php echo $block_options['facebook_url'] ?>"><img src="<?php echo $social_icon_url ?>/facebook.png" alt="Facebook"></a>
                </span>
            <?php } ?>
            <?php
            if (!empty($block_options['twitter_url'])) {
                $configured = true;
                ?>
                <span class="tnpc-row-edit" data-type="image">
                    <a href="<?php echo $block_options['twitter_url'] ?>"><img src="<?php echo $social_icon_url ?>/twitter.png" alt="Twitter"></a>
                </span>
            <?php } ?>
            <?php
            if (!empty($block_options['googleplus_url'])) {
                $configured = true;
                ?>
                <span class="tnpc-row-edit" data-type="image">
                    <a href="<?php echo $block_options['googleplus_url'] ?>"><img src="<?php echo $social_icon_url ?>/googleplus.png" alt="Google+"></a>
                </span>
            <?php } ?>
            <?php
            if (!empty($block_options['pinterest_url'])) {
                $configured = true;
                ?>
                <span class="tnpc-row-edit" data-type="image">
                    <a href="<?php echo $block_options['pinterest_url'] ?>"><img src="<?php echo $social_icon_url ?>/pinterest.png" alt="Pinterest"></a>
                </span>
            <?php } ?>
            <?php
            if (!empty($block_options['linkedin_url'])) {
                $configured = true;
                ?>
                <span class="tnpc-row-edit" data-type="image">
                    <a href="<?php echo $block_options['linkedin_url'] ?>"><img src="<?php echo $social_icon_url ?>/linkedin.png" alt="LinkedIn"></a>
                </span>
            <?php } ?>
            <?php
            if (!empty($block_options['tumblr_url'])) {
                $configured = true;
                ?>
                <span class="tnpc-row-edit" data-type="image">
                    <a href="<?php echo $block_options['tumblr_url'] ?>"><img src="<?php echo $social_icon_url ?>/tumblr.png" alt="Tumblr"></a>
                </span>
            <?php } ?>
            <?php
            if (!empty($block_options['youtube_url'])) {
                $configured = true;
                ?>
                <span class="tnpc-row-edit" data-type="image">
                    <a href="<?php echo $block_options['youtube_url'] ?>"><img src="<?php echo $social_icon_url ?>/youtube.png" alt="Youtube"></a>
                </span>
            <?php } ?>
            <?php
            if (!empty($block_options['soundcloud_url'])) {
                $configured = true;
                ?>
                <span class="tnpc-row-edit" data-type="image">
                    <a href="<?php echo $block_options['soundcloud_url'] ?>"><img src="<?php echo $social_icon_url ?>/soundcloud.png" alt="SoundCloud"></a>
                </span>
            <?php } ?>
            <?php
            if (!empty($block_options['instagram_url'])) {
                $configured = true;
                ?>
                <span class="tnpc-row-edit" data-type="image">
                    <a href="<?php echo $block_options['instagram_url'] ?>"><img src="<?php echo $social_icon_url ?>/instagram.png" alt="Instagram"></a>
                </span>
            <?php } ?>
            <?php
            if (!empty($block_options['vimeo_url'])) {
                $configured = true;
                ?>
                <span class="tnpc-row-edit" data-type="image">
                    <a href="<?php echo $block_options['vimeo_url'] ?>"><img src="<?php echo $social_icon_url ?>/vimeo.png" alt="Vimeo"></a>
                </span>
            <?php } ?>
            <?php if (!$configured) { ?>
                <p>Configure your social links in the <a href="?page=newsletter_main_info">Social configuration section</a>.<br/>
                    Then remove and add again this block.</p>
            <?php } ?>
        </td>
    </tr>
</table>


