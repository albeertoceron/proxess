$idran_usuario=$_SESSION['usuario'];
	$registros_data=mysqli_query($conn,"SELECT * FROM prox_users WHERE idrand = '$idran_usuario'");
	$reg_usua=mysqli_fetch_array($registros_data);
	
	
	
	$mod=$_GET['mod'];
	
	
		$cte=$_GET['idran_cliente'];
		$scrsl=$_GET['id_sucursal'];
		$cntcto=$_GET['id_contacto'];
		$invntrio=$_GET['idran_inventario'];
		$slda=$_GET['idran_salida'];
		$ln=$_GET['linea'];	
	$tipodeprod=$_GET['tipodeprod'];
	$cantidad_solicitada = $_GET['cant_pedido'];	
	$line = $_GET['line'];
	$num_soli = $_GET['cant_pedido'];
	
		
$dia = date("d");
$mes = strftime("%B");
$anio = date("Y");
$fecha_upload = date("Y-m-d");
    
	
	$nombre_usuario=$reg_usua['nombre'].' '.$reg_usua['apellido'];
	
	
	
	?>

<!DOCTYPE html>
<html lang="en">
<head>
<title>Nuevo Pedido - Selecciona automática - Proxess</title>
<meta charset="UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0" />
<link rel="stylesheet" href="css/bootstrap.min.css" />
<link rel="stylesheet" href="css/bootstrap-responsive.min.css" />
<link rel="stylesheet" href="css/fullcalendar.css" />
<link rel="stylesheet" href="css/matrix-style.css" />
<link rel="stylesheet" href="css/matrix-media.css" />
<link href="font-awesome/css/font-awesome.css" rel="stylesheet" />
<link rel="stylesheet" href="css/jquery.gritter.css" />
<link href='http://fonts.googleapis.com/css?family=Open+Sans:400,700,800' rel='stylesheet' type='text/css'>
	<script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>	
	
<script type="text/javascript">
$(document).ready(function() {
    $("form").keypress(function(e) {
        if (e.which == 13) {
            return false;
        }
    });
});
</script>
	

	
	<script type="text/javascript">
function deshabilitaRetroceso(){
    window.location.hash="no-back-button";
    window.location.hash="Again-No-back-button" //chrome
    window.onhashchange=function(){window.location.hash="no-back-button";}
}
</script>

	
	

	
	
</head>
<body onload="deshabilitaRetroceso()">

<!--Header-part-->
<div id="header">
  <h1><a href="dashboard.html">Inicio</a></h1>
</div>
<!--close-Header-part--> 


<!--top-Header-menu-->
<div id="user-nav" class="navbar navbar-inverse">
  <ul class="nav">
    
	  <li class="">
		  <a title="" href="#">
			  <i class="icon icon-user"></i> <span class="text"><?php echo $reg_usua["nombre"].' '.$reg_usua["apellido"]; ?></span>
		 </a> 
	  </li>
    <li class=""><a title="" href="logout.php"><i class="icon icon-share-alt"></i> <span class="text">Salir</span></a></li>
  </ul>
</div>
<!--close-top-Header-menu-->
<!--start-top-serch-->
<div id="search">
  <input type="text" placeholder="Buscar..."/>
  <button type="submit" class="tip-bottom" title="Search"><i class="icon-search icon-white"></i></button>
</div>
<!--close-top-serch-->
<!--sidebar-menu-->

	
	<?php echo $sidebar_menu; ?>
<!--sidebar-menu-->

<!--main-container-part-->
<div id="content">
<!--breadcrumbs-->
  <div id="content-header">
    <div id="breadcrumb"> <a href="index.php" title="Regresar al inicio" class="tip-bottom"><i class="icon-home"></i> Inicio</a><a href="salidas.php" class="tip-bottom">Compras</a><a href="registro_salida_cliente.php" class="tip-bottom">Agregar Nuevo</a></div>
  </div>
