<div class="form">
	<?php $form = $this->beginWidget('CActiveForm', [
			'id' => 'url-generation-form',
			'enableClientValidation' => true,
			'clientOptions' => [
				'validateOnSubmit' => true,
			],
	]); ?>

	<div class="row">
		<?= $form->urlField($model, 'original_url') ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Укоротить'); ?>
	</div>

	<?php $this->endWidget(); ?>
</div>