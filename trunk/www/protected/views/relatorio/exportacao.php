<?php
$this->breadcrumbs=array(
	'Relatório',
);

$this->menu=array(
	array('label'=>'Relatório de Lançamento', 'url'=>array('index')),
);

Yii::app()->clientScript->registerScript('search', 'setTimeout("window.location.href=\'index.php?r=relatorio/exportacao\'",30000)');


?>

<h1>Solicitações de PDF</h1>

<p>Todos os relatórios requisitados por você aparecem aqui. </p>
<p>Somente os relatórios já processados podem ser baixados, através de link no último campo da grid de solicitações.</p>
<p>Os relatórios em processamento trarão, em vez de link para download, mensagem intuitiva de processamento agendado.</p>

<?php

$sql = "
	SELECT 
		to_char(\"data_solic\", 'DD/MM/YYYY HH12:MI:SS') as data,
		\"Parametros\" as parametros, 
		\"Chave\" as chave,
		'Aguarde. Processando.' as status,
		null as link
	FROM tbl_fila 
	UNION 
	SELECT 
		to_char(\"data_gerado\", 'DD/MM/YYYY HH12:MI:SS') as data,
		null as parametros, 
		\"chave\" as chave,
		'Processado' as status,
		link as link 
	FROM 
		tbl_mensagem
";

$count=Yii::app()->db->createCommand("
	SELECT 
		COUNT(*)
	FROM ( 
		SELECT 
			\"Chave\" as chave 
		FROM 
			tbl_fila 
		UNION 
			SELECT \"chave\" 
		FROM tbl_mensagem
	) a
")->queryScalar();

$dataProvider=new CSqlDataProvider($sql, array(
	'keyField' => 'chave',
	'totalItemCount'=>$count,
	'sort'=>array(
		'attributes'=>array(
			 'data', 
			 'parametros', 
			 'chave',
			 'status'
		),
	),
	'pagination'=>array(
		'pageSize'=>20,
	),
));

$this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'exportacao-grid',
	'dataProvider'=>$dataProvider,
	'ajaxUpdate'=>false,
	'summaryText' => 'Mostrando {start} - {end} de {count} resultados',
	'emptyText' => 'Nenhum relatório solicitado',
	'columns'=>array(
		'data', 
		'parametros', 
		'chave',
		array(
			'class'=>'CLinkColumn',
			'labelExpression'=>'$data[\'status\']',
			'urlExpression'=>'$data[\'status\'] == \'Processado\' ? "files/" . $data[\'link\'] : null',
			'header'=>'Relatorio'
		  ),
	),
)); 
