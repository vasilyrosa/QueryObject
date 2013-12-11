<?php

/* exemplo de teste da classe DELETE
  neste exemplo vamos simular a exclusão do registro id=3
 */

/* função autoload() 
 carrega uma classe se for necessário
*/

function __autoload($classe)
{
	if(file_exists("app.ado/{$classe}.class.php"))
	{
		include_once "app.ado/{$classe}.class.php";
	}
}

//criteria de seleção de dados
$criteria = new TCriteria;
$criteria->add(new TFilter('id', ' = ', '3'));

//cria a instrução Delete
$sql = new TSqlDelete;
//define a entidade
$sql->setEntity('aluno');
//define o critério de seleção de dados
$sql->setCriteria($criteria);
//processa a isntrução SQL

echo $sql->getInstruction();
echo '<br />';
?>