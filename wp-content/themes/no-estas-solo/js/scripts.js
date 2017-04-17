var status_form = 0;
var s = 0;
jQuery(document).ready(function(jQuery) {

    //$('#mayor-de-edad,.overlay').addClass('active');

    $('.overlay').click(function(event) {      
      if(s==1) {
        $('.yzmodal,.overlay').removeClass('active');
      }
    })

    $('#btn-fecha').click(function(event) { 
      
      var day = $("#day").val();
      var month = $("#month").val();
      var year = $("#year").val();

      if( (day>=1 && day<=31 ) && (month>=1 && month<=12) && (year>=1917 && year<=1999 && year!=0) ) {
        $('.fecha-validacion').removeClass('invalid');
        $('#mayor-de-edad,.overlay').removeClass('active');
        s = 1;
      }else{        
        $('.fecha-validacion').addClass('invalid');
      }

    })    

    jQuery.validator.addMethod("rut", function(value, element) {
      return this.optional(element) || jQuery.Rut.validar(value);
    });

    jQuery('#rut').Rut({
      format_on: 'keyup'
    });      

    jQuery("#form-codigos").validate({
        ignore :[],
        rules : {
          'nombre'   : { required:true },
          'email'    : { required:true, email:true },
          'codigo'   : { required:true },
          'apellido' : { required:true },
          'rut'      : { required:true, rut:true },
          'telefono' : { required:true }
        },
        errorPlacement: function(error,element) {
          element.addClass('error');
        },
        unhighlight: function(element) {
          jQuery(element).removeClass("error");
        },
        submitHandler:function() {

            if( status_form==0 ) {

                $("#boton-revisar").hide();

                status_form = 1;            
                
                jQuery.post(ajax.url,jQuery("#form-codigos").serialize(),function(data) {

                   if( data==1 ) {
                    $("#boton-revisar").show();
                    $('#sigue-participando,.overlay').addClass('active');
                    //1 ingresado con exito, codigo no estaba utilizado participando!!!
                    jQuery("#msje-usado").hide();
                    jQuery("#msje-no-existe").hide();
                    jQuery("#msje-exito").fadeIn();
                    jQuery("#nombre,#email,#codigo,#apellido,#rut,#telefono").val("");
                    status_form=0;
                   }

                   if( data==2 ) {
                    $("#boton-revisar").show();
                    //2 ya fue utilizado
                    jQuery("#msje-exito").hide();
                    jQuery("#msje-no-existe").hide();
                    jQuery("#msje-usado").fadeIn();
                    jQuery("#codigo").val("");
                    status_form=0;
                   }

                   if( data==3 ) {
                    $("#boton-revisar").show();
                    //3 el codigo ingresado no existe
                    jQuery("#msje-exito").hide();
                    jQuery("#msje-usado").hide();
                    jQuery("#msje-no-existe").fadeIn();
                    jQuery("#codigo").val("");
                    status_form=0;
                   }

                   if( data==4 ) {
                    $("#boton-revisar").show();
                    $('#ganador,.overlay').addClass('active');
                    //4 ingresado con exito, codigo no estaba utilizado ganador!!!
                    jQuery("#msje-usado").hide();
                    jQuery("#msje-no-existe").hide();
                    jQuery("#msje-exito").fadeIn();
                    jQuery("#nombre,#email,#codigo,#apellido,#rut,#telefono").val("");
                    status_form=0;
                   }                   

                });                

            }
            
        }

    });

    jQuery("#boton-revisar").click(function() {
    	jQuery("#form-codigos").submit();
    });

});  

var zoom = 14;

