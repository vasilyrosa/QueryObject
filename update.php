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

//critério de seleção de dados

$criteria = new TCriteria;
$criteria->add(new TFilter('id', ' = ', '3'));

//cria instrução de UPDATE
$sql = new TSqLUpdate;

//defie a entidade
$sql->setEntity('aluno');
//atribui o valor de cada coluna
$sql->setRowData('nome', 'Pedro Cardoso da Silva');
$sql->setRowData('rua', 'Machado de Assis');
$sql->setRowData('fone', '(88) 5555-7774');

//define o critério de seleção dos dados
$sql->setCriteria($criteria);

//processa a isntrução SQL

echo $sql->getInstruction();
echo '<br />';

/* Result 

UPDATE aluno SET 
nome = 'Pedro Cardoso da Silva', 
rua = 'Machado de Assis', 
fone = '(88) 5555-7774' 
WHERE id = '3'
 */


?>