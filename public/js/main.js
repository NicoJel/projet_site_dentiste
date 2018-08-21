$(document).ready(function(){


    // Si les messages sont des erreurs, je ne les fait pas disparaitre

    var divMessage = document.getElementById("messageFlash");
    var divEnfant = document.getElementById("messageFlash").firstElementChild;

    var verif = $(divEnfant).hasClass("alert-danger");

    if (verif){
        divMessage.classList.remove("flashMessageAnimation");
    }

}) // Fin du DOM ready