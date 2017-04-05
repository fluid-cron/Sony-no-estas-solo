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
                   
                   alert(data);

                });                

            }
            
        }

    });

    jQuery("#btn-revisar").click(function() {
    	jQuery("#form-codigos").submit();
    });

});  

(function($) {

function new_map( $el ) {
    
    // var
    var $markers = $el.find('.marker');
    
    // vars
    var args = {
        zoom        : 16,
        center      : new google.maps.LatLng(0, 0),
        mapTypeId   : google.maps.MapTypeId.ROADMAP
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
        icon        : ajax.theme_path+'images/icon.png'
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
    $.each( map.markers, function( i, marker ){
        var latlng = new google.maps.LatLng( marker.position.lat(), marker.position.lng() );
        bounds.extend( latlng );
    });

    // only 1 marker?
    if( map.markers.length == 1 )
    {
        // set center of map
        map.setCenter( bounds.getCenter() );
        map.setZoom( 16 );
    }
    else
    {
        // fit to bounds
        map.fitBounds( bounds );
    }

}

var map = null;

$(document).ready(function() {
    $('.acf-map').each(function(){
        // create map
        map = new_map( $(this) );
    });
});

})(jQuery);	

