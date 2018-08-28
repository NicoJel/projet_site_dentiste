// au clic sur le logo ou le bouton, je modifie l'attribut disabled

var bouton = document.getElementById("modifier");
var logo = document.getElementById("logo");

bouton.addEventListener('click', function(e){

    if (bouton.getAttribute('id') === 'modifier') {
        e.preventDefault();
    }

    let arrayInput = document.getElementsByTagName("input");
    let commentaire = document.getElementById("commentaire");
    console.log(commentaire);

    for (let i = 0 ; i < arrayInput.length ; i++){
        let input = arrayInput[i];
        input.removeAttribute("disabled");
    }
    commentaire.removeAttribute("disabled");

    this.textContent = "Enregistrer";
    this.setAttribute("type", "submit");

    this.setAttribute('id', 'enregistrer');


});

logo.addEventListener('click', function(){

    let arrayInput = document.getElementsByTagName("input");
    let commentaire = document.getElementById("commentaire");

    for (let i = 0 ; i < arrayInput.length ; i++){
        let input = arrayInput[i];
        input.removeAttribute("disabled");
    }
    commentaire.removeAttribute("disabled");

    bouton.textContent = "Enregistrer";
    bouton.setAttribute("type", "submit");

    bouton.setAttribute('id', 'enregistrer');

});



// Clique sur le bouton supprimer (apparition de la modale)

var boutonSupprimer = document.getElementById("boutonSupprimer");
var logoSupprimmer = document.getElementById("logoSupprimer");
var modale = document.getElementById("fenetreModale");
var contenuModale = document.getElementsByClassName("contenu-fenetreModale")[0];

boutonSupprimer.addEventListener('click', function(){

    modale.classList.remove("hideModale");
    modale.classList.add("showModal");

});

logoSupprimmer.addEventListener('click', function(){

    modale.classList.remove("hideModale");
    modale.classList.add("showModal");

});


// Les événements de la modale
    // Fermer la modale
var fermerModale = document.getElementsByClassName("fermerModale");

for (let i = 0 ; i < fermerModale.length ; i++){

    fermerModale[i].addEventListener('click', function(){

        modale.classList.add("hideModale");

    })
}
