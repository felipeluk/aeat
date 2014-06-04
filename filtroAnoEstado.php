	<?php
		$param = $this->getParams();		
		$listaEstados = $param['listaEstados']; 
	?>
	
	<p>Utilize os filtros ANO e ESTADO para visualizar o percentual/quantitativo de Acidentes de Trabalho nos estados brasileiros.</p>
	
	<fieldset>		
		<legend>Escolha as opções</legend>
		<div id="content-fieldset">
			<label for="selectAno"> Ano: </label>	
			<select id="selectAno" name="ano">
				<option value="2002" <?php print (isset($_REQUEST['ano']) && $_REQUEST['ano'] == '2002')   ? 'selected="selected"' : '' ?>>2002</option>
				<option value="2003" <?php print (isset($_REQUEST['ano']) && $_REQUEST['ano'] == '2003')   ? 'selected="selected"' : '' ?>>2003</option>
				<option value="2004" <?php print (isset($_REQUEST['ano']) && $_REQUEST['ano'] == '2004')   ? 'selected="selected"' : '' ?>>2004</option>
				<option value="2005" <?php print (isset($_REQUEST['ano']) && $_REQUEST['ano'] == '2005')   ? 'selected="selected"' : '' ?>>2005</option>
				<option value="2006" <?php print (isset($_REQUEST['ano']) && $_REQUEST['ano'] == '2006')   ? 'selected="selected"' : '' ?>>2006</option>
				<option value="2007" <?php print (isset($_REQUEST['ano']) && $_REQUEST['ano'] == '2007')   ? 'selected="selected"' : '' ?>>2007</option>
				<option value="2008" <?php print (isset($_REQUEST['ano']) && $_REQUEST['ano'] == '2008')   ? 'selected="selected"' : '' ?>>2008</option>
				<option value="2009" <?php print (isset($_REQUEST['ano']) && $_REQUEST['ano'] == '2009')   ? 'selected="selected"' : '' ?>>2009</option>
			</select>
			&ensp;&ensp;
			
			<label for="selectEstado"> Estado: </label>
			<select id="selectEstado" name="uf">
				<option value=""   <?php print (isset($_REQUEST['uf']) && $_REQUEST['uf'] == '')   ? 'selected="selected"' : '' ?>>TODOS</option>			
				<?php 
					foreach ($listaEstados as $estado) {
						$selected = (isset($_REQUEST['uf']) && $_REQUEST['uf'] == $estado) ? 'selected=\"selected\"' : ''; 
						print "<option value=\"$estado\" $selected  >" . $estado . "</option>";
					}
				?>			
			</select>		
			<input type="submit" name="filtar" value="Filtrar" />
		</div>
	</fieldset>	