
var lienAjoutActe = document.getElementById("ajoutActe");
var formulaire = document.getElementById("formulaire");
var boutonFerme = document.getElementById("boutonFermer");

lienAjoutActe.addEventListener('click', function(){

    formulaire.classList.add('show');

});

boutonFerme.addEventListener('click', function(){

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

