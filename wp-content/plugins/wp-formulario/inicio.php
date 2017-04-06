<?php

$pagenum = isset( $_GET['pagenum'] ) ? absint( $_GET['pagenum'] ) : 1;
$tipo    = isset( $_GET['tipo'] ) ? $_GET['tipo'] : "";
$desde   = isset( $_GET['desde'] ) ? $_GET['desde'] : "";
$hasta   = isset( $_GET['hasta'] ) ? $_GET['hasta'] : "";

$where       = "";
$where_count = "";

if( $desde!="" && $hasta!="" )
{

	$partes_desde = explode("/",$desde);
	$partes_hasta = explode("/",$hasta);

	$new_desde = $partes_desde[2]."-".$partes_desde[0]."-".$partes_desde[1];
	$new_hasta = $partes_hasta[2]."-".$partes_hasta[0]."-".$partes_hasta[1];

	$where       = ' WHERE left(fecha,10) BETWEEN "'.$new_desde.'" AND "'.$new_hasta.'" ';
	$where_count = ' WHERE left(fecha,10) BETWEEN "'.$new_desde.'" AND "'.$new_hasta.'" ';

}

$limit = 10;
$offset = ( $pagenum - 1 ) * $limit;
$total  = $wpdb->get_var( "SELECT COUNT('id') 
		                  FROM {$wpdb->prefix}formulario $where_count" );

$num_of_pages = ceil( $total / $limit );

$entries = $wpdb->get_results( "SELECT * 
							    FROM {$wpdb->prefix}formulario
							    $where 
							    order by id desc
							    LIMIT $offset, $limit" );


$page_links = paginate_links( array(
    'base' => add_query_arg( array( 'pagenum' => '%#%' ) ),
    'format' => '',
    'prev_text' => __( '&laquo;', 'text-domain' ),
    'next_text' => __( '&raquo;', 'text-domain' ),
    'total' => $num_of_pages,
    'current' => $pagenum//,
    //'add_args' => array( 'q' => $q )
));

?>

<style>
	.subsubsub li {
		display: block !important;
	}	
</style>

<div class="wrap">

	<h1>Inscripciones a los eventos</h1>

	<div id="datepicker"></div>

	<ul class="subsubsub">
		<!--li class="all"><b>Evento actualmente activo</b> : <?php //echo $evento_nombre; ?></li-->
		<li class="all"><b>Total Inscritos</b> : <span class="count" id="publicados_count" ><?php echo $total; ?></span></li>
	</ul>				

	<div class="tablenav top">
		<br class="clear">
	</div>

	<div class="tablenav">

		<div class="alignleft actions">
			<form action="<?php echo admin_url('admin.php'); ?>" method="get" >
				<input type="hidden" name="page" value="wp-formulario/inicio.php">		    		   
			    <input type="text" size="15" name="desde" id="desde" placeholder="Fecha desde" value="<?php echo $desde;?>" >
			    <input type="text" size="15" name="hasta" id="hasta" placeholder="fecha hasta" value="<?php echo $hasta;?>" >
			    <input type="submit" class="button-secondary" value="Filtrar" >			    
			</form>		 
		</div>	

		<div class="alignleft actions">
			<form id="form_export" action="<?php echo admin_url('admin-ajax.php'); ?>" method="post" >
				<input type="hidden" name="action" value="my_action" >
				<input type="hidden" name="desde" value="<?php echo @$new_desde; ?>" >
				<input type="hidden" name="hasta" value="<?php echo @$new_hasta; ?>" >
				<input type="button" onclick="getConfirmation();" class="button-primary" value="Exportar Resultados" style="width:150px !important;" >	   
			</form>
		</div>		

	</div>

	<table class="wp-list-table widefat fixed striped posts">

		<thead>
		<tr>
			<th class="manage-column column-date">Nombre</th>	
			<th class="manage-column column-date">Email</th>	
			<th class="manage-column column-date">Fecha</th>	
		</tr>
		</thead>
		<tbody id="the-list">
		<?php if( count($entries)>0 ): ?>
		<?php foreach ($entries as $key): ?>
			<tr class="iedit author-self level-0 post-1 type-post status-publish format-standard hentry category-sin-categoria" >
				<td class="title column-title has-row-actions column-primary page-title" ><?php echo $key->nombre; ?></td>
				<td class="title column-title has-row-actions column-primary page-title" ><?php echo $key->email; ?></td>				
				<td class="title column-title has-row-actions column-primary page-title" ><?php echo $key->fecha; ?>
				</td>
			</tr>
		<?php endforeach; ?>
		<?php else: ?>
			<tr class="iedit author-self level-0 post-1 type-post status-publish format-standard hentry category-sin-categoria" >
				<td colspan="3" style="text-align: center;" class="title column-title has-row-actions column-primary page-title" >No existen datos para este evento</td>
			</tr>			
		<?php endif; ?>
		</tbody>

	</table>

	<?php  
	if ( $page_links )
	{
	    echo '<div class="tablenav"><div class="tablenav-pages" style="margin: 1em 0">' . $page_links . '</div></div>';
	}
	?>	

	<div id="ajax-response"></div>
</div>





