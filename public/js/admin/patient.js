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

    $('#inputRecherche').keyup(function (){

        $.get(
            Routing.generate('app_admin_patient_recherchepatient'),
            {"str": inputrecherche.value},
            function (reponse){
                $('#resultatRecherche').html(reponse);

            }
        )

    }) // fin de l'écoute de l'événement



    // La modale
    // Clique sur le bouton supprimer (apparition de la modale)

    var logosSupprimer = document.getElementsByClassName("logoSupprimer");

    var modale = document.getElementById("fenetreModale");

    var boutonValider = document.getElementById('boutonValider');

    for (let i = 0 ; i < logosSupprimer.length ; i++){

        logosSupprimer[i].addEventListener('click', function(e){

            e.preventDefault();

            modale.classList.remove("hideModale");
            modale.classList.add("showModal");

            let href = this.getAttribute('href');

            boutonValider.setAttribute("href", href);


        });

    }


// Les événements de la modale
    // Fermer la modale
    var btnFermerModale = document.getElementsByClassName("fermerModale");

    for (let i = 0 ; i < btnFermerModale.length ; i++){

        btnFermerModale[i].addEventListener('click', function(){

            modale.classList.add("hideModale");

        });

    }


    // Au clic sur le lien ajouter patient
    // aparition du formulaire rapide

    var lienFormulaire = document.getElementById("lienFormulaire");
    var formulaire = document.getElementById("formulaire");
    var fermerForm = document.getElementById("fermerForm");

    lienFormulaire.addEventListener('click', function(){

        formulaire.classList.add("show");

    });

    fermerForm.addEventListener('click', function(){

        formulaire.classList.remove("show");

    });

    var inputs = document.getElementsByClassName("inputForm");
    var boutonSubmit = document.getElementById("boutonSubmit");

    for (let i = 0 ; i < inputs.length ; i++){

        inputs[i].addEventListener('blur', function(){

            if (this.value === ""){
                this.style.border = "red 1px solid";
                boutonSubmit.setAttribute("disabled", "true");
            }else{
               this.style.border = "1px solid #ced4da";
               boutonSubmit.removeAttribute("disabled");
            }

        })

    }



}); // Fin du DOM ready