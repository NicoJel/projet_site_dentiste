$(document).ready(function(){

// Fermeture des messages flash message

    var boutonsFermes = document.getElementsByClassName("boutonFerme");


    for (let i = 0 ; i < boutonsFermes.length ; i++){

        boutonsFermes[i].addEventListener('click', function(){

            let divMessage = this.parentElement;

            divMessage.style.opacity = "0";

            setTimeout(function(){
                divMessage.style.display = "none";
            }, 600);

        })

    }


    // La navbar et sa position




        var positionScroll = window.pageYOffset;

        window.addEventListener('scroll', function(){

            if (window.innerWidth > 993){

                let positionActuelle = window.pageYOffset;

                if (positionScroll > positionActuelle){
                    document.getElementById("barreNavigation").style.top = 0;
                }else{
                    document.getElementById("barreNavigation").style.top = '-100px';
                }
                positionScroll = positionActuelle;

            }

        })





}); // Fin du DOM ready