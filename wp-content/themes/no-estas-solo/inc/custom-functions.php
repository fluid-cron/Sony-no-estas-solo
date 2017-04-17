<?php
add_action( 'wp_ajax_revisarCodigos', 'revisarCodigos' );
add_action( 'wp_ajax_nopriv_revisarCodigos', 'revisarCodigos' );

function revisarCodigos() {

	global $wpdb;

	$nombre   = sanitize_text_field($_POST["nombre"]);
	$email    = sanitize_text_field($_POST["email"]);
	$codigo   = sanitize_text_field($_POST["codigo"]);
	$apellido = sanitize_text_field($_POST["apellido"]);
	$rut      = sanitize_text_field($_POST["rut"]);
	$telefono = sanitize_text_field($_POST["telefono"]);

	if( $nombre!="" && $email!="" && $codigo!="" && $apellido!="" && $rut!="" && $telefono!="" ) {

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
				$codigos_cantidad = 0;

				$query = "SELECT codigo FROM {$wpdb->prefix}formulario WHERE codigo='$codigo' AND email='$email' ";
				$codigos = $wpdb->get_results($query);

				$codigos_cantidad = count($codigos);	

				if( $codigos_cantidad>0 ) {
					echo 2;
				}else{

					$codigos_cantidad = 0;			

					$codigo_repetido = $codigo."-".$email;

					$query = "SELECT codigo FROM {$wpdb->prefix}formulario WHERE codigo='$codigo_repetido' ";
					$codigos = $wpdb->get_results($query);

					$codigos_cantidad = count($codigos);

					if( $codigos_cantidad>0 ) {
						echo 2;
					}else{

						$wpdb->insert(
							$wpdb->prefix.'formulario',
							array(
								'nombre'   => $nombre,				
								'email'    => $email,				
								'codigo'   => $codigo_repetido,
								'apellido' => $apellido,
								'rut'      => $rut,
								'telefono' => $telefono
							),
							array(
								'%s',
								'%s',
								'%s',
								'%s',
								'%s',
								'%s'
							)
						);	

						echo 1;

					}	
				}		

			}else{

				//FUIRY5XA
				//WV1YAR5D
				//GS2P3UCD

				//codigo no utilizado lo ingresamos en el sistema
				$wpdb->insert(
					$wpdb->prefix.'formulario',
					array(
						'nombre'   => $nombre,				
						'email'    => $email,				
						'codigo'   => $codigo,
						'apellido' => $apellido,
						'rut'      => $rut,
						'telefono' => $telefono
					),
					array(
						'%s',
						'%s',
						'%s',
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

				if( $codigo=='FUIRY5XA' ||  $codigo=='WV1YAR5D' ||  $codigo=='GS2P3UCD' ) {

					//ganador
					$url = get_template_directory_uri().'/mail/';

					$body    = file_get_contents(get_template_directory_uri().'/mail/index.html');
					$body    = str_replace("[CODIGO]",$codigo,$body);
					$body    = str_replace("[NOMBRE]",ucwords($nombre)." ".ucwords($apellido),$body);
					$body    = str_replace("[URL]",$url,$body);
					$body    = str_replace("[FECHA]",date("d / m / Y"),$body);

					$headers = array('Content-Type: text/html; charset=UTF-8');

					$mailResult = false;
					$mailResult = wp_mail($email,'NO ESTAS SOLO', $body ,$headers);					

					if( $mailResult ) {
						$mailResult = "ok";
					}else{
						$mailResult = "error";
					}

					echo 4;

				}else{
					//va a sorteo					
					echo 1;
				}								

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







