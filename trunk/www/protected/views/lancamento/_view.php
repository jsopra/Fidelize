<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('vencimento')); ?>:</b>
	<?php echo CHtml::encode($data->vencimento); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('valor')); ?>:</b>
	<?php echo CHtml::encode($data->valor); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('cta_credor')); ?>:</b>
	<?php echo CHtml::encode($data->cta_credor); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('cta_devedor')); ?>:</b>
	<?php echo CHtml::encode($data->cta_devedor); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('descricao')); ?>:</b>
	<?php echo CHtml::encode($data->descricao); ?>
	<br />
	
</div>
