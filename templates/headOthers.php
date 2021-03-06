<?php 
require_once ('phpfn/cndb.php');
require_once ('phpfn/stringmanager.php');
$con = conection();
$sM = new stringManager();
?>
<!DOCTYPE html>
<html lang="es">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<meta http-equiv="X-UA-Compatible" content="IE=edge" />

<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />

<meta name="HandheldFriendly" content="true" />

<title>Tu Mall</title>

<link rel="shortcut icon" href="/i/favicon.png" />

<link rel="stylesheet" href="/i/style/style-main.css" type="text/css"/>
<link rel="stylesheet" href="/i/style/style-settings.css" type="text/css"/>
<link rel="stylesheet" href="/i/style/FontAwesome/css/font-awesome.css" type="text/css"/>
<link href='http://fonts.googleapis.com/css?family=Open+Sans:400,300,600' rel='stylesheet' type='text/css'/>

<script type='text/javascript' src='/i/Scripts/jquery-1.10.2.js'></script>

<script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-45873793-1', 'tumall.do');
  ga('send', 'pageview');

</script>

</head>
<body>
	<div id="container">
		<div id="header">
			<div class="quickLinksWrap">
				<a class="quickLink" href="http://tumall.do/i/novedades">Novedades</a>
				<a class="quickLink" href="http://tumall.do/i/contacto">Contactos</a>
				<a class="quickLink" href="http://tumall.do/i/FAQ">Ayuda</a>
				<a class="quickLink" href="http://tumall.do/i/tiendas">Lista de tiendas</a>
			</div>
			<div class="headerCenter transTw">
				
				<span class="mobSearchBtn"></span>
				<div class="logoWrap">
					<a href="/i/home" class="mainLogo"><img src="/i/images/logo-min-NS.png" alt="Logo TuMall" class="replace2X" /></a>				
				</div>
				<div class="menuTopRight">
					<form id="searchForm" action="#">
						<div class="styledSelect searchTypeSelect">
							<select class="selectCategory normalSelect">
								<option value="">Todas</option>
								<?php 
								$query = $con->prepare("SELECT * FROM `categoria1` order by descripcion");
								$query->execute();
				        		$categoria1 = $query->fetchAll(PDO::FETCH_OBJ);
								foreach($categoria1 as $c1)
								{
									$link = $sM->remove_accents($c1->descripcion);
									$link = str_replace("-", " ", $link);
									$link = preg_replace('/\s\s+/', ' ', $link);
									$link = str_replace(" ", "-", $link);
									$link = strtolower($link);
									$link = preg_replace('/[^A-Za-z0-9\-]/', '', $link);
									?>
									<option value="<?php echo $link ?>-<?php echo $c1->idcategoria1 ?>"><?php echo $c1->descripcion ?></option>
									<?php
								}
								?>
							</select>
						</div>						
						<div class="srchBxWrap">
							<input class="genSrchTxt transTw" type="text" placeholder="Buscar"/>
							<!-- <button class="btnSrch"><i class="fa fa-search"></i></button> -->
						</div>
						<button class="btn-search"><i class="fa fa-search"></i></button>

					</form>
					<script>
					/*
					$('.genSrchTxt').keyup(function(){
						var sear = $(this).val();
						$.ajax({
								type : "POST",
								url  : "/i/phpfn/busqueda.php",
								data : {buscarLista : sear}
						})
					})*/
					
					$('#searchForm').submit(function( event )
						{
							var sear = $(this).children('.srchBxWrap').children('.genSrchTxt').val();
							var sel = $('.selectCategory').val();
							var url = '/i/lista/';
							if(sel)
							{
								url = url + 'categoria/' + sel + '/';
							}
							if(sear)
							{
								url = url + 'buscar/' + sear + '/';
							}
							$(this).attr("action", url);
						}
					);
				</script>
					
					<?php

					$URL = "$_SERVER[REQUEST_URI]";
					
					?>

					<div class="backendButtonsPane">  
					<?php
					
					if($usuario->idtipousuario == 2){
					
					?>
					             
						<a href="/i/productos/nuevo" class="settMenuItm addItm <?php if(strpos($URL, '/i/productos/nuevo') === 0){ echo 'active'; } ?>">Publicar</a>
			            <a href="/i/productos/lista" class="settMenuItm itmLst <?php if(strpos($URL, '/i/productos/lista') === 0){ echo 'active'; } ?>">Inventario</a>
			            <a href="/i/tutienda/editar" class="settMenuItm usrStore <?php if(strpos($URL, '/i/tutienda/editar') === 0){ echo 'active'; } ?>">Editar Tienda</a>
			            <a href="/i/publicidad" class="settMenuItm usrAdvert <?php if(strpos($URL, '/i/publicidad') === 0 || strpos($URL, '/i/solicitud') === 0){ echo 'active'; } ?>">Publicidad</a>
			            <a href="/i/opciones" class="settMenuItm usrPrefs <?php if(strpos($URL, '/i/opciones') === 0){ echo 'active'; } ?>">Ajustes</a>
			            
			        <?php
			        
			        }
			        
			        else if($usuario->idtipousuario == 1){
				
			        ?>    
			         
			        <a href="/i/cliente/fav" class="settMenuItm usrFavs <?php if(strpos($URL, '/i/cliente/fav') === 0){ echo 'active'; } ?>">Favoritos y Wishlist</a>
					<a href="/i/cliente/tienda" class="settMenuItm usrStore <?php if(strpos($URL, '/i/cliente/tienda') === 0){ echo 'active'; } ?>">Vender</a>
					<a href="/i/cliente/ajustes" class="settMenuItm usrPrefs <?php if(strpos($URL, '/i/cliente/ajustes') === 0){ echo 'active'; } ?>">Ajustes</a> 
			            
					<?php
					
					}
					
					?>
				
					</div>
					
					
					<div class="menuWrap">
						<?php 

	                    if($session["autenticado"])
						{
							?>
							<a class="hdLinks logoutBtn" href="/i/phpfn/salir">Salir</a>
							<?php
						}
	                    ?>
					</div>
				</div>
				
			</div>
		</div> <!-- close header -->

		<div id="body" class="group others">
