<?php

/* @var $options array contains all the options the current block we're ediging contains */
/* @var $controls NewsletterControls */
/* @var $fields NewsletterFields */
?>

<?php $fields->select('layout', __('Layout', 'newsletter'), array('one' => __('One column', 'newsletter'), 'two' => __('Two columns', 'newsletter'))) ?>

<?php $fields->font('title_font', __('Title font', 'newsletter')) ?>

<?php $fields->font('font', __('Excerpt font', 'newsletter')) ?>

<?php $fields->checkbox('show_image', __('Show image', 'newsletter')) ?>

<?php $fields->checkbox('show_date', __('Show date', 'newsletter')) ?>

<?php $fields->select_number('max', __('Max posts', 'newsletter'), 1, 20); ?>

<?php $fields->language(); ?>

<?php $fields->button('button', 'Button', array('url' => false)) ?>

<?php $fields->section(__('Filters', 'newsletter')) ?>
<?php $fields->categories(); ?>
<?php $fields->text('tags', __('Tags', 'newsletter')); ?>

<?php $fields->block_commons() ?>

