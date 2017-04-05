<?php
add_action( 'wp_ajax_revisarCodigos', 'revisarCodigos' );
add_action( 'wp_ajax_nopriv_revisarCodigos', 'revisarCodigos' );

function revisarCodigos() {

	global $wpdb;

	$nombre = sanitize_text_field($_POST["nombre"]);
	$email  = sanitize_text_field($_POST["email"]);
	$codigo = sanitize_text_field($_POST["codigo"]);

	if( $nombre!="" && $email!="" && $codigo!="" ) {

		$query = "SELECT codigo FROM {$wpdb->prefix}codigos WHERE codigo='$codigo' ";
		$codigos = $wpdb->get_results($query);

		$codigos_cantidad = count($codigos);

		if( $codigos_cantidad>0 ) {

			//existe el codigo en la base inicial

			$codigos_cantidad = 0;	

			//ahora buscamos si ya a sido utilizado
			$query = "SELECT codigo FROM {$wpdb->prefix}codigos_utilizados WHERE codigo='$codigo' ";
			$codigos = $wpdb->get_results($query);

			$codigos_cantidad = count($codigos);

			if( $codigos_cantidad>0 ) {
				//codigo ingresado ya fue utilizado
				echo 2;
			}else{

				//codigo no utilizado lo ingresamos en el sistema
				$wpdb->insert(
					$wpdb->prefix.'formulario',
					array(
						'nombre' => $nombre,				
						'email'  => $email,				
						'codigo' => $codigo	
					),
					array(
						'%s',
						'%s',
						'%s'
					)
				);	

				$wpdb->insert(
					$wpdb->prefix.'codigos_utilizados',
					array(
						'codigo' => $codigo,
						'email'  => $email
					),
					array(
						'%s',
						'%s'
					)
				);	

				echo 1;			
			}
			

		}else{
			//el codigo ingresado no existe
			echo 3;	
		}
	}

	die;

}

//admin
function my_acf_init() {
	acf_update_setting('google_api_key', 'AIzaSyAJschzOs369jwFPTI5npQl27iqyIBm3UU');
}
add_action('acf/init', 'my_acf_init');







