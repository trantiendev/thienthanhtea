<?php
/*
 * Name: Company Info
 * Section: footer
 * Description: Company Info for Can-Spam act requirements
 */

$default_options = array(
    'block_background' => '#ffffff',
    'font_family' => $font_family,
    'font_size' => 13,
    'font_color' => '#999999',
    'font_weight' => 'normal',
    'block_padding_top' => 15,
    'block_padding_bottom' => 15,
    'block_padding_left' => 15,
    'block_padding_right' => 15    
);
$options = array_merge($default_options, $options);
?>

<style>
    .canspam-text {
        padding: 10px; 
        text-align: center; 
        font-size: <?php echo $options['font_size'] ?>px; 
        font-family: <?php echo $options['font_family'] ?>; 
        font-weight: <?php echo $options['font_weight'] ?>; 
        color: <?php echo $options['font_color'] ?>;
    }
</style>
<table width="100%" style="width: 100%!important" border="0" cellspacing="0" cellpadding="0" align="center" class="responsive-table">
    <tr>
        <td align="center" class="canspam-text">
                <?php echo!empty($block_options['footer_title']) ? $block_options['footer_title'] : 'Your Company' ?>
                <br>
                <?php echo!empty($block_options['footer_contact']) ? $block_options['footer_contact'] : 'Company Address, Phone Number' ?>
                <br>
                <em><?php echo!empty($block_options['footer_legal']) ? $block_options['footer_legal'] : 'Copyright or Legal text' ?></em>
            </div>
        </td>
    </tr>
</table>

