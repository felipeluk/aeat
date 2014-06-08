<?php
	$v_params = $this->getParams();	
	$listaCidades =  $v_params['listaCidades'];
?>


<h2>Evolu&ccedil;&atilde;o AEAT na cidade </h2>
<div id="infoCidade">
	<p>Clique em uma das cidades, do estado (<?php print $_REQUEST['uf']; ?>), para saber mais sobre os Acidentes de Trabalho no periodo de 2002 a 2009.</p>
</div>

<fieldset>		
		<legend>Escolha as opções</legend>
<form id="formCidade" method="post" action="index.php">
	
	<input type="hidden" name="controle" value="AcidenteTrabalho"> 
	<input type="hidden" name="acao"     value="<?php print $_REQUEST['acao']; ?>">

	<label for="selectCidade"> Cidade: </label>
	<select id="selectCidade" name="cidade">					
		<?php 
			foreach ($listaCidades as $cidade) {				
				$selected = (isset($_REQUEST['cidade']) && strtoupper($_REQUEST['cidade']) == $cidade->getNome()) ? 'selected=\"selected\"' : ''; 
				if (!strstr($cidade->getNome(), 'IGNORADO')) {
					print '<option value="' . $cidade->getNome() . '" ' .$selected . '>' . $cidade->getNome() . '</option>';
				}
			}
		?>			
	</select>
	
	<input type="hidden" name="uf" value="<?php echo $_REQUEST['uf']; ?>">
	<input type="hidden" name="ano" value="<?php echo (isset($_REQUEST['ano'])) ? $_REQUEST['ano'] : '2002'; ?>">
	
	<?php if ($_REQUEST['acao'] == 'home') { ?>
		<input type="button" id="opEvolucaoCidade" value="Visualizar" />
	<?php } else { ?>
		<input type="submit" name="Visualizar" value="Visualizar" />
	<?php }?>
	
	
	
</form>
</fieldset>