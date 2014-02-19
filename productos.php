<?php 
session_start();
if(!empty($_SESSION["usuarioReal"]))
{
	$_SESSION["usuario"] = $_SESSION["usuarioReal"];
	unset($_SESSION["usuarioReal"]);
}
if($_GET["form_name"] <> "lista")
{
	unset($_SESSION["search"]);
}
$session = $_SESSION;
unset($_SESSION["error"]);
unset($_SESSION["buscarTienda"]);
session_write_close();
if(!$session["autenticado"])
{
	#header("location: accesar");
	?>
	<script>
		window.open('/i/accesar','_self');
	</script>
	<?php
}
?>

<?php 
require_once('phpfn/cndb.php');
$con = conection();
$query = $con->prepare('SELECT * FROM `usuario` where idusuario = ?');
$query->bindValue(1,$session["usuario"], PDO::PARAM_INT);
$query->execute();
$usuario = $query->fetch(PDO::FETCH_OBJ);
if($usuario->idtipousuario == 1)
{
    ?>
	<script>
		window.open('/i/home','_self');
	</script>
	<?php
}
if($usuario->idtipousuario == 3  and empty($_GET["id"]))
{
	header("location: http://tumall.do/i/administracion/solicitudes");
}
require_once('templates/headOthers.php');
//print_r($_GET);

$URL = "$_SERVER[REQUEST_URI]";

?>
				
	<div class="backendWrapper group">
		<div class="backendButtonsPane">
            <div class="profilePicWrapper">
				<div class="userProfilePic transTw">
					<img src="
					<?php
					if(empty($usuario->imagen))
					{
						?>
						/i/images/resources/storePNG-100.png
						<?php
					}
					else
					{
						?>
						/i/images/profile/cr/<?php echo $usuario->imagen ?>
						<?php	
					}
					
					?>
					
					
					"/>
				</div>
				<span>Hey, <?php echo $usuario->nombre; ?>!</span>
			</div>       		

			<a href="/i/productos/nuevo" class="settMenuItm addItm <?php if(strpos($URL, '/i/productos/nuevo') === 0){ echo 'active'; } ?>">Publicar</a>
            <a href="/i/productos/lista" class="settMenuItm itmLst <?php if(strpos($URL, '/i/productos/lista') === 0 || strpos($URL, '/i/productos.php?page') === 0){ echo 'active'; } ?>">Inventario</a>
            <a href="/i/publicidad" class="settMenuItm usrAdvert <?php if(strpos($URL, '/i/publicidad') === 0 || strpos($URL, '/i/solicitud') === 0){ echo 'active'; } ?>">Publicidad</a>
            <a href="/i/tutienda/editar" class="settMenuItm usrStore <?php if(strpos($URL, '/i/tutienda/editar') === 0){ echo 'active'; } ?>">Editar Tienda</a>
            <a href="/i/opciones" class="settMenuItm usrPrefs <?php if(strpos($URL, '/i/opciones') === 0){ echo 'active'; } ?>">Ajustes</a>
            
		</div>

		
		<div class="rightPane">	
			<?php 
			if(empty($_GET["form_name"]))
			{
				require_once('p/lista_producto1.php');
			}
			else if($_GET["form_name"] == "nuevo")
			{
				require_once('p/ingresar_producto1.php');
			}
            else if($_GET["form_name"] == "lista" and empty($_GET["prod_id"]))
			{
				require_once('p/lista_producto1.php');
			}
			else if($_GET["form_name"] == "lista" and !empty($_GET["prod_id"]))
			{
				require_once('p/modificar_producto.php');
			}
			else if($_GET["form_name"] == "editar")
			{
				require_once('p/modificar_tienda.php');
			}
			else if($_GET["form_name"] == "opciones")
			{
				require_once('p/opciones.php');
			}
			else if($_GET["form_name"] == "publicidad")
			{
				require_once('p/publicidad.php');
			}
			else if($_GET["form_name"] == "solicitud")
			{
				require_once('p/solicitud.php');
			}
			else if($_GET["form_name"] == "cupones")
			{
				require_once('p/cupon_tienda.php');
			}
			else if($_GET["form_name"] == "cuponesnuevo")
			{
				require_once('p/cupon_add.php');
			}
			else if($_GET["form_name"] == "reservas")
			{
				require_once('p/cupon_lista.php');
			}
			?>
		</div>
		
	</div>

<?php 
require_once('templates/foo.php');
?>