<div class="form">
	<?php $form = $this->beginWidget('CActiveForm', [
			'id' => 'url-generation-form',
			'enableClientValidation' => false,
			'enableAjaxValidation' => true,
			'clientOptions' => [
				'validateOnSubmit' => true,
				'afterValidate' => 'return true;',
			],
	]); ?>

	<div class="row">
		<?= $form->textField($model, 'original_url', [
			'style' => 'width: 100%;',
		]) ?>
		<?= $form->error($model, 'original_url') ?>
	</div>

	<div class="row buttons" style="text-align: center;">
		<?= CHtml::submitButton('Укоротить'); ?>
	</div>

	<?php $this->endWidget(); ?>
</div>