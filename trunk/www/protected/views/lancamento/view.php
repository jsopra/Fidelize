<?php
$this->breadcrumbs=array(
	'Lancamentos'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'Listar Lancamento', 'url'=>array('index')),
	array('label'=>'Adicionar Lancamento', 'url'=>array('create')),
	array('label'=>'Atualizar Lancamento', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Excluir Lancamento', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Gerenciar Lancamento', 'url'=>array('admin')),
);
?>

<h1>Ver Lancamento #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'vencimento',
		'valor',
		'cta_credor',
		'cta_devedor',
		'descricao',
	),
)); ?>
