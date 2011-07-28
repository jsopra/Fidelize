<?php
$this->breadcrumbs=array(
	'Relatório',
);

$this->menu=array(
	array('label'=>'Solicitações de PDF', 'url'=>array('exportacao')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('#gerarPDF')
.mouseover(function(){
	$(this).css('background-color','#E8E5BB');
})
.mouseout(function() {
	$(this).css('background-color','#FCF9CE');
});
$('#gerarPDF').click(function(){
	window.location.href = '?r=relatorio&Lancamento[vencimento]=' + $('input[name=\"Lancamento[vencimento]\"]').val() + '&Export=1';
});
");

?>

<h1>Relatório de Lançamento</h1>

<p>Quando tiver filtrado os dados e desejar exportar o relatório em PDF, basta clicar no botão "Imprimir para PDF" logo abaixo.</p>

<?php 

echo CHtml::submitButton( 'Imprimir para PDF', array( 'name' => 'exportar', 'id' => 'gerarPDF' ) );

$this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'relatorio-grid',
	'ajaxUpdate'=>false,
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'summaryText' => 'Mostrando {start} - {end} de {count} resultados',
	'emptyText' => 'Nenhum lançamento efetuado',
	'columns'=>array(
		array(
            'name'=>'id',
            'filter'=>false,
        ),
		'vencimento',
		array(
            'name'=>'valor',
            'filter'=>false,
        ),
        array(
            'name'=>'cta_credor',
            'filter'=>false,
        ),
        array(
            'name'=>'cta_devedor',
            'filter'=>false,
        ),
	),
)); 

?>
