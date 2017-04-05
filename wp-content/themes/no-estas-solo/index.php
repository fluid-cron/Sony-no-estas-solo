<?php
/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package NoEstasSolo
 */

get_header(); ?>

<?php 
	$marcadores = get_field("locations","option"); 
	if( count($marcadores)>0 ):
	?>		
	<div class="acf-map">
	<?php
		foreach ($marcadores as $key ) {
			$titulo = $key["titulo"];
			$descripcion =  $key["descripcion"];
			$address =  $key["location"]["address"];
			$lat = $key["location"]["lat"];
			$lng = $key["location"]["lng"];	
	?>
			<div class="marker" data-lat="<?php echo $lat; ?>" data-lng="<?php echo $lng; ?>">
				<h4><?php echo $titulo; ?></h4>
				<p class="address"><?php echo $address; ?></p>
				<p><?php echo $descripcion; ?></p>
			</div>
	<?php					
		}
	?>
	</div>	
<?php		
	endif;

?>

<form method="post" id="form-codigos" >

	<input type="text" name="nombre" placeholder="Nombre*" value="" maxlength="50" >
	<input type="text" name="email" placeholder="Correo*" value="" maxlength="50" >
	<input type="text" name="codigo" placeholder="Código*" value="" maxlength="30" >

	<input type="hidden" name="action" value="revisarCodigos" >

</form>

<button id="btn-revisar" >Revisar</button>

<footer>
	<?php
		$facebook = get_field("facebook","option");
		$twitter = get_field("twitter","option");
		$youtube = get_field("youtube","option");
		$instagram = get_field("instagram","option");
	?>
</footer>

<?php
get_footer();
