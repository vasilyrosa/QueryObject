<?php
 /*==========  testar a classe TCriteria  ==========*/

 include_once 'app.ado/TExpression.class.php';
 include_once 'app.ado/TCriteria.class.php';
 include_once 'app.ado/TFilter.class.php';

 /* aqui vemos um exemplo de critério usando o operador lógico OR */
 //exemplo a idade deve ser menor que 16 OU maior que 60

 $criteria = new TCriteria;
 $criteria->add(new TFilter('idade', ' < ', 16), TExpression::OR_OPERATOR);
 $criteria->add(new TFilter('idade', ' > ', 60), TExpression::OR_OPERATOR);
 echo $criteria->dump();
 echo '<br />';

 //aqui vemos um exemplo de critério utilizando o operador lógico AND
 //juntamente com os operadores de conjunto IN (dentro do conjunto) e NOT IN (fora do conjunto)
 //a idade deve estar dentro do conjunto (24,25,26) e deve estar fora do conjunto (10)

 $criteria = new TCriteria;
 $criteria->add(new TFilter(' idade ', ' IN ', array(24,25,26)));
 $criteria->add(new TFilter(' idade ',' NOT IN ', array(10)));
 echo $criteria->dump();
 echo '<br />';
 
 //aqui vemos um exemplo de comparação utilizando o operador de comparação LIKE
 //o nome deve iniciar por Pedro ou por Maria
 $criteria = new TCriteria;
 $criteria->add(new TFilter('nome', ' LIKE ', 'pedro%'));
 $criteria->add(new TFilter('nome',' LIKE', 'Maria%'));
 echo $criteria->dump();
 echo '<br />';

 //aqui vemos um exemplo de critério utilizando o operador ' = ' e IS NOT
 //nesse caso o telefone não ode conter o valor nulo(IS NOT NULL)
 //e o sexo deve ser feminino (sexo ='F')
 
 $criteria = new TCriteria;
 $criteria->add(new TFilter('telefone', ' IS NOT ', NULL));
 $criteria->add(new TFilter('sexo',' =', 'F'));
 echo $criteria->dump();
 echo '<br />';

 //aqui vemos  o uso dos operadores de comparação IN e NOT IN juntamente com
 //conjuntos de string. Neste caso, a UF deve estar entre(RS,SC, PR) E
 //não deve estar entre (AC e PI)

 $criteria = new TCriteria;
 $criteria->add(new TFilter('UF', ' IN ', array('RS','SC','PR')));
 $criteria->add(new TFilter('UF',' NOT IN', array('AC','PI')));
 echo $criteria->dump();
 echo '<br />';

 //neste caso temos o uso de um critério composto
 // o primeiro critério aponta para o sexo='F'
 //(sexo feminino) e idade > 18 (maior idade)

 $criteria1 = new TCriteria;
 $criteria1->add(new TFilter('sexo', ' = ', 'F'));
 $criteria1->add(new TFilter('idade',' > ', '18'));
 echo $criteria1->dump();
 echo '<br />';

 //o segundo critério aponta o sexo='M' (masculino)
 //e idade < 16 (menor de idade)

 $criteria2 = new TCriteria;
 $criteria2->add(new TFilter('sexo', ' = ', 'M'));
 $criteria2->add(new TFilter('idade',' < ', '16'));
 echo $criteria2->dump();
 echo '<br />';

 //agora juntamos os dois resultados utilizando o operador lógico OR o resultado
 //deve conter 'mulheres maiores de 18 OU homens menores de 16'
 $criteria = new TCriteria;
 $criteria->add($criteria1, TExpression::OR_OPERATOR);
 $criteria->add($criteria2, TExpression::OR_OPERATOR);
 echo $criteria->dump();
 echo '<br />';

?>