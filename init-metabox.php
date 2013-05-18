// Initialisation de la metabox, pour le CPT "conference"
add_action('add_meta_boxes','mes_metaboxes');
function mes_metaboxes(){
  add_meta_box('conferenciers_presents', 'Conférenciers présents', 'conferenciers_concernes', 'conference', 'side', 'default');
}