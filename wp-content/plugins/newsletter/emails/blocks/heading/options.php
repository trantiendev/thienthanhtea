<?php

/* @var $fields NewsletterFields */
?>
<?php $fields->text('text', __('Text', 'newsletter')) ?>
<?php $fields->font() ?>
<?php $fields->select('align', 'Alignment', array('center'=>'Center', 'left'=>'Left', 'right'=>'Right')) ?>


<?php $fields->block_commons() ?>
