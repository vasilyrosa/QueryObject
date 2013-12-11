<?php
/**
* função __autoload()
* carrega ma classe quando ela é necessária
* ou instancia pela primeira vez
**/

function __autoload($classe)
{
	if(file_exists("app.ado/{$classe}.class.php"))
	{
		include_once "app.ado/{$classe}.class.php";
	} else {
		echo 'arquivo não encontrado!';
		die;
	}
}

//define LOCALE do sistema para permitir ponto decimal.
//PS: no windows, usar 'english'
setlocale(LC_NUMERIC, 'english' );

//cria uma instrução de INSERT
@$sql = new TSqlInsert;
//define p nome da entidade
$sql->setEntity('aluno');
//atribui o valor de cada coluna
$sql->setRowData('id',         3);
$sql->setRowData('nome',       'Pedro Cardoso');
$sql->setRowData('fone',       '(88) 4444-7777');
$sql->setRowData('nascimento', '1985-04-12');
$sql->setRowData('sexo',        'M');
$sql->setRowData('serie',       '4');
$sql->setRowData('mensalidade',  280.40);

//processa a isntrução sql

echo $sql->getInstruction();
echo '<br />';


/*==========  Resultado  

INSERT INTO aluno (id, nome, fone, nascimento, sexo, serie, mensalidade) 
VALUES (3, 'Pedro Cardoso', '(88) 4444-7777', '1985-04-12', 'M', '4', 280.4)

==========*/
?>

