<?php

/* funcção __autoload()
 carrega determinada clase se necessário
 */

function __autoload($classe)
{
    if (file_exists("app.ado/{$classe}.class.php"))
    {
        include_once "app.ado/{$classe}.class.php";
    }
}

//cria criterio de seleção de dados

//seleciona todas  as meninas (F)
//que estão na terceia serie
$criteria1 = new TCriteria;
$criteria1->add(new TFilter('sexo', ' = ', 'F'));
$criteria1->add(new TFilter('serie', ' = ', '3'));


//seleciona todos os meninos(M)
// que estão na quarta serie(4)
$criteria2 = new TCriteria;
$criteria2->add(new TFilter('sexo', ' = ', 'M'));
$criteria2->add(new TFilter('serie', ' = ', '4'));

//agora juntamos os dois critérios utilizando
//o operador lógico OR o resultado deve conter
//"meninas da 3° serie OU meninos da 4° série"

$criteria = new TCriteria;
$criteria->add($criteria1, TExpression::OR_OPERATOR);
$criteria->add($criteria2, TExpression::OR_OPERATOR);


//DEFINE O ORDENAMENTO
$criteria->setProperty('order', 'nome');

//cria instrução de SELECT
$sql = new TSqlSelect;
//define o nome da entidade
$sql->setEntity('aluno');
//acrecenta todas colunas a consulta
$sql->addColumn('*');
//acrescenta o criterio de seleção  de dados
$sql->setCriteria($criteria);

//processa a isntrução SQL
echo $sql->getInstruction();
echo '<br />';

/* resultado

 SELECT * FROM aluno
  WHERE sexo = 'F' AND serie = '3' 
  OR sexo = 'M' AND serie = '4' 
  ORDER BY nome

 */


?>