<!--End-breadcrumbs-->
	
	<div class="container-fluid">
	
  <div class="row-fluid">
    <div class="span6">
      <div class="widget-box text-center">
	
	
	<div class="widget-title"> <span class="icon"> <i class="icon-align-justify"></i> </span>
          <h5>Selección automática de mercancía</h5>
        </div>
		  
        <div class="widget-content nopadding">
	
	
	<form id='form2' name='form2' method="post" enctype="multipart/form-data">	  
	
	
	
	
	<table class="table table-bordered table-striped">
              <thead>
			  
				  <tbody>
	
	
	
	
	<?php
	
    if ($mod=='comenzar'){
		
		
		$registro_tipodeprod=mysqli_query($conn,"SELECT * FROM tipo_producto WHERE id='$tipodeprod'");
		$regtiprod=mysqli_fetch_array($registro_tipodeprod);
		
		
		
		
		
			echo' <th colspan="4" style="background-color:#9C9C9C;"><h4 style="color:#FFFFFF;">'.$regtiprod['tipo'].'</h4> <h5 style="color:#FFFFFF;"> Linea: '.$ln.'</h5></th>
		</tr>';			
			
			
			echo '<tr><td colspan="4" class="widget-title align-center">
          <h5>Cantidad solicitada: '.$num_soli.' piezas</h5>
        </td></tr>';
			

		
		
			
//------------------------------------------------------------------------------------------------------------------------------------//
		
$transformar_linea=mysqli_query($conn,"SELECT * FROM lineas WHERE linea = '$ln'");
			$trans_lin = mysqli_fetch_array($transformar_linea);
			$lin_sol=$trans_lin['id'];

		
			$conteo_de_modelos=mysqli_query($conn,"SELECT * FROM seleccion_modelos WHERE idran_salida = '$slda' AND linea = '$lin_sol'");
			$contar_mods = mysqli_num_rows($conteo_de_modelos);
			
			
			$cantidad_solicitada = $num_soli;
	$dividir_modelos= $cantidad_solicitada / $contar_mods;
		$dividida = $dividir_modelos;
    $procesar_cant = number_format($dividida);
			
			
			
	$mostrar_modelos=mysqli_query($conn,"SELECT * FROM seleccion_modelos WHERE idran_salida = '$slda' and linea = '$line'");
			
			
	while($mos_mod=mysqli_fetch_array($mostrar_modelos)){
		
		
		
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////		
		

		$modelo_solic=$mos_mod['modelo'];
	
	
	$colsolic=$mos_mod['color'];
		
		
		echo' <th colspan="4"><h5>Modelo: '.$modelo_solic.'</h5></th>
		</tr>
                <tr>
                  <th colspan="2">Color</th>
                  <th>Existencias</th>
					<th>Pedido</th>
					</tr>';	
		
		
		
		
		$base_existencias=mysqli_query($conn,"SELECT * FROM sel_colors WHERE idran_salida ='$slda' and linea = '$lin_sol' and modelo='$modelo_solic' ORDER BY modelo ASC" );
		
		
	
		$basexist=mysqli_fetch_array($base_existencias);
		
		
		$solicitar_modelo = $basexist['modelo'];
		$solicitar_idran = $basexist['idran_inventario'];
		$solicitar_tipodeproducto = $basexist['tipo_producto'];
		$solicitar_linea = $basexist['linea'];
		$solicitar_colores = $basexist['color'];
//echo 'Modelo: '.$solicitar_modelo.'<br />';
		
		  $result_maximos = mysqli_query($conn, "SELECT idran_salida,linea,cantidad,MAX(cantidad) AS maximocant FROM sel_colors WHERE idran_salida = '$slda' and linea = '$solicitar_linea' GROUP BY cantidad");
		$row_max = mysqli_fetch_array($result_maximos);
			
			
        $most_high =  $row_max['maximocant'];         
           
//echo 'Mayor:'. $most_high.'<br />';
		
		
		$solicitud_existencias = mysqli_query ($conn,"SELECT id,modelo,linea,color,idran_inventario,cantidad,SUM(cantidad) AS mtotal FROM sel_colors WHERE idran_salida = '$slda' and modelo = '$solicitar_modelo' and idran_inventario = '$solicitar_idran' and linea = '$solicitar_linea' ORDER BY color DESC");
		
	$solex=mysqli_fetch_array($solicitud_existencias, MYSQLI_ASSOC);
			
		$pasar_modelo = $solex['modelo'];
		$total_producto = $solex['mtotal'];
		$cienporciento = $solex['mtotal'];
		$color = $solex['color'];
		$numeros_cant = $solex['cantidad'];
		
		

//echo 'Existencias totales de modelo: '.$total_producto.'<br />';	
		
		
		
		
		
	// SOLICITAR COLORES Y CANTIDADES	
		
		
		
		$num_regs = 0;
		$desgloce_existencias = mysqli_query ($conn,"SELECT id,cantidad,color,modelo,idran_inventario,linea FROM sel_colors WHERE idran_salida = '$slda' AND modelo = '$solicitar_modelo' and idran_inventario = '$solicitar_idran' and linea = '$solicitar_linea' ORDER BY color ASC");
		
		$numero_de_productos = mysqli_num_rows($desgloce_existencias);
		
	
		
//echo 'Numero máximo: '.$result['maxAmount'].'<br />';
		
		
	//BUCLE DE COLORES Y CANTIDADES	
		while($des_ex=mysqli_fetch_array($desgloce_existencias)){
			
			$num_regs ++;
			
			$cantidades = $des_ex['cantidad'];
			 $colores = $des_ex['color'];
			$ext_modelos = $des_ex['modelo'];
			$sacar_idran=$des_ex['idran_inventario'];
			

//CREAR CAJAS DE COLOR
			$cajas_color=mysqli_query($conn,"SELECT * FROM colors where nombre_col = '$colores'");
			$cacol=mysqli_fetch_array($cajas_color);
			
			
			// OBTENER PORCENTAJE DE PRODUCTOS			
$contat_porcen= (100*$cantidades) / $total_producto;					
$contft_porcen = number_format($cantidades - $contat_porcen);
			
			
$operacion = $procesar_cant*$contat_porcen/100;
		//SACAR PORCENTAJE DE LA CANTIDAD SOLICITADA	



			//MOSTRRAR TODA LA OPERACION
//-------------------------------------------------------------------------------------------------------------------------------------------------------------------------------			
		
			
			$total_valores = $total_valores + $operacion;
			
			
	
					$cuentas = $operacion;
					$input= number_format($cuentas).'<input type="hidden" min="0" max="'.$cantidades.'" class="span11 cantidad" name="cantidad[]" value="'. number_format($cuentas).'" />'; 
					
				
					
				$total_final =number_format($total_final + $cuentas);
				
			
	
			
			
		
		
		echo ' 

<tr align="center"> 
				  <td>'.$colores.'</td>
				  <td class="text-center"><div style="width:20px; height:20px; background-color:'.$cacol['color'].'">&nbsp</div></td>
				  <td style="text-align:center; class="text-center">'.$cantidades.' </td>
<td style="text-align:center; font-size:12pt; font-weight:400;">'.



$input


.'
						<input type="hidden" name="cantidad_oc[]" value="'.number_format($cuentas).'" />
					   <input type="hidden" name="idran_inventario[]" value="'.$sacar_idran.'" />
					   <input type="hidden" name="idran_salida[]" value="'.$slda.'" />
					   <input type="hidden" name="nombre_col[]" value="'.$colores.'" />
					   <input type="hidden" name="linea[]" value="'.$ln.'" />
                       <input type="hidden" name="modelo[]" value="'.$ext_modelos.'" />
					   <input type="hidden" name="id_color[]" value="'.$des_ex['id'].'" />
					   <input type="hidden" name="totales[]" value="'.$cantidades.'" />
					  



</td>
</tr>
';
			
			
		
		
			}
//FIN BLUCLE COLORES Y CANTIDADES		
		
		
}
		
// FIN OPERACION GLOBAL POR MODELO

		
	}	
	/*echo 'Total Final: '.$total_final.'<br />'; */
	?>	
					  
					  
					  
					  
	
		</table>
		
		
		
		
		
		
			<div class="form-actions">	
				
			
		
				
				
				
				
	<?php echo '	<button type="submit" name="insertar" id="insertarmas" class="btn btn-info" style="margin-top:10px;" onclick= "document.form2.action = \'procesar_salida_automatica.php?mod=agregar_mas&idran_cliente='.$cte.'&id_sucursal='.$scrsl.'&id_contacto='.$cntcto.'&idran_inventario='.$sacar_idran.'&idran_salida='.$slda.'&tipodeprod='.$tipodeprod.'&linea='.$ln.'&line='.$line.'&tipo_pedido='.$_GET['tipo_pedido'].'\'; document.form2.submit()">Agregar más productos</button> &nbsp;';
	

		
