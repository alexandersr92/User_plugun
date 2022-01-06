<?php 

// Register assets


function custom_enqueue() {


   
	wp_enqueue_style( 'custom',  substr( plugin_dir_url(__FILE__), 0, -4).'/assets/css/custom.css' , false );

	wp_enqueue_style( 'bootstrap', 'https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css',  false  );



	wp_enqueue_script( 'bootstrapjs', 'https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js',  true );
	wp_enqueue_script('jquery');

	wp_enqueue_script( 'app',  substr( plugin_dir_url(__FILE__), 0, -4).  '/assets/js/app.js', array(), 1,  true  ); 

	

}

add_action('wp_enqueue_scripts', 'custom_enqueue');

?>