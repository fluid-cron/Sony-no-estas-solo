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
<?php $marcadores = get_field("locations","option"); ?>

<header class="animated fadeIn"></header>
    
    <section class="place-section">

		<h3>#NOESTASSOLO</h3>
		<h4>SAL DE TU CASA, CORRE Y PARTICIPA</h4>
		<p>Búsca los códigos que están en los pendrives escondidos en 50 puntos distintos de la ciudad.<br> Ingrésalos acá y descubre si eres el ganador.</p>
	   
		<div class="mycontent clearfix">
		  
		    <div class="box-01 clearfix">	      
				<div class="content-info clearfix">	      
				  <div class="icono">
				  	<img src="<?php echo get_template_directory_uri(); ?>/img/icon-walk.png">
				  </div>	      
				  <div class="texto">
				      <h5>CORRE</h5>
				      <p>RECORRE LA CIUDAD BUSCANDO LAS UBICACIONES MARCADAS EN EL MAPA.</p>
				  </div>
				</div>
		  
				<div class="content-info clearfix">
					<div class="icono">
						<img src="<?php echo get_template_directory_uri(); ?>/img/icon-pendrive.png">
					</div>
					<div class="texto">  
						<h5>CONÉCTATE</h5>
						<p>DESCUBRE EL SÍMBOLO Y CONÉCTATE  PARA DESCARGAR LOS CÓDIGOS Y MÁS CONTENIDOS DE ALAN WALKER.</p>
					</div>
				</div>	  
		   </div>		   
		   <div class="box-02"></div>		   
		</div>
      
    </section>
    
    <div class="box-map">	    
	<?php	       
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
	<?php endif; ?>
    </div>
	    
    <section class="tittle-section clearfix">       
        <div class="box-logo clearfix">
            <img src="<?php echo get_template_directory_uri(); ?>/img/logo.png">
        </div>        
        <div class="bg-title">
            <h4>INGRESA TU <span>CÓDIGO</span></h4>
        </div>        
    </section>
    
    <section class="mycode">

        <form method="post" id="form-codigos" class="myform clearfix">

            <div class="form-line">
	            <input type="text" name="codigo" id="codigo" placeholder="INGRESA TU CÓDIGO" maxlength="10" >
            </div>	            
            <div class="yz-row">
            	<div class="yz-col">
	            	<div class="form-line">
		            	<input type="text" name="nombre" id="nombre" placeholder="Ingresa tu nombre" maxlength="30" >
	            	</div>
            	</div>
            	<div class="yz-col">
	            	<div class="form-line">
	            		<input type="text" name="apellido" id="apellido" placeholder="Ingresa tu apellido" maxlength="30" >
	            	</div>
            	</div>
            </div>	            	            	            
            <div class="yz-row">
            	<div class="yz-col">
	            	<div class="form-line">
		            	<input type="text" name="rut" id="rut" placeholder="Ingresa tu RUT" maxlength="12" >
	            	</div>
            	</div>
            	<div class="yz-col">
            		<div class="form-line">
            			<input type="email" name="email" id="email" placeholder="Ingresa tu correo" maxlength="30" >
            		</div>
            	</div>	            	
            </div>
            <div class="yz-row">
            	<div class="yz-col">
	            	<div class="form-line">
		            	<input type="text" name="telefono" id="telefono" placeholder="Ingresa tu teléfono" maxlength="12" >
	            	</div>
            	</div>
            	<div class="yz-col">
            		<div class="form-line">
            			<!--input id="boton-revisar" type="submit" value="Revisar"-->
            			<input id="boton-revisar" type="button" value="Revisar" >
            		</div>
            	</div>	            
            </div>

            <!--div class="box-date-forms clearfix">
               <label for="name" class="help-block date-name">INGRESA TU NOMBRE</label>
               <input type="text" class="form-control input-form" name="nombre" id="nombre" aria-describedby="inputSuccess2Status" maxlength="50" >
            </div> 
            <div class="box-date-forms clearfix">
               <label for="name" class="help-block date-name">INGRESA TU APELLIDO</label>
               <input type="text" class="form-control input-form" name="apellido" id="apellido" aria-describedby="inputSuccess2Status" maxlength="50" >
            </div>                                
            <div class="box-date-forms clearfix">
               <label for="name" class="help-block date-name">INGRESA TU RUT</label>
               <input type="text" class="form-control input-form" name="rut" id="rut" aria-describedby="inputSuccess2Status" maxlength="12" >
            </div>             
            <div class="box-date-forms clearfix">
               <label for="name" class="help-block date-name">INGRESA TU TELÉFONO</label>
               <input type="text" class="form-control input-form" name="telefono" id="telefono" aria-describedby="inputSuccess2Status" maxlength="50" >
            </div>             
            <div class="box-date-forms clearfix">
               <label for="email" class="help-block date-name">INGRESA TU CORREO</label>
               <input type="text" class="form-control input-form" name="email" id="email" maxlength="50" >
            </div>                   
            <div class="box-date-forms clearfix">
              <label for="password" class="help-block date-name">INGRESA TU CÓDIGO</label>
              <input type="text" class="form-control input-form" name="codigo" id="codigo" maxlength="50" >
            </div>
			<div class="box-date-forms clearfix">            
				<input type="button" class="form-control enviar-btn" value="Enviar" id="btn-revisar" >
			</div>
            <div class="box-date-forms clearfix">            
				<div class="alert alert-info alert-custom" id="msje-exito">
				  El <strong>Código</strong> fue ingresado con éxito.
				</div>	   
				<div class="alert alert-danger alert-custom" id="msje-usado">
				  El <strong>Código</strong> ingresado ya fue utilizado.
				</div>	
				<div class="alert alert-danger alert-custom" id="msje-no-existe">
				  El <strong>Código</strong> ingresado no existe.
				</div>										           
            </div--> 

			<div class="yz-row">
				<div class="yz-col">
			    	<div class="form-line">
						<div class="alert alert-danger alert-custom" id="msje-usado">
						  El <strong>Código</strong> ingresado ya fue utilizado.
						</div>				    	
						<div class="alert alert-danger alert-custom" id="msje-no-existe">
						  El <strong>Código</strong> ingresado no existe.
						</div>			        	
			    	</div>
				</div>				            
			</div>            		

            <input type="hidden" name="action" value="revisarCodigos" >     
           </form>               
    </section>

    <section class="a-footer clearfix">
       <div class="mycontent clearfix">
			<div class="box-01 clearfix">
				<a href="<?php echo get_template_directory_uri(); ?>/bases.pdf" target="_blank" >VER BASES DEL CONCURSO</a>
				<?php 
					$link_ganadores = get_field("ocultar_link_ganadores","option"); 

					if( !$link_ganadores ):
				?>
				<a href="javascript:void(0);" id="ganadores" >VER GANADORES</a>
				<?php endif; ?>
			</div>
			<div class="box-02"></div>
        </div>
    </section>

    <?php
		$args = array(
			'post_type' => 'ganadores'
		);
		$the_query = new WP_Query( $args );

		if( $the_query->have_posts() ):
			while( $the_query->have_posts() ) : $the_query->the_post();
	?>
			<div style="display: none;">
				<div class="container white-popup-block" id="popupinfo" >
					<div class="col-md-12">
						<div class="row">
							<p>
							<?php 
								echo get_the_title();
								echo get_field("premio");
								echo get_field("imagen"); 
							?>
							</p>
						</div>
					</div>
				</div>
			</div>
	<?php
			endwhile;
		endif;
    ?>

	<div class="overlay"></div>

	<!-- Modal mayor de edad -->
	<div class="yzmodal" id="mayor-de-edad">
		<img src="<?php echo get_template_directory_uri(); ?>/img/logo-small.png">
		<div class="fecha-validacion">
			<img src="<?php echo get_template_directory_uri(); ?>/img/fecha-incorrecta.png"> <!-- Imagen se muestra si añades clase .invalid a .fecha-validacion -->
		<h1>¿Eres mayor de edad?</h1>
		<p>Ingresa tu fecha de nacimiento</p>
		</div>
		<form id="fecha-nacimiento">
		<div class="fecha-nacimiento-input">
			<input type="text" name="day" id="day" placeholder="00" maxlength="2">
			<input type="text" name="month" id="month" placeholder="00" maxlength="2">
			<input type="text" name="year" id="year" placeholder="0000" maxlength="4">
		</div>
		<input class="redbutton" id="btn-fecha" type="button" value="Entrar">
		</form>
	</div>  

	<!-- Modal sigue participando -->
	<div class="yzmodal" id="sigue-participando">
		<img src="<?php echo get_template_directory_uri(); ?>/img/logo-small.png">
		<span class="codigo"></span>
		<img src="<?php echo get_template_directory_uri(); ?>/img/codigo-sin-premio.png"> 
		<h2>Ya estás participando</h2>
		<p>TU CÓDIGO HA SIDO INGRESADO AL SORTEO DE
	MATERIAL EXCLUSIVO Y ENTRADAS DOBLES + MEET&GREET  
	PARA EL SHOW DE <b>ALAN WALKER</b> EN ANDES FESTIVAL 2017. </p>
		
		<a class="blackbutton" href="<?php echo get_template_directory_uri(); ?>/bases.pdf" target="_blank" >Ver bases</a>
	</div>

	<!-- Modal ganador -->
	<div class="yzmodal" id="ganador">
		<img src="<?php echo get_template_directory_uri(); ?>/img/logo-small.png">
		<span class="codigo">*********3JKV</span>
		<h2>¡Felicitaciones!</h2>
		<p>Has ganado una entrada doble + Meet&Greet para el show de <b>Alan Walker</b> en Andes Festival 2017.</p>
		
		<div class="correo-enviado">
			<div>
				<img src="<?php echo get_template_directory_uri(); ?>/img/icon-email.png">
			</div>
			<p>Hemos enviado un correo de confirmación a la dirección de correo ingresada, con indicacones para hacer entrega de tu premio.</p>
		</div>
		
		<a class="blackbutton" href="<?php echo get_template_directory_uri(); ?>/bases.pdf" target="_blank" >Ver bases</a>
	</div>	

<?php
get_footer();
