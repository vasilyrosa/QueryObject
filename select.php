<?php

/* funcção __autoload()
 carrega determinada clase se necessário
 */

function __autoload($classe)
{
	if(file_exists("app.ado/{$classe}.class.php"))
	{
		include_once "app.ado/{$classe}.class.php";
	}
}

//cria criterio de seleção de dados

$criteria = new TCriteria;
$criteria->add(new TFilter('nome', ' LIKE ', 'Maria%'));
$criteria->add(new TFilter('cidade', ' LIKE ' , 'Porto%'));

//define o intervalo da consulta
$criteria->setProperty('offset', 0);
$criteria->setProperty('limit', 10);

//define o ordenamento da consulta
$criteria->setProperty('order', 'nome');

//cria instrução de SELECT
$sql = new TSqlSelect;
//define o nome da entidade
$sql->setEntity('aluno');
//acrescenta colunas a consulta 
$sql->addColumn('nome');
$sql->addColumn('fone');
//define o critério de seleção de dados
$sql->setCriteria($criteria);

//processo da instrução sql
echo $sql->getInstruction();
echo '<br />';

/* 
resultado

SELECT nome, fone 
FROM aluno 
WHERE nome LIKE 'Maria%' 
AND cidade LIKE 'Porto%' 
ORDER BY nome LIMIT 10

 */

?>