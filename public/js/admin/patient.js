$(function () {

    // Le bouton pour remonter en haut de facon smooth
    var boutonRemonte = document.getElementById("lienRemonte");
    var titre = document.getElementById("titre");

    boutonRemonte.addEventListener('click', function(){


        titre.scrollIntoView({
            behavior: 'smooth',
        })


    });


// La recherche

    var inputrecherche = document.getElementById('inputRecherche');
    var recherche = '';

    $('#inputRecherche').keyup(function (){
console.log('là');
        recherche = inputrecherche.value;
console.log(recherche);


        if (recherche.length > 2){

            $.get(
                Routing.generate('app_admin_patient_recherchepatient'),
                {"str": recherche},
                function (reponse){
                    $('#resultatRecherche').html(reponse);
                }
            )

        }




    }) // fin de l'écoute de l'événement




}); // Fin du DOM ready