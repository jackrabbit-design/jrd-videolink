<?php
/* Template Name: Locations */
get_header(); the_post(); ?>

<div id="int-banner" style="background-image:url('<?php $banner = get_field('banner_image'); $default = get_field('default_header_image','options'); echo ($banner ? $banner['sizes']['int-banner'] : $default['sizes']['int-banner']); ?>')">
    <span></span>
    <h2><?php the_title(); ?></h2>
</div>
<h2 id="int-logo"><?php bloginfo('name') ?></h2>

<div class="wrap int clearfix">

    <?php get_sidebar('left'); ?>

    <?php if(get_field('sidebar_modules')): ?>
        <?php get_sidebar('right'); ?>
    <?php endif; ?>
    
    <article id="article" <?php echo (get_field('sidebar_modules') ? '' : ' class="over-right"') ?>>
        
<script type="text/javascript">
    // When the window has finished loading create our google map below
    google.maps.event.addDomListener(window, 'load', init);
    
    function init() {
        // Basic options for a simple Google Map
        // For more options see: https://developers.google.com/maps/documentation/javascript/reference#MapOptions
        
        var address = '<?php the_field('address') ?>';
        
        var mapOptions = {
            // How zoomed in you want the map to start at (always required)
            zoom: 12,
            
            disableDefaultUI: true,
            
            // The latitude and longitude to center the map (always required)
            //center: new google.maps.LatLng(40.6700, -73.9400), // New York
            
            // How you would like to style the map. 
            // This is where you would paste any style found on Snazzy Maps.
            styles: [{"featureType":"water","stylers":[{"saturation":43},{"lightness":-11},{"hue":"#0088ff"}]},{"featureType":"road","elementType":"geometry.fill","stylers":[{"hue":"#ff0000"},{"saturation":-100},{"lightness":99}]},{"featureType":"road","elementType":"geometry.stroke","stylers":[{"color":"#808080"},{"lightness":54}]},{"featureType":"landscape.man_made","elementType":"geometry.fill","stylers":[{"color":"#ece2d9"}]},{"featureType":"poi.park","elementType":"geometry.fill","stylers":[{"color":"#ccdca1"}]},{"featureType":"road","elementType":"labels.text.fill","stylers":[{"color":"#767676"}]},{"featureType":"road","elementType":"labels.text.stroke","stylers":[{"color":"#ffffff"}]},{"featureType":"poi","stylers":[{"visibility":"off"}]},{"featureType":"landscape.natural","elementType":"geometry.fill","stylers":[{"visibility":"on"},{"color":"#b8cb93"}]},{"featureType":"poi.park","stylers":[{"visibility":"on"}]},{"featureType":"poi.sports_complex","stylers":[{"visibility":"on"}]},{"featureType":"poi.medical","stylers":[{"visibility":"on"}]},{"featureType":"poi.business","stylers":[{"visibility":"simplified"}]}]
        };
        
        // Get the HTML DOM element that will contain your map 
        // We are using a div with id="map" seen below in the <body>
        var mapElement = document.getElementById('map');
            
        var geocoder = new google.maps.Geocoder();
        
        geocoder.geocode({
            'address': address
        }, 
        function(results, status) {
            if(status == google.maps.GeocoderStatus.OK) {
                map.setCenter(results[0].geometry.location);
            }
        });
        
        // Create the Google Map using out element and options defined above
        var map = new google.maps.Map(mapElement, mapOptions);
        
        geocoder = new google.maps.Geocoder();
        geocoder.geocode({ 'address': address }, function(results, status) {
            if (status == google.maps.GeocoderStatus.OK) {
                map.setCenter(results[0].geometry.location);
                var marker = new google.maps.Marker({
                    map: map,
                    position: results[0].geometry.location,
                    icon: '/ui/images/map-marker.png'
                })
                google.maps.event.addListener( marker, 'click', function() {
                	window.open( 'https://www.google.com/maps/place/' + '<?php the_field('address') ?>', '_blank' );
                } );
            }
        });
        
    }
</script>
        
        <div id="map"></div>

        <div class="loc addr"><?php the_field('address') ?></div>
        <div class="loc phone"><?php the_field('phone_numbers') ?></div>
        <div class="loc fax"><?php the_field('fax_number') ?></div>
    
        <?php the_content(); ?>
        
        <?php if($vid = get_field('inline_video')): ?>
        
            <a href="<?php echo $vid->guid ?>" class="btn lb-trigger">View Studio Tour</a>
            
        <?php endif; ?>

        
    </article>
</div>


<?php get_footer(); ?>