 <?php
    // include class file
    include '../lib/reader.php';
    
    // initialize reader object
    $excel = new Spreadsheet_Excel_Reader();
    
    // read spreadsheet data
    $excel->read('../cid_centro_oeste_2009.xls');    
   
    $linhas = $excel->sheets[0]['numRows'];
    $cols = $excel->sheets[0]['numCols'];
    
    $cids = array();
    $data = array();
    foreach ($excel->sheets[0]['cells'] as $cell) {
		//print $cell[1] . "<br>"; 
		$data = explode(':', $cell[1]);

		if (isset($data[1])) {
	
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
	
	print_r($cids);
 ?>