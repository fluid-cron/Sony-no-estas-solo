<?php
/**
* Plugin Name: Formulario
* Plugin URI: http://www.cronstudio.com
* Description: Mostrar/Exportar datos
* Version: 1.0 
* Author: Manuel Meriño
*/

function register_form()
{
	add_menu_page( 'Formulario', 'Formulario', 'manage_options', 'wp-formulario/inicio.php', '', 'dashicons-media-text', 27 );
}
add_action( 'admin_menu', 'register_form' );

add_action( 'admin_enqueue_scripts', 'my_plugin_admin_init' );
function my_plugin_admin_init() {
  
   wp_register_script('script-form', plugins_url( '/js/script.js', __FILE__ ) , array( 'jquery' ) );
   wp_enqueue_script('script-form' );  

   wp_register_script('jquery-ui', plugins_url( '/js/jquery-ui.js', __FILE__ ) );
   wp_enqueue_script('jquery-ui' );     

   wp_register_style( 'jquery-ui-css', plugins_url('css/jquery-ui.css', __FILE__) );
   wp_enqueue_style( 'jquery-ui-css' ); 

   wp_register_style( 'myPluginStylesheet', plugins_url('css/stylesheet.css', __FILE__) );
   wp_enqueue_style( 'myPluginStylesheet' ); 

}

function export() {

	require_once dirname(__FILE__) . '/libraries/PHPExcel-1.8/Classes/PHPExcel.php';

	global $wpdb;

	$desde   = isset( $_POST['desde'] ) ? $_POST['desde'] : "";
	$hasta   = isset( $_POST['hasta'] ) ? $_POST['hasta'] : "";

	$where = "";
	if( $desde!="" && $hasta!="" )
	{
		$where = ' WHERE left(fecha,10) BETWEEN "'.$desde.'" AND "'.$hasta.'" ';
	}	

	$entries = $wpdb->get_results( "SELECT * 
								    FROM {$wpdb->prefix}formulario
								    $where 
								    order by id desc" );

	$objPHPExcel = new PHPExcel();
	$objPHPExcel->getProperties()->setCreator("Sony");					

	$objPHPExcel->setActiveSheetIndex(0);

	$objPHPExcel->getActiveSheet()->setCellValue('A1', 'ID');
	$objPHPExcel->getActiveSheet()->setCellValue('B1', 'Nombre');
	$objPHPExcel->getActiveSheet()->setCellValue('C1', 'Apellido');
	$objPHPExcel->getActiveSheet()->setCellValue('D1', 'Email');
	$objPHPExcel->getActiveSheet()->setCellValue('E1', 'Código');
	$objPHPExcel->getActiveSheet()->setCellValue('F1', 'Rut');
	$objPHPExcel->getActiveSheet()->setCellValue('G1', 'Teléfono');
	$objPHPExcel->getActiveSheet()->setCellValue('H1', 'Fecha');

	$row = 2;
	foreach($entries as $key) {
		
		$col = 0;
		
		$id = $key->id;
		$nombre = $key->nombre;
		$apellido = $key->apellido;
		$email = $key->email;
		$codigo = $key->codigo;
		$rut = $key->rut;
		$telefono = $key->telefono;
		$fecha = $key->fecha;

		$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, $id);
		$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col+=1, $row, $nombre);
		$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col+=1, $row, $apellido);
		$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col+=1, $row, $email);
		$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col+=1, $row, $codigo);
		$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col+=1, $row, $rut);
		$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col+=1, $row, $telefono);
		$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col+=1, $row, $fecha);

		$row++;

	}	

	$objPHPExcel->getActiveSheet()->setTitle('Hoja 1');	
	$objPHPExcel->setActiveSheetIndex(0);	

	// Redirect output to a client’s web browser (Excel5)
	header('Content-Type: application/vnd.ms-excel');
	header('Content-Disposition: attachment;filename="formulario.xls"');
	header('Cache-Control: max-age=0');
	// If you're serving to IE 9, then the following may be needed
	header('Cache-Control: max-age=1');
	// If you're serving to IE over SSL, then the following may be needed
	header ('Expires: Mon, 26 Jul 1997 05:00:00 GMT'); // Date in the past
	header ('Last-Modified: '.gmdate('D, d M Y H:i:s').' GMT'); // always modified
	header ('Cache-Control: cache, must-revalidate'); // HTTP/1.1
	header ('Pragma: public'); // HTTP/1.0
	$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
	$objWriter->save('php://output');

	
	wp_die();
	die;
}

add_action( 'wp_ajax_my_action', 'export' );

