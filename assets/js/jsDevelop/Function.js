
//datepicker pour afficher la date
  $(document).ready(function(){
      var date_input=$('input[name="DateL"]'); 
      date_input.datepicker();

    });



// #add My info  to database
$(document).on('click', '#ModifierInfoUser',  function() {
 
  var msgDiv = document.getElementById('msgDiv');
  var queryString = $("#formExpediteur").serialize()+'&action=ModifierUser';
   $.ajax({
      url: 'Function.php?&'+queryString,
      type:'GET',
      success: function(data){
       //console.log(data);
       //alert('data = '+data);
       var json = $.parseJSON(data);

       if (json.reponse === 'ok') {
        msgDiv.innerHTML = 'Les informations Sont modifiés avec succes !!';
        msgDiv.className = "alert alert-success";
       

        window.setTimeout(function(){
          msgDiv.innerHTML = '';
          msgDiv.className = "";
          window.location.href = "";
        }, 900);
      } else {
        msgDiv.innerHTML = json.reponse;
        msgDiv.className = "alert alert-danger";
      }
    },
    error: function(err){
      console.log(err);
    },
  });
  
});

// #add info destination to database
$(document).on('click', '#modifierDestinataire',  function() {
 
 var msgDes = document.getElementById('msgDes');
  var queryString = $("#formDestinataire").serialize()+'&action=ModifierDestinataire';
  
  //alert(queryString);
   $.ajax({
      url: 'Function.php?&'+queryString,
      type:'GET',
      success: function(data){
       //console.log(data);
       //alert('data = '+data);
       var json = $.parseJSON(data);

       if (json.reponse === 'ok') {
        msgDes.innerHTML = 'Les informations de destinataire Sont modifiés avec succes !!';
        msgDes.className = "alert alert-success";
       

        window.setTimeout(function(){
          msgDes.innerHTML = '';
          msgDes.className = "";
          window.location.href = "";
        }, 1500);
      } else {
        msgDes.innerHTML = json.reponse;
        msgDes.className = "alert alert-danger";
      }
    },
    error: function(err){
      console.log(err);
    },
  });
  
});

// #add info paragLettre to database
$(document).on('click', '#modifierLettre',  function() {
 
 var msgparag = document.getElementById('msgparag');
  var queryString = $("#formParagLettre").serialize()+'&action=modifierLettre';
  
  //alert(queryString);
   $.ajax({
      url: 'Function.php?&'+queryString,
      type:'GET',
      success: function(data){
       //console.log(data);
       //alert('data = '+data);
       var json = $.parseJSON(data);

       if (json.reponse === 'ok') {
        msgparag.innerHTML = 'les paragraphes  Sont modifiés avec succes !!';
        msgparag.className = "alert alert-success";
       

        window.setTimeout(function(){
          msgparag.innerHTML = '';
          msgparag.className = "";
          window.location.href = "";
        }, 900);
      } else {
        msgparag.innerHTML = json.reponse;
        msgparag.className = "alert alert-danger";
      }
    },
    error: function(err){
      console.log(err);
    },
  });
  
});



$(document).on('click', '#deconnecter',  function() {
 
   $.ajax({
      url: 'Function.php?&action=deconnecter',
      type:'GET',
      success: function(data){
       var json = $.parseJSON(data);
       if (json.reponse === 'ok') {

        window.setTimeout(function(){
          window.location.href = "";
        }, 500);
      }
    },
    error: function(err){
      console.log(err);
    },
  });
  
});

