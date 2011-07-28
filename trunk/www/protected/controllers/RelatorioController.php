<?php

class RelatorioController extends Controller
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	public $layout='//layouts/column2';
	
	/**
	 * Diretório de save dos relatórios
	 * @var String
	 */ 
	private $_pathRelatorio;
	
	public function init()
	{
		$this->_pathRelatorio = Yii::getPathOfAlias('application') . '/../files/';
	}
	
	public function actionIndex()
	{
		$model=new Lancamento('search');
		$model->unsetAttributes();  // clear any default values
		
		if(isset($_GET['Lancamento'])) {
			$model->attributes=$_GET['Lancamento'];
		}
		//se está solicitando relatório, gera requisição
		if (isset($_GET['Export'])) {
			$param = $model->attributes['vencimento'];
			
			$chave = md5((string) date('d/m/yii:hh:ss') . $param);
			
			//grava solicitação na fila
			$tarefa = new Fila();
			$tarefa->Chave = $chave;
			$tarefa->Classe = 'application.extensions.tcpdf.ETcPdf';
			$tarefa->Parametros = $param;	
			$tarefa->insert();
			
			//adiciona cliente para a chave
			Yii::app()->gearman->client()->doBackground('geraRelatorio', $chave);
			
			//redireciona

            $this->redirect('index.php?r=relatorio/exportacao');
		}
		//do contrário
		else {
			$this->render('index',array(
				'model'=>$model,
			));
		}
	}
	
	/**
	 * Worker do Gearman
	 * Deve ser rodado manualmente
	 * 
	 * @return void
	 */ 
	public function actionWorker()
	{	
		Yii::app()->gearman->worker()->addFunction('geraRelatorio', array($this, 'geraRelatorio'));
		while(Yii::app()->gearman->worker()->work());
	}
	
	public function geraRelatorio($job)
	{
		//somente para demonstrar o uso do gearman
		sleep(20);
		
		//pega chave
		$chave = $job->workload();
		
		//pega item da fila
		$fila = Fila::model()->findByPk($chave);
		
		if ($fila) {

			//pega itens a exibir no relatorio
			$model=new Lancamento('search');
			$model->unsetAttributes();  // clear any default values

			if ($fila->Parametros != '' && $fila->Parametros != null) {
				$model->attributes = array('vencimento' => $fila->Parametros);
			}
			$provider = $model->findAll();
			$dados = array();
			foreach($provider as $t) {
				$dados[] = $t->attributes;
			}
			
			$fileName = '';
			
			switch($fila->Classe) {
				
				case 'application.extensions.tcpdf.ETcPdf': {
					//seta filename
					$filename = $chave . '.pdf';
					
					$pdf = Yii::createComponent($fila->Classe, 'P', 'cm', 'A4', true, 'UTF-8');
					
					//Table parameters
					$col = 72;
					$wideCol = 3 * $col;
					$indent = ( $pdf->getPageWidth() - 2 * 72 - $wideCol - 3 * $col ) / 2;
					$line = 18;
				
					//gera pdf
					$pdf->SetCreator(PDF_CREATOR);
					$pdf->SetAuthor("Fidelize");
					$pdf->SetTitle("Relatorio de Lançamento");
					$pdf->SetSubject("Fidelize");
					$pdf->SetKeywords("relatorio lançamento, relatorio fidelize");
					$pdf->setPrintHeader(false);
					$pdf->setPrintFooter(false);
					$pdf->AliasNbPages();
					$pdf->AddPage();
					
					$pdf->Cell(0,0,"Relatório",1,1,'C');
					$pdf->Cell(0,0,"Parâmetro: " . $fila->Parametros,1,1,'C');
					$pdf->Ln();
					
					$html = '<table border="1" width="600" align="center">';
					$html .= '<tr>'; 
					$html .= '<td>Vencimento</td>';
					$html .= '<td>Valor</td>';
					$html .= '<td>Descrição</td>';
					$html .= '</tr>';
					
					foreach( $dados as $item ) {
						$html .= '<tr>'; 
						$html .= '<td>' . $item['vencimento'] . '</td>';
						$html .= '<td>' . $item['valor'] . '</td>';
						$html .= '<td>' . $item['descricao'] . '</td>';
						$html .= '</tr>';
					}
					
					$pdf->writeHTML($html, 'LRTB', 1, 1, true, 'L'); 
					
					$pdf->Output($this->_pathRelatorio . $filename, "F");

					break;
				}
			
			}
			
			//insere na tbl mensagem
			$msg = new Mensagem();
			$msg->chave = $chave;
			$msg->link = $filename;
			$msg->insert();
			
			//remove da tbl fila
			$fila->delete(); 
			
		}
		
		return;
	}
	
	public function actionExportacao()
	{
		$this->render('exportacao');
	}
}
