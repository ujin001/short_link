<div class="form">
	<?php $form = $this->beginWidget('CActiveForm', [
			'id' => 'url-generation-form',
			'enableClientValidation' => false,
			'enableAjaxValidation' => true,
			'clientOptions' => [
				'validateOnChange' => false,
				'validateOnSubmit' => true,
				'beforeValidate' => 'js: function(form) {
					main.beforeValidate(form);
					return true;
				}',
				'afterValidate' => 'js: function(form, data, hasError) {
					main.afterValidate(data);
					return false;
				}',
			],
	]); ?>

	<div class="flash-success hide">
		Короткая ссылка: <span id="short_url"></span>
	</div>

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