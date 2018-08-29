// Au clic sur le lien ajouter rdv

// aparition du formulaire rapide

var lienFormulaire = document.getElementById("ajoutRdv");
var formulaire = document.getElementById("formulaire");
var fermerForm = document.getElementById("fermerForm");

var liensModif = document.getElementsByClassName("lienModif");

var inputDate = document.getElementById("inputDate");
var inputTime = document.getElementById("inputTime");
var inputRemarques = document.getElementById("textareaCommentaires");
var textesLibres = document.getElementsByClassName("texteLibre");
var optionBidon = document.getElementById("optionBidon");
var optionsSelect = document.getElementsByClassName("optionSelect");

var dates = document.getElementsByClassName("date");
var times = document.getElementsByClassName("time");
var motifs = document.getElementsByClassName("inputsMotif");

var inputHidden = document.getElementById("inputHidden");



lienFormulaire.addEventListener('click', function(){

    formulaire.classList.add("show");


});


fermerForm.addEventListener('click', function(){

    inputTime.setAttribute("value", "");
    inputRemarques.textContent = "";
    inputDate.setAttribute("value", "");
    inputHidden.setAttribute("value", "");

    for (let j = 0 ; j < optionsSelect.length ; j++){
        if (optionsSelect[j].getAttribute("selected")){
            optionsSelect[j].removeAttribute("selected");
        }
    }

    optionBidon.setAttribute("selected", "true");

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

/** Modification du tableau pour la modificatgion **/


for (let i = 0 ; i < liensModif.length ; i++){

    liensModif[i].addEventListener('click', function(e){

        e.preventDefault();

        let valDate = dates[i].getAttribute("data-date");
        inputDate.setAttribute("value", valDate);

        let valTime = times[i].textContent;
        inputTime.setAttribute('value', valTime);

        let valMotif = motifs[i].textContent;
        console.log(valMotif);

        optionBidon.removeAttribute("selected");

        for (let j = 0 ; j < optionsSelect.length ; j++){

            if (optionsSelect[j].textContent === valMotif){
                optionsSelect[j].setAttribute("selected", 'true');
            }

        }

        let valTexteLibre = textesLibres[i].textContent;
        inputRemarques.textContent = valTexteLibre;

        let idRdv = this.getAttribute("data-id");
        inputHidden.value = idRdv;

        formulaire.classList.add("show");

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


