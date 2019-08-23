<?php
/* 
 * @var $options array contains all the options the current block we're ediging contains
 * @var $controls NewsletterControls 
 */
/* @var $fields NewsletterFields */
?>

<?php //$fields->font() ?>
<?php $fields->wp_editor('html', 'Content') ?>
<?php $fields->block_commons() ?>