(function($) {

function new_map( $el ) {
    
    // var
    var $markers = $el.find('.marker');
    
    // vars
    var args = {
        zoom        : zoom,
        center      : new google.maps.LatLng(0, 0),
        mapTypeId   : google.maps.MapTypeId.ROADMAP,
        scrollwheel : false,
        disableDefaultUI: true,
        zoomControl: true,
        styles: 
                [
                  {
                    "elementType": "geometry",
                    "stylers": [
                      {
                        "color": "#f5f5f5"
                      }
                    ]
                  },
                  {
                    "elementType": "labels.icon",
                    "stylers": [
                      {
                        "visibility": "off"
                      }
                    ]
                  },
                  {
                    "elementType": "labels.text.fill",
                    "stylers": [
                      {
                        "color": "#616161"
                      }
                    ]
                  },
                  {
                    "elementType": "labels.text.stroke",
                    "stylers": [
                      {
                        "color": "#f5f5f5"
                      }
                    ]
                  },
                  {
                    "featureType": "administrative",
                    "stylers": [
                      {
                        "visibility": "on"
                      }
                    ]
                  },
                  {
                    "featureType": "administrative.land_parcel",
                    "elementType": "labels.text.fill",
                    "stylers": [
                      {
                        "color": "#bdbdbd"
                      }
                    ]
                  },
                  {
                    "featureType": "poi",
                    "elementType": "geometry",
                    "stylers": [
                      {
                        "color": "#eeeeee"
                      }
                    ]
                  },
                  {
                    "featureType": "poi",
                    "elementType": "labels.icon",
                    "stylers": [
                      {
                        "saturation": -100
                      },
                      {
                        "visibility": "on"
                      }
                    ]
                  },
                  {
                    "featureType": "poi",
                    "elementType": "labels.text.fill",
                    "stylers": [
                      {
                        "color": "#757575"
                      }
                    ]
                  },
                  {
                    "featureType": "poi.park",
                    "elementType": "geometry",
                    "stylers": [
                      {
                        "color": "#e5e5e5"
                      }
                    ]
                  },
                  {
                    "featureType": "poi.park",
                    "elementType": "labels.text.fill",
                    "stylers": [
                      {
                        "color": "#9e9e9e"
                      }
                    ]
                  },
                  {
                    "featureType": "road",
                    "elementType": "geometry",
                    "stylers": [
                      {
                        "color": "#ffffff"
                      }
                    ]
                  },
                  {
                    "featureType": "road.arterial",
                    "elementType": "labels.text.fill",
                    "stylers": [
                      {
                        "color": "#757575"
                      }
                    ]
                  },
                  {
                    "featureType": "road.highway",
                    "elementType": "geometry",
                    "stylers": [
                      {
                        "color": "#dadada"
                      }
                    ]
                  },
                  {
                    "featureType": "road.highway",
                    "elementType": "labels.text.fill",
                    "stylers": [
                      {
                        "color": "#616161"
                      }
                    ]
                  },
                  {
                    "featureType": "road.local",
                    "elementType": "labels.text.fill",
                    "stylers": [
                      {
                        "color": "#9e9e9e"
                      }
                    ]
                  },
                  {
                    "featureType": "transit.line",
                    "elementType": "geometry",
                    "stylers": [
                      {
                        "color": "#e5e5e5"
                      }
                    ]
                  },
                  {
                    "featureType": "transit.station",
                    "elementType": "geometry",
                    "stylers": [
                      {
                        "color": "#eeeeee"
                      }
                    ]
                  },
                  {
                    "featureType": "water",
                    "elementType": "geometry",
                    "stylers": [
                      {
                        "color": "#c9c9c9"
                      }
                    ]
                  },
                  {
                    "featureType": "water",
                    "elementType": "labels.text.fill",
                    "stylers": [
                      {
                        "color": "#9e9e9e"
                      }
                    ]
                  }
                ]                     
    };
    
    // create map               
    var map = new google.maps.Map( $el[0], args);
    
    // add a markers reference
    map.markers = [];
    
    // add markers
    $markers.each(function(){
        add_marker( $(this), map );        
    });
    
    // center map
    center_map( map );
    
    // return
    return map;
    
}

function add_marker( $marker, map ) {

    // var
    var latlng = new google.maps.LatLng( $marker.attr('data-lat'), $marker.attr('data-lng') );

    // create marker
    var marker = new google.maps.Marker({
        position    : latlng,
        map         : map,
        animation   : google.maps.Animation.DROP,
        icon        : {
            url    : ajax.theme_path+'img/icon-pointer-map.png',
            anchor : new google.maps.Point(0,70)
        }
    });

    // add to array
    map.markers.push( marker );

    // if marker contains HTML, add it to an infoWindow
    /*
    if( $marker.html() )
    {
        // create info window
        var infowindow = new google.maps.InfoWindow({
            content : $marker.html()
        });

        // show info window when marker is clicked
        google.maps.event.addListener(marker, 'click', function() {
            infowindow.open( map, marker );
        });
    }
    */

}

function center_map( map ) {

    // vars
    var bounds = new google.maps.LatLngBounds();

    // loop through all markers and create bounds
    $.each( map.markers, function( i, marker ) {
        var latlng = new google.maps.LatLng( marker.position.lat(), marker.position.lng() );
        bounds.extend( latlng );
    });

    // only 1 marker?
    if( map.markers.length == 1 )
    {
        // set center of map
        map.setCenter( bounds.getCenter() );
        map.setZoom( zoom );
    }
    else
    {
        // fit to bounds
        map.fitBounds( bounds );
    }    

}

var map = null;

$(document).ready(function() {

    $("#nombre,#apellido").on("keydown",function( event ){
       var tecla = event.which;      
             return !( (tecla > 47 && tecla < 58) || (tecla > 95 && tecla < 106) || tecla == 46 );
    });
    $("#telefono").on("keydown",function(event){
       var tecla = event.which
       return ( (tecla > 47 && tecla < 58) || (tecla > 95 && tecla < 106) || tecla == 46 || tecla == 8 || tecla == 9 ); 
    });    

    $("#day,#month,#year").keyup(function(event) {        
        if(event.keyCode == 13){
            $("#btn-fecha").click();
        }
    });

    $('.acf-map').each(function() {

        map = new_map( $(this) );        
        
        google.maps.event.addListenerOnce(map, 'bounds_changed', function(event) {
            this.setZoom(zoom);
        });                

    });

    jQuery("#ganadores").click(function(){
      jQuery.magnificPopup.open({
          items: {
              src: '#popupinfo',
              type: 'inline'
          }
      });   
    });

});

})(jQuery);	

