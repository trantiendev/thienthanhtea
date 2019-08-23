<?php
/*
 * @var $options array contains all the options the current block we're ediging contains
 * @var $controls NewsletterControls 
 */
/* @var $fields NewsletterFields */
?>

<?php $fields->select('layout', __('Layout', 'newsletter'), array('full' => 'Full', 'left' => 'Left'))?>
<?php $fields->media('image', __('Image', 'newsletter'))?>

<?php $fields->text('title', __('Title', 'newsletter')) ?>
<?php $fields->font('title_font')?>

<?php $fields->textarea('text', __('Text', 'newsletter')) ?>
<?php $fields->font('font')?>

<?php $fields->button('button', __('Button', 'newsletter'))?>

<?php $fields->block_commons() ?>

