	<?php
		$param = $this->getParams();		
		$listaEstados = $param['listaEstados']; 
	?>
	
	<p>Utilize o filtro ESTADO para visualizar o quantitativo de Acidentes de Trabalho nos estados brasileiros no periodo de 2002 a 2009</p>
	
	<fieldset>		
		<legend>Escolha as opções</legend>
		<div id="content-fieldset">			
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