


$(document).ready(function() {
    $(".edit-button").click(function() {
        const id=$(".edit-button span").text();
        console.log("id:"+id);
    });

   
    // popup functionality
    var showPopup=$("#contact-popup").dialog({ 
        autoOpen: false ,
        height: 500,
        width: 400,
        modal: true,
        
        close: function() {
          add_window.dialog( "close" );
        }
    });

    $("#add-contact").click(function() {
        showPopup.dialog("open");
    });

    $('#submit').click(function(){
        var prenom = $('#prenom').val();
        var nom = $('#nom').val();
        var id_categorie = $('#id_categorie').val();
        console.log("prenom:"+prenom);
        
        $.ajax({
            url: "class.contact.php",
            type: "POST",
            data: {
                prenom: prenom,
                nom: nom,
                id_categorie: id_categorie
            },
            success: function(response){
                //$('#result').html(response);
                console.log("rep:"+response);
            },
            error: function(jqXHR, textStatus, errorThrown){
                console.log("ERREUR "+textStatus, errorThrown);
            }
        });
    });
    
});
