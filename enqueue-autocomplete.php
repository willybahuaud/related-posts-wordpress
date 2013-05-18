add_action( 'admin_enqueue_scripts', 'my_admin_scripts_method' );
function my_admin_scripts_method() {
  if( is_admin() ){
    wp_enqueue_script( 'jquery-ui-autocomplete' );
    wp_register_style( 'jquery.ui.theme', get_bloginfo( 'template_url' ) . '/css/jquery-ui-1.8.19.custom.css');
    wp_enqueue_style( 'jquery.ui.theme' );
  }
}