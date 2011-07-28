<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'lancamento-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Campos com <span class="required">*</span> são requeridos.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'vencimento'); ?>
		<?php echo $form->textField($model,'vencimento'); ?>
		<?php echo $form->error($model,'vencimento'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'valor'); ?>
		<?php echo $form->textField($model,'valor'); ?>
		<?php echo $form->error($model,'valor'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'cta_credor'); ?>
		<?php echo $form->textField($model,'cta_credor',array('size'=>20,'maxlength'=>20)); ?>
		<?php echo $form->error($model,'cta_credor'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'cta_devedor'); ?>
		<?php echo $form->textField($model,'cta_devedor',array('size'=>20,'maxlength'=>20)); ?>
		<?php echo $form->error($model,'cta_devedor'); ?>
	</div>
	
	<div class="row">
		<?php echo $form->labelEx($model,'descricao'); ?>
		<?php echo $form->textArea($model,'descricao',array('size'=>1000,'maxlength'=>1000)); ?>
		<?php echo $form->error($model,'descricao'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Adicionar' : 'Salvar'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->
