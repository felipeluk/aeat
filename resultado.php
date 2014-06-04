<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1">
<title>Treinamento HTML - CSS - JavaScript - Jquery</title>

<!-- CSS Site -->
<link rel="stylesheet" type="text/css" href="css/style.css">
<link rel="stylesheet" type="text/css" href="css/styleCss3.css">

<!-- jQuery Core -->
<script type="text/javascript" src="js/jquery-1.10.2.js"></script>

</head>
<body>

	<div id="container">

		<!-- PACOTE -->
		<div id="wrapper">

			<!-- CABEÇALHO -->
			<div id="header">
				<div id="logo"></div>
				<div id="title">
					<h1>TREINAMENTO</h1>
				</div>
			</div>

			<!-- CONTEUDO -->
			<div id="content">
				<div id="menu">
					<ul>
						<li class="item-title">MENU</li>
						<li><a href="index.html" title="Principal"
							class="iten iten-first">HOME</a></li>
						<li><a href="incluir.html" title="Incluir" class="iten">FORMULARIO</a></li>
						<li class="item-last"><a href="listar.html" title="Listar"
							class="iten">TABELA</a></li>
					</ul>
				</div>

				<div id="lista">
					<table>
				    <?php
				    // include class file
				    include 'lib/reader.php';
				    
				    // initialize reader object
				    $excel = new Spreadsheet_Excel_Reader();
				    
				    // read spreadsheet data
				    $excel->read('cid_centro_oeste_2009.xls');    
				    
				    
				   // print_r($excel->sheets[0]['cells']);
				   
				    /*
				    {"acidentes_de_trabalho":[
						{ "quantidade": { "acidentes_com_cat": {"trajeto": 3, "doenca": 0, "tipicos": 4}, 
										  "obitos": 0, 
										  "acidentes_sem_cat": 42}, 
						  "municipio": {"cod_ibge": 160027, "uf": "AP", "nome": "LARANJAL DO JARI"}
                         }]
					};*/
						  
				   
				    $linhas = $excel->sheets[0]['numRows'];
				    $cols = $excel->sheets[0]['numCols'];
				    
				    $cids = array();
				    $data = array();
				    foreach ($excel->sheets[0]['cells'] as $cell) {
					
						$data = explode(':', $cell[1]);
						
						//print_r($data);
						//exit();
						if (isset($data[0]) && trim($data[0]) != "Nome") {
							//print $data[1] . "<br />"; 
							
							$cid = array();
							$cid['info']['codigo'] = trim($data[0]);
							$cid['info']['nome'] = trim($data[1]);
							
							$cid['quantidade']['tipico'] = $cell[2];
							$cid['quantidade']['trajeto'] = $cell[3];
							$cid['quantidade']['doenca'] = $cell[4];
							$cid['quantidade']['semCategoria'] = $cell[5];	
	
							$cids[] = $cid;
							unset($cid);
						}
						
					}
					
					//print_r(json_encode($cids));
					print_r($cids);
					
				    
				    //for ($linha = 1; $linha <= $linhas; $linha++) {
					//	for ($col = 1; $col <= $cols; $col++) {

					//	}	
					//}
				    
				    // iterate over spreadsheet cells and print as HTML table
				    /*
				    $x=1;
				    while($x<=$excel->sheets[0]['numRows']) {
				      echo "\t<tr>\n";
				      $y=1;
				      while($y<=$excel->sheets[0]['numCols']) {
				        $cell = isset($excel->sheets[0]['cells'][$x][$y]) ? $excel->sheets[0]['cells'][$x][$y] : '';
				        echo "\t\t<td>$cell</td>\n";  
				        $y++;
				      }  
				      echo "\t</tr>\n";
				      $x++;
				    }*/
				    ?>    
				    </table>
				</div>
			</div>

			<div id="footer">
				<p>
					Treinamento de HTML - CSS - JavaScript - jQuery <BR /> POSTALIS -
					INSTITUTO DE SEGURIDADE SOCIAL DOS CORREIOS E TELÉGRAFOS
				</p>
			</div>
		</div>
	</div>
</body>
</html>
