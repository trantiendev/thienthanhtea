<?php

/* @var $fields NewsletterFields */
?>

<?php $fields->text('text', 'Button label') ?>
<?php $fields->url('url', 'Button URL') ?>
<?php $fields->font('font', __('Font', 'newsletter')) ?>
<?php $fields->color('background', 'Button background') ?>
<?php $fields->size('width', __('Width', 'newsletter')) ?>

<?php $fields->block_commons() ?>
