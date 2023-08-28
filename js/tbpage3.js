
function atelierValueSender(m,y){
    let id=document.getElementById('Atelier').value;
    if(id>0){
    location.href="tbpageaction2.php?m="+m+"&y="+y+"&id="+id;}
    else{
        document.getElementById("zone").innerHTML="<option>choisissez un UEP</option>";
    }
}

function zoneValueSender(m,y){
  let idZ=document.getElementById('Zone').value;
  let id=document.getElementById('Atelier').value;
    if(id>0 && idZ>0){
    location.href="tbpageaction2.php?m="+m+"&y="+y+"&id="+id+"&idZ="+idZ;}
    else{
        document.getElementById("Atelier").innerHTML='<option>choisissez un Atelier</option> <option value="1">STRUCTURE</option> <option value="2">PEINTURE</option> <option value="3">MONTAGE</option> <option value="4">BTU</option>';
        document.getElementById("zone").innerHTML="<option>choisissez une UEP</option>";

    }
}
function moduleValueSender(m,y){
  let idM=document.getElementById('module').value;
  let idZ=document.getElementById('Zone').value;
  let id=document.getElementById('Atelier').value;
    if(id>0 && idZ>0 && idM>0){
    location.href="tbpageaction2.php?m="+m+"&y="+y+"&id="+id+"&idZ="+idZ+"&idM="+idM;}
    else{
        document.getElementById("zone").innerHTML="<option>choisissez une UEP</option>";
        document.getElementById("Atelier").innerHTML='<option>choisissez un Atelier</option> <option value="1">STRUCTURE</option> <option value="2">PEINTURE</option> <option value="3">MONTAGE</option> <option value="4">BTU</option>';

        document.getElementById("module").innerHTML="<option>choisissez un Module</option>";
    }
}

tab=[];

if(tab.lenght>0){
    html="<option "
    tab.forEach(e => {
        html+="value="+e.id+">"+e.nom+"</option>"
    });
    document.getElementById("zone").innerHTML=html;
}
/*
function verifierAudit(event) {
    event.preventDefault();
  
    var inputs = document.querySelectorAll("input[class='required' ]");
    var selects = document.querySelectorAll("select");
  
    var isEmptyInput = Array.from(inputs).some(function(input) {
      return input.value.trim() === "";
    });
  
    var isUnselectedSelect = Array.from(selects).some(function(select) {
      return select.value === "";
    });
  
    if (isEmptyInput || isUnselectedSelect) {
      alert("Veuillez remplir tous les champs.");
    } else {
      var confirmation = confirm("Voulez-vous continuer vers la page du questionnaire ?");
      if (confirmation) {
        event.target.form.submit();
      }
    }
  }
  */
  