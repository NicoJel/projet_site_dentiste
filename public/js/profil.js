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