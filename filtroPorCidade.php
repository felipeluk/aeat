<?php
	$v_params = $this->getParams();	
	$listaCidades =  $v_params['listaCidades'];
?>


<h2>Evolu&ccedil;&atilde;o AEAT na cidade </h2>
<div id="infoCidade">
	<p>Clique em uma das cidades para saber mais sobre os Acidentes de Trabalho no periodo de 2002 a 2009</p>
</div>

<fieldset>		
		<legend>Escolha as opções</legend>
<form id="formCidade" method="post" action="index.php">
	
	<input type="hidden" name="controle" value="AcidenteTrabalho"> 
	<input type="hidden" name="acao"     value="listarAcidentesTrabalhoPorCidade">

	<label for="selectCidade"> Cidade: </label>
	<select id="selectCidade" name="cidade">					
		<?php 
			foreach ($listaCidades as $cidade) {		
				$selected = (isset($_REQUEST['cidade']) && $_REQUEST['cidade'] == $cidade->getNome()) ? 'selected=\"selected\"' : ''; 
				print '<option value="' . $cidade->getNome() . '" ' .$selected . '>' . $cidade->getNome() . '</option>';
			}
		?>			
	</select>
	
	<input type="hidden" name="uf" value="<?php echo $_REQUEST['uf']; ?>">
	<input type="hidden" name="ano" value="<?php echo $_REQUEST['ano']; ?>">
	<input type="submit" name="Visualizar" value="Visualizar" />
</form>
</fieldset>