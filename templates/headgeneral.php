<!DOCTYPE html>

<?php 
require_once ('phpfn/cndb.php');
require_once ('phpfn/stringmanager.php');
$con = conection();
$sM = new stringManager();
?>

<html lang="es"> 
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<meta http-equiv="X-UA-Compatible" content="IE=edge" />

<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />

<meta name="HandheldFriendly" content="true" />

<title>Tu Mall</title>

<link rel="shortcut icon" href="/i/favicon.png" />

<link rel="stylesheet" href="/i/style/style-main.css" type="text/css"/>
<link rel="stylesheet" href="/i/style/style-general.css" type="text/css"/>
<link rel="stylesheet" href="/i/style/FontAwesome/css/font-awesome.css" type="text/css"/>
<link href='http://fonts.googleapis.com/css?family=Open+Sans:400,300,600' rel='stylesheet' type='text/css'/>

<!--[if IE 7]><html class="ie ie7 lteie8 lteie9"><![endif]-->
<!--[if IE 8]><html class="ie ie8 lteie8 lteie9"><![endif]-->
<!--[if lte IE 9]><html class="ie ie9 lteie9"><![endif]-->
<!--[if IE 9]><html class="ie ie9"><![endif]-->

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
					<h1 class="mainLogo">
						<a href="/i/home" >
							Tu Mall
							<img src="/i/images/logo-min-NS.png" alt="Logo TuMall" class="replace2X" />
						</a>
					</h1>
					
				</div>
				
				<div class="menuTopRight">
					<form id="searchForm" action="#">
						<div class="styledSelect searchTypeSelect">
							<span class="selectText"></span>
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
									<option value="<?php echo $link ?>-<?php echo $c1->idcategoria1 ?>" <?php echo $c1->idcategoria1 == $_GET["categoria1"] ? "selected" : "" ?>><?php echo $c1->descripcion ?></option>
									<?php
								}
								?>
							</select>
						</div>					
						<div class="srchBxWrap">
							<input class="genSrchTxt transTw" type="text" placeholder="Buscar" value="<?php echo !empty($_GET["buscar"]) ? $_GET["buscar"] : ""; ?>"/>
							<!-- <button class="btnSrch"><i class="fa fa-search"></i></button> -->
						</div>
						<button class="btn-search"><i class="fa fa-search"></i></button>
					</form>
					<script>
					
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
					
					<div class="menuWrap">
						<?php 
						if($usuario->idtipousuario == 3)
						{
							?>
							<a class="hdLinks" href="/i/administracion/usuarios">Administrar</a>
							<?php
						}
						else if($usuario->idtipousuario == 2)
						{
							?>
							<a class="hdLinks" href="<?php 
	                                        echo $session["autenticado"] ? "/i/productos/lista/" : "/i/accesar";
	                                        ?>">Mi cuenta</a>
							<a class="hdLinks" href="
	                                           <?php echo $session["autenticado"] ? "/i/productos/nuevo/" : "/i/accesar";
	                                        ?>">Publicar</a>
							<?php
						}
						else if($usuario->idtipousuario == 1)
						{
							?>
							<a class="hdLinks" href="/i/cliente/fav">Mi cuenta</a>
							<?php
						}
						else
							{
								?>
								<a class="hdLinks loginBtn" href="<?php 
		                                        echo $session["autenticado"] ? "/i/productos/lista/" : "/i/accesar";
		                                        ?>">Login/Registro</a>
								
								<?php
							}
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

		<div id="body" class="group">
			