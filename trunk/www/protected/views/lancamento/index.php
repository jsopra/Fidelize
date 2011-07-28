<?php
$this->breadcrumbs=array(
	'Lancamentos',
);

$this->menu=array(
	array('label'=>'Adicionar Lancamento', 'url'=>array('create')),
	array('label'=>'Gerenciar Lancamento', 'url'=>array('admin')),
);
?>

<h1>Lancamentos</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
	'summaryText' => 'Mostrando {start} - {end} de {count} resultados',
	'emptyText' => 'Nenhum lançamento efetuado',
)); ?>
