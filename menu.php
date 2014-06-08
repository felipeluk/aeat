<div id="menu">
	<ul>
		<li class="item-title">MENU</li>
		<li class="<?php print (isset($_REQUEST['acao']) && $_REQUEST['acao'] == 'home')   ? 'active' : '' ?>"><a href="index.php?controle=AcidenteTrabalho&acao=home&uf=BA&cidade=SALVADOR" title="Pagina Inicial" class="iten iten-first">Pagina Inicial</a></li>
		<li class="<?php print (isset($_REQUEST['acao']) && $_REQUEST['acao'] == 'projeto')   ? 'active' : '' ?>"><a href="index.php?controle=AcidenteTrabalho&acao=projeto"	title="Informações do Projeto" class="iten iten-first">O Projeto</a></li>
		<li class="<?php print (isset($_REQUEST['acao']) && $_REQUEST['acao'] == 'conceitos')   ? 'active' : '' ?>"><a href="index.php?controle=AcidenteTrabalho&acao=conceitos"	title="Conceitos" class="iten">Conceitos</a></li>
		<li class="<?php print (isset($_REQUEST['acao']) && $_REQUEST['acao'] == 'listarAcidentesTrabalho')   ? 'active' : '' ?>"><a href="index.php?controle=AcidenteTrabalho&acao=listarAcidentesTrabalho&uf=BA&ano=2009" title="Lista AEAT" class="iten">AEAT nos Estados</a></li>
		<li class="<?php print (isset($_REQUEST['acao']) && $_REQUEST['acao'] == 'listarAcidentesTrabalhoPorEstadoComTotais')   ? 'active' : '' ?>"><a href="index.php?controle=AcidenteTrabalho&acao=listarAcidentesTrabalhoPorEstadoComTotais&uf=BA&ano=2009" title="Graficos AEAT" class="iten">Percentual por Estado </a></li>
		<li><a href="http://www.previdencia.gov.br/arquivos/office/3_111202-105614-161.pdf" target="_blank" title="Anuario Estatistico de Acidentes do Trabalho de 2009" class="iten iten-last"> Guia AEAT 2009 </a></li>
	</ul>
</div>


