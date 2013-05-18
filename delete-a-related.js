//function qui me sert à supprimer l'ID d'un conférencier dans #conf_presents
function removeByElement(arrayName,arrayElement){
  for(var i=0; i if(arrayName[i]==arrayElement)
    arrayName.splice(i,1);
  }
}

//évènement de suppression de conférencier
function listenerremove(){
  $( "#conferenciers_presents" ).find('li .erase').on('click',function(){
    // suppression élément
    var $elem = $(this).parent('li'); //je cible l'élément à supprimer
    //je construit un talbeau avec les conférencier actuellement liés
    var all_conf_presents = new Array();
    all_conf_presents =$('#conf_presents').val().split(',');
    //je récupère l'ID à retirer
    var dataval = $elem.attr('data-id');
    // je supprime l'ID du tableau
    removeByElement(all_conf_presents,dataval);
    //je supprime le conférencier dans la liste
    $elem.remove();
    //je supprime son ID dans le champ caché
    $('#conf_presents').val(all_conf_presents);
  });
}

//je lance la fonction
listenerremove();