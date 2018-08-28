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
                    document.getElementById("barreNavigation").style.top = '-150px';
                }
                positionScroll = positionActuelle;

            }

        })

    // La navbar Admin

    var listeLienAdmin = document.getElementsByClassName("linkAdmin");


    function openNavbarAdmin(element, liste){

        if (element.getAttribute("data-menuAdmin") === "close"){

           element.setAttribute("data-menuAdmin", 'open');
           document.getElementById("navbarAdmin").style.width = "250px";
           document.getElementById("main").style.marginLeft = "250px";

            for (let i = 0 ; i < liste.length ; i++){
                liste[i].classList.add("show");
            }

            element.style.top = "10px";

        }else{
            element.setAttribute("data-menuAdmin", 'close')
            document.getElementById("navbarAdmin").style.width = 0;
            document.getElementById("main").style.marginLeft = 0;

            for (let i = 0 ; i < liste.length ; i++){
                liste[i].classList.remove("show");
            }

            element.style.top = "100px";

        }

    }


    var openBouton = document.getElementById("openBouton");

    if (openBouton != null) {
        openBouton.addEventListener('click', function() {
            openNavbarAdmin(this, listeLienAdmin);
        });
    }



}); // Fin du DOM ready