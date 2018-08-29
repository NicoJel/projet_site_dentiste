
var lienAjoutActe = document.getElementById("ajoutActe");
var formulaire = document.getElementById("formulaire");
var boutonFerme = document.getElementById("boutonFermer");

var inputActe = document.getElementById("inputActe");
var inputDuree = document.getElementById("inputDuree");
var inputCouleur = document.getElementById("inputCouleur");
var inputHidden = document.getElementById("inputHidden");

var actes = document.getElementsByClassName("actes");
var durees = document.getElementsByClassName("durees");
var couleurs = document.getElementsByClassName("couleurs");
var liensModif = document.getElementsByClassName("liensModif");


lienAjoutActe.addEventListener('click', function(){

    formulaire.classList.add('show');

});

boutonFerme.addEventListener('click', function(){

    inputActe.value = "";
    inputDuree.value = "";
    inputCouleur.value = "#918889";

    formulaire.classList.remove('show');

});

var inputs = document.getElementsByClassName("inputForm");
var boutonValider = document.getElementById("boutonValider");

for (let i = 0 ; i < inputs.length ; i++){

    inputs[i].addEventListener('blur', function(){

        if (this.value === ""){
            this.style.border = "red 1px solid";
            boutonValider.setAttribute("disabled", "true");

        } else{
            this.style.border = "1px solid #ced4da";
            boutonValider.removeAttribute("disabled");
        }

    })

}


for (let i = 0 ; i < liensModif.length ; i++){

    liensModif[i].addEventListener('click', function(e){

        e.preventDefault();

        let valActe = actes[i].getAttribute('data-acte');
        inputActe.value = valActe;

        let valDuree = durees[i].getAttribute('data-duree');
        inputDuree.value = valDuree;

        let valCouleur = couleurs[i].getAttribute("data-couleur");
        inputCouleur.value = valCouleur;

        let valId = this.getAttribute("data-id");
        inputHidden.value = valId;

        formulaire.classList.add('show');

    })


}

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




