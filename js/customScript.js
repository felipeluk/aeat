
$(function() {		
	$('#myTable').dataTable();
	
	// Uniform
	$("input, file").uniform();	
	
	$( "#chart_div" ).dialog({
	  title:" Evolução do AEAT no periodo de 2002 a 2009",
	  resizable: true,
	  height: 690,
	  width: 900,	     
      autoOpen: false,
      modal:true,
      show: {
        effect: "slide",
        duration: 1200
      },
      hide: {
        effect: "explode",
        duration: 1200
      }
    });

    $( "#opEvolucao" ).click(function() {   
    	var ano = $( "#selectAno option:selected" ).val();
    	var uf = $( "#selectEstado option:selected" ).val();
    	$('#chart_div').html("<div class=\"aguarde\"> Processando os dados... <br /><br /> Favor aguarde! </div>");
    	$('#chart_div').load('index.php?controle=AcidenteTrabalho&acao=ajaxListarAcidentesTrabalhoPorEstadoComTotais&uf='+uf+'&ano='+ano, function() {
    		drawVisualization();
    	}).dialog("open");
    });
    
    $( "#opEvolucaoCidade" ).click(function() {   
    	var cidade = $( "#selectCidade option:selected" ).val();
    	var uf = $( "#selectEstado option:selected" ).val();
    	$('#chart_divCidade').html("<div class=\"aguarde\"> Processando os dados... <br /><br /> Favor aguarde! </div>");
    	$('#chart_divCidade').load('index.php?controle=AcidenteTrabalho&acao=ajaxListarAcidentesTrabalhoPorCidadeComTotais&uf='+uf+'&cidade='+cidade, function() {
    		drawVisualization();
    	});
    });
  
});