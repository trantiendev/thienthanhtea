<?php
/* @var $fields NewsletterFields */
?>

<?php $fields->color('color', __('Color', 'newsletter')) ?>
<?php $fields->select('height', __('Height', 'newsletter'), array('1' => 1, '2' => 2, '3' => 3, '4' => 4, '5' => 5)) ?>

<?php $fields->block_commons() ?>