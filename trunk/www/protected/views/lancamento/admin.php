<?php
$this->breadcrumbs=array(
	'Lancamentos'=>array('index'),
	'Gerenciar',
);

$this->menu=array(
	array('label'=>'Listar Lancamento', 'url'=>array('index')),
	array('label'=>'Adicionar Lancamento', 'url'=>array('create')),
);


Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('lancamento-grid', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Gerenciar Lancamentos</h1>

<p>
Você pode, opcionalmente, digitar um operador de comparação (<b>&lt;</b>, <b>&lt;=</b>, <b>&gt;</b>, <b>&gt;=</b>, <b>&lt;&gt;</b>
or <b>=</b>) no início de cada um dos valores da sua pesquisa para especificar comparações.
</p>

<?php echo CHtml::link('Busca Avançada','#',array('class'=>'search-button')); ?>
<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'lancamento-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'summaryText' => 'Mostrando {start} - {end} de {count} resultados',
	'emptyText' => 'Nenhum lançamento efetuado',
	'columns'=>array(
		'id',
		'vencimento',
		'valor',
		'cta_credor',
		'cta_devedor',
		'descricao',
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>
