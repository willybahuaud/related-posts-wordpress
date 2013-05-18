//sauvegarde
add_action('save_post','sauvegarde_metabox');
function sauvegarde_metabox($post_id){
    //s'il s'agit bien d'une sauvegarde volontaire
    if( ( !defined( 'DOING_AJAX' ) || !DOING_AJAX ) &amp;&amp; isset($_POST['conf_presents'])){
        //test du nonce
        check_admin_referer( 'update-conferenciers_'.$post_id,'_wpnonce_update_conferenciers' );

        // je suprrime tout
        delete_post_meta($post_id,"_conferenciers_presents");
        //j'éclate mon input
        $conf = explode(',',$_POST['conf_presents']);
        foreach($conf as $c){
            //pour chaque entrée j'ajoute une meta
            add_post_meta($post_id, "_conferenciers_presents", intval($c));
        }
    }
}