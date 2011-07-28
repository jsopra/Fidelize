<?php

$this->breadcrumbs=array(
	'Lancamentos'=>array('index'),
	'Criar',
);

$this->menu=array(
	array('label'=>'Listar Lancamento', 'url'=>array('index')),
	array('label'=>'Gerenciar Lancamento', 'url'=>array('admin')),
);

$cs=Yii::app()->clientScript;
$cs->registerScriptFile(Yii::app()->baseUrl.'/js/jquery.maskedinput-1.3.min.js',CClientScript::POS_HEAD);

Yii::app()->clientScript->registerScript('maskeddate', "
	$('#Lancamento_vencimento').mask(\"99/99/9999\",{placeholder:\"_\"});
");

?>

<h1>Create Lancamento</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>
