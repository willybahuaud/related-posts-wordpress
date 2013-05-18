//Construction
function conferenciers_concernes($post){
//je récupère la meta potentiellement sauvegardée
$conferenciers_presents = get_post_meta($post->ID,'_conferenciers_presents',false);

//je créer un nonce
wp_nonce_field('update-conferenciers_'.$post->ID, '_wpnonce_update_conferenciers);

//mon widget
echo '<div class="ui-widget">';
// le champ qui servira de support à autocomplete
echo '<label for="nom">Nom : </label><input id="nom" type="text" />';
// la liste des conférenciers concernés (assurant un retour visuel pour l'utilisateur)
echo '<ul>';
// j'y affiche toutes les entrées déjà sauvegardées dans la meta</ul>
if( ! empty( $conferenciers_presents) )
  foreach( $conferenciers_presents as $c )
    echo '<li data-id="' . $c . '"><span class="erase">x</span> ' . get_the_title($c) . '</li>
echo '<ul>';

// mon champ caché, que je mettrai à jour et sauvegarderai
// il contient déjà les valeurs de la meta
echo'<input id="conf_presents" type="hidden" name="conf_presents" value="'.implode(',',$conferenciers_presents).'" />';

//fin du widget
echo '</div>';