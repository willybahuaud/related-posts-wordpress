
// chargement des scripts
add_action('admin_enqueue_scripts', 'my_admin_scripts_method');
function my_admin_scripts_method(){
  if(is_admin()){
    wp_enqueue_script('jquery-ui-autocomplete');
    wp_register_style('jquery.ui.theme', get_bloginfo('template_url') . '/css/jquery-ui-1.8.19.custom.css');
    wp_enqueue_style('jquery.ui.theme');
  }
}

// Initialisation de la metabox, pour le CPT "conference"
add_action('add_meta_boxes','mes_metaboxes');
function mes_metaboxes(){
  add_meta_box('conferenciers_presents', 'Conférenciers présents', 'conferenciers_concernes', 'conference', 'side', 'default');
}

//Construction
function conferenciers_concernes($post){
  $conferenciers_presents = get_post_meta($post->ID,'_conferenciers_presents',false);
  
  wp_nonce_field('update-conferenciers_'.$post->ID, '_wpnonce_update_conferenciers');

echo '<div class="ui-widget">';
echo '<label for="nom">Nom : </label><input id="nom" type="text" />';
echo '</div><ul>';
if(!empty( $conferenciers_presents)){
  foreach($conferenciers_presents as $c){
    echo '<li data-id="' . $c . '"><span class="erase">x</span> ' . get_the_title($c) . '</li>';
  }
}
echo '</ul>';

echo'<input id="conf_presents" type="hidden" name="conf_presents" value="'.implode(',',$conferenciers_presents).'" />';
echo '</div>';

?>
<script type="text/javascript">// <![CDATA[
jQuery(function($) {

    // un tableau avec tous les conférenciers que l'on peut sélectionner
    var availableTags = [<?php
    $confe = get_posts('post_type=conferencier&posts_per_page=-1');
    foreach($confe  as $cf){
      echo '{value:"'.$cf->ID.'",label:"'.esc_js($cf->post_title).'"},'."\n";
    }
    ?>];

    //autocomplete sur le champ #nom
  $("#nom").autocomplete({
    source: availableTags,
    select: function(event,ui){
      var li = '<li data-id="' + ui.item.value + '"><span class="erase">x</span> ' + ui.item.label + '</li>';
      var all_conf_presents = new Array();
      all_conf_presents =($('#conf_presents').val()!='') ? $('#conf_presents').val().split(',') : [];
      if($.inArray(ui.item.value,all_conf_presents)!="-1"){
        $(this).val('');
      }else{
        all_conf_presents.push(ui.item.value);
        $('#conf_presents').val(all_conf_presents);
        var $cp= $( "#conferenciers_presents" );
        $cp.append(li);
        $(this).val('');
        listenerremove();
      }         

      return false;
    }
  });

  //function qui me sert à supprimer l'ID d'un conférencier dans #conf_presents
  function removeByElement(arrayName,arrayElement){
    for(var i=0; i<arrayName.length;i++ ){ 
    if(arrayName[i]==arrayElement)
      arrayName.splice(i,1); 
    } 
  }

  //évènement de suppression de conférencier
  function listenerremove(){
    $("#conferenciers_presents").find('li .erase').on('click',function(){
      var $elem = $(this).parent('li');
      var all_conf_presents = new Array(); 
      all_conf_presents =$('#conf_presents').val().split(',');
      var dataval = $elem.attr('data-id');
      removeByElement(all_conf_presents,dataval);
      $elem.remove();
      $('#conf_presents').val(all_conf_presents);
    });
  }

  listenerremove();
 });

// ]]></script>

<?php }

//sauvegarde
add_action('save_post','sauvegarde_metabox');
function sauvegarde_metabox($post_id){
  if( ( !defined( 'DOING_AJAX' ) || !DOING_AJAX ) && isset($_POST['conf_presents'])){

    check_admin_referer( 'update-conferenciers_'.$post_id,'_wpnonce_update_conferenciers' );

    delete_post_meta($post_id,"_conferenciers_presents");
    $conf = explode(',',$_POST['conf_presents']);
    foreach($conf as $c){
      add_post_meta($post_id, "_conferenciers_presents", intval($c));
    }
  }
}