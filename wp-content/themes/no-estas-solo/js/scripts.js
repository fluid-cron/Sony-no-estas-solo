var status_form = 0;
jQuery(document).ready(function(jQuery) { 

    jQuery("#form-codigos").validate({
        ignore :[],
        rules : {
          'nombre' : { required:true },
          'email'  : { required:true, email:true },
          'codigo' : { required:true }
        },     
        errorPlacement: function(error,element) {
          element.addClass('error');
        },
        unhighlight: function(element) {
          jQuery(element).removeClass("error");
        },
        submitHandler:function() {

            if( status_form==0 ) {

                status_form = 1;            
                
                jQuery.post(ajax.url,jQuery("#form-codigos").serialize(),function(data) {            

                   if( data==1 ) {
                    //1 ingresado con exito, codigo no estaba utilizado
                    jQuery("#msje-usado").hide();
                    jQuery("#msje-no-existe").hide();
                    jQuery("#msje-exito").fadeIn();
                    jQuery("#nombre,#email,#codigo").val("");
                    status_form=0;
                   }

                   if( data==2 ) {
                    //2 ya fue utilizado
                    jQuery("#msje-exito").hide();
                    jQuery("#msje-no-existe").hide();
                    jQuery("#msje-usado").fadeIn();
                    status_form=0;
                   }

                   if( data==3 ) {
                    //3 el codigo ingresado no existe
                    jQuery("#msje-exito").hide();
                    jQuery("#msje-usado").hide();
                    jQuery("#msje-no-existe").fadeIn();
                    jQuery("#codigo").val("");
                    status_form=0;
                   }

                });                

            }
            
        }

    });

    jQuery("#btn-revisar").click(function() {
    	jQuery("#form-codigos").submit();
    });

});  

var zoom = 16;

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
            url : ajax.theme_path+'img/icon-pointer-map.png',
            anchor: new google.maps.Point(0,70)
        },
        optimized   : false,
        zIndex      : 200
    });

    // add to array
    map.markers.push( marker );

    // if marker contains HTML, add it to an infoWindow
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
    $('.acf-map').each(function() {

        map = new_map( $(this) );        
        /*
        google.maps.event.addListenerOnce(map, 'bounds_changed', function(event) {
            this.setZoom(zoom);
        });        
        */

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

