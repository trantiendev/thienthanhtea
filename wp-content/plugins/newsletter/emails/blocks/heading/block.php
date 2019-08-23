<?php
/*
 * Name: Heading
 * Section: content
 * Description: Section title
 */


$default_options = array(
    'text' => 'An Awesome Title',
    'align' => 'center',
    'block_background' => '#ffffff',
    'font_family' => $font_family,
    'font_size' => 30,
    'font_color' => '#444444',
    'font_weight' => 'normal',
    'block_padding_left' => 15,
    'block_padding_right' => 15,
    'block_padding_bottom' => 15,
    'block_padding_top' => 15
);
$options = array_merge($default_options, $options);
?>

<style>
    .heading-text {
        padding: 10px; 
        text-align: <?php echo $options['align'] ?>; 
        font-size: <?php echo $options['font_size'] ?>px; 
        font-family: <?php echo $options['font_family'] ?>; 
        font-weight: <?php echo $options['font_weight'] ?>; 
        color: <?php echo $options['font_color'] ?>;
    }
</style>
<table border="0" cellpadding="0" cellspacing="0" width="100%" >
    <tr>
        <td align="center" class="heading-text">

            <?php echo $options['text'] ?>

        </td>
    </tr>
</table>
