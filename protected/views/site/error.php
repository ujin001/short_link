<?php
/* @var $this SiteController */
/* @var $error array */

$this->pageTitle=Yii::app()->name . ' - Error';
?>

<h2>Упс! <?php echo $code; ?></h2>

<div class="error">
	<?php echo CHtml::encode($message); ?>
</div>

<div class="prepend-top">
	<?= CHtml::link('Укоротить ссылку!', $this->createAbsoluteUrl('/'))?>
</div>