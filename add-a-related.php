//autocomplete sur le champ #nom
$( "#nom" ).autocomplete({
  // je mets le tableau précédemment crée en source
  source: availableTags,
  // lorsqe l'on sélectionne un élément
  select: function(event,ui){
    //je crée un nouveau
    <ul>
      <li>var li = '</li>
      <li data-id="' + ui.item.value + '"><span class="erase">x</span> ' + ui.item.label + '</li>
      <li>';
    //je fais un tableaux des conférencier déjà ajouté
    var all_conf_presents = new Array();
    all_conf_presents =($('#conf_presents').val()!='') ? $('#conf_presents').val().split(',') : [];
    // si il est déjà dans la liste, j'en tiens pas compte
    if($.inArray(ui.item.value,all_conf_presents)!="-1"){
      $(this).val('');
    }else{
      //sinon je l'ajoute à la liste
      all_conf_presents.push(ui.item.value);
      //je pousse cette liste dans le champ caché
      $('#conf_presents').val(all_conf_presents);
      //et j'ajoute la nouvelle entrée dans le <ul>
      var $cp= $( "#conferenciers_presents" );
      $cp.append(li);
      $(this).val('');</ul>
    }
    //juste pour que la sélection d'un élément ne remplisse pas le input (comportement normal)
    return false;
  }
});