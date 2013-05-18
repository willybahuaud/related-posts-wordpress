//no-conflict
jQuery(function($) {

  // un tableau avec tous les conférenciers que l'on peut sélectionner
  var availableTags = <?php $confe = get_posts('post_type=conferencier&posts_per_page=-1');
  foreach($confe as $cf){
    echo '{value:"'.$cf->ID.'",label:"'.esc_js($cf->post_title).'"},'."\n";
  }?>
});