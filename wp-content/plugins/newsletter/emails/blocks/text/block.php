<?php
/*
 * Name: Text
 * Section: content
 * Description: Free text block
 * 
 */

/* @var $options array */

$default_options = array(
    'html'=>'<p style="text-align: left; font-size: 16px; font-family: Arial">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nam vitae sodales nulla, nec blandit velit. Morbi feugiat imperdiet augue, vel mattis augue sagittis rutrum. Sed.</p>',
    'font_family'=>'Helvetica, Arial, sans-serif',
    'font_size'=>16,
    'font_color'=>'#000000',
    'block_padding_left'=>15,
    'block_padding_right'=>15,
    'block_background'=>'#ffffff'
);

$options = array_merge($default_options, $options);
/*
$options['html'] = str_replace('<p>', '<p style="">', $options['html']);
$style = 'font-family: ' . $options['font_family'] . ';font-size: ' . $options['font_size'] . 'px; color: <?php echo $options['font_color']?>;
$options['html'] = str_replace('<p', '<p inline-class="text-p"', $options['html']);
 */
 ?>
<style>
    .text-td {
        font-family: <?php echo $options['font_family']?>;
        font-size: <?php echo $options['font_size']?>px;
        color: <?php echo $options['font_color']?>;
        line-height: 1.5rem;
    }
    .text-p {
        font-family: <?php echo $options['font_family']?>;
        font-size: <?php echo $options['font_size']?>px;
    }
</style>
<table width="100%" style="width: 100%!important" border="0" cellpadding="0" cellspacing="0">
    <tr>
        <td width="100%" valign="top" align="left" class="text-td">
            <?php echo $options['html'] ?>
        </td>
    </tr>
</table>

