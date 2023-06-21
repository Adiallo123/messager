setInterval('load_messages()', 500);
function load_messages(){
    $('#res').load('index.php?action=recupererMessage');
}

/*
function getdata()
{
   var envoyer = document.getElementById("Envoyer");
    
   if(envoyer)
   {
    $.ajax({
      type: 'post',
      url: 'index.php?action=recupererMessage',
      data: {
        Envoyer:envoyer,
      },
      success: function (response) {
         $('#res').html(response);
      }
    });
   }
   else
   {
    $('#res').html("Entrez le nom de l'utilisateur");
   }
}
*/