echo'<button type="submit" name="insertar" id="finalizar" class="btn btn-success" style="margin-top:10px;" onclick= "document.form2.action = \'procesar_salida_automatica.php?mod=finalizar&idran_cliente='.$cte.'&id_sucursal='.$scrsl.'&id_contacto='.$cntcto.'&idran_inventario='.$sacar_idran.'&idran_salida='.$slda.'&tipodeprod='.$tipodeprod.'&linea='.$ln.'&line='.$line.'&tipo_pedido='.$_GET['tipo_pedido'].'\'; document.form2.submit()">Finalizar</button>';	
					 ?>
					
					
					
					<button type="submit" name="insertar" id="finalizar" class="btn btn-danger" style="margin-top:10px;" onclick= "window.location.href = 'registro_salida_cliente.php?status_reg=6';">Cancelar</button>
		
		
			</div>
		
		
			</form>
		
		
		
	
		
		  </div>	

</div></div></div></div>
	<div class="row-fluid">
  <div id="footer" class="span12"> 2020 &copy; Proxess by <a href="#">Ciacomm</a> </div>
</div>

<!--end-Footer-part-->

<script src="js/excanvas.min.js"></script> 
<script src="js/jquery.min.js"></script> 
<script src="js/jquery.ui.custom.js"></script> 
<script src="js/bootstrap.min.js"></script> 
<script src="js/jquery.flot.min.js"></script> 
<script src="js/jquery.flot.resize.min.js"></script> 
<script src="js/jquery.peity.min.js"></script> 
<script src="js/fullcalendar.min.js"></script> 
<script src="js/matrix.js"></script> 
<script src="js/matrix.dashboard.js"></script> 
<script src="js/jquery.gritter.min.js"></script> 
<script src="js/matrix.interface.js"></script> 
<script src="js/matrix.chat.js"></script> 
<script src="js/jquery.validate.js"></script> 
<script src="js/matrix.form_validation.js"></script> 
<script src="js/jquery.wizard.js"></script> 
<script src="js/jquery.uniform.js"></script> 
<script src="js/select2.min.js"></script> 
<script src="js/matrix.popover.js"></script> 
<script src="js/jquery.dataTables.min.js"></script> 
<script src="js/matrix.tables.js"></script> 

<script type="text/javascript">
  // This function is called from the pop-up menus to transfer to
  // a different page. Ignore if the value returned is a null string:
  function goPage (newURL) {

      // if url is empty, skip the menu dividers and reset the menu selection to default
      if (newURL != "") {
      
          // if url is "-", it is this page -- reset the menu:
          if (newURL == "-" ) {
              resetMenu();            
          } 
          // else, send page to designated URL            
          else {  
            document.location.href = newURL;
          }
      }
  }

// resets the menu selection upon entry to this page:
function resetMenu() {
   document.gomenu.selector.selectedIndex = 2;
}
</script>
