<?php 
session_start();
$session = $_SESSION;
unset($_SESSION["error"]);
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
if($usuario->idtipousuario <> 1)
{
    ?>
	<script>
		window.open('/i/home','_self');
	</script>
	<?php
}
require_once('templates/headOthers.php');
//print_r($_GET);

$URL = "$_SERVER[REQUEST_URI]";

?>
				
	<div class="backendWrapper group">
		<div class="backendButtonsPane">
            <div class="profilePicWrapper">
				<div class="userProfilePic">
					<img src="/i/images/resources/userPNG-100.png" />
				</div>
				<span>Hey, <?php echo $usuario->nombre; ?>!</span>
			</div>                
			
			<a href="/i/cliente/fav" class="settMenuItm usrFavs <?php if(strpos($URL, '/i/cliente/fav') === 0){ echo 'active'; } ?>">Favoritos y Wishlist</a>
			<a href="/i/cliente/tienda" class="settMenuItm usrStore <?php if(strpos($URL, '/i/cliente/tienda') === 0){ echo 'active'; } ?>">Vender</a>
			<a href="/i/cliente/ajustes" class="settMenuItm usrPrefs <?php if(strpos($URL, '/i/cliente/ajustes') === 0){ echo 'active'; } ?>">Ajustes</a>
		</div>
		<div class="rightPane">	
			<?php 
			
			if($_GET["form_name"] == 'ajustes')
			{
				require_once('cliente/ajustes.php');
			}
			else if($_GET["form_name"] == 'fav' and $_GET["form2"] == 'productos')
			{
				require_once('cliente/fav.php');
			}
			else if($_GET["form_name"] == 'fav' and $_GET["form2"] == 'tiendas')
			{
				require_once('cliente/tiendas.php');
			}
			else if($_GET["form_name"] == 'fav')
			{
				require_once('cliente/fav.php');
			}
			else if($_GET["form_name"] == 'tienda')
			{
				require_once('cliente/tienda.php');
			}
			else if($_GET["form_name"] == 'cupon')
			{
				require_once('cliente/cupon.php');
			}
			
			?>
		</div>
		
	</div>

<?php 
require_once('templates/fooOthers.php');
?>