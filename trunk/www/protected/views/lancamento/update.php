<?php
$this->breadcrumbs=array(
	'Lancamentos'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Atualizar',
);

$this->menu=array(
	array('label'=>'Listar Lancamento', 'url'=>array('index')),
	array('label'=>'Adicionar Lancamento', 'url'=>array('create')),
	array('label'=>'Ver Lancamento', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Gerenciar Lancamento', 'url'=>array('admin')),
);

$cs=Yii::app()->clientScript;
$cs->registerScriptFile(Yii::app()->baseUrl.'/js/jquery.maskedinput-1.3.min.js',CClientScript::POS_HEAD);

Yii::app()->clientScript->registerScript('maskeddate', "
	$('#Lancamento_vencimento').mask(\"99/99/9999\",{placeholder:\"_\"});
");

?>

<h1>Update Lancamento <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>
