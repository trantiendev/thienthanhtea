<?php
/*
 * Name: Call To Action
 * Section: content
 * Description: Call to action button
 */

$default_options = array(
    'text' => 'Call to action',
    'background' => '#256F9C',
    'font_color' => '#ffffff',
    'url' => home_url(),
    'font_family' => $font_family,
    'font_size' => 16,
    'font_weight' => 'normal',
    'block_background' => '#ffffff',
    'width' => '200',
    'block_padding_top' => 20,
    'block_padding_bottom' => 20,
);

$options = array_merge($default_options, $options);
?>
<style>
    .cta-button {
        font-size: <?php echo $options['font_size'] ?>px;
        font-family: <?php echo $options['font_family'] ?>;
        font-weight: <?php echo $options['font_weight'] ?>;
        color: <?php echo $options['font_color'] ?>;
        text-decoration: none; 
        background-color: <?php echo $options['background'] ?>;
        line-height: normal;
        border-top: 15px solid <?php echo $options['background'] ?>; 
        border-bottom: 15px solid <?php echo $options['background'] ?>; 
        border-left: 25px solid <?php echo $options['background'] ?>; 
        border-right: 25px solid <?php echo $options['background'] ?>; 
        width: <?php echo $options['width'] ?>px; 
        max-width: 100%; 
        box-sizing: border-box; 
        border-radius: 3px; 
        -webkit-border-radius: 3px; 
        -moz-border-radius: 3px; 
        display: inline-block;
    }
</style>
<a href="<?php echo $options['url'] ?>" target="_blank" rel="noopener" class="cta-button"><?php echo $options['text'] ?></a>

<div itemscope="" itemtype="http://schema.org/EmailMessage">
    <div itemprop="potentialAction" itemscope="" itemtype="http://schema.org/ViewAction">
        <meta itemprop="url" content="<?php echo esc_attr($options['url']) ?>" />
        <meta itemprop="name" content="<?php echo esc_attr($options['text']) ?>" />
    </div>
    <meta itemprop="description" content="<?php echo esc_attr($options['text']) ?>" />
</div>
