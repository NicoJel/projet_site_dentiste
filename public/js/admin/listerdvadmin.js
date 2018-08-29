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
