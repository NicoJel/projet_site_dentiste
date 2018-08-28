$(function() {

    var acte;
    var duree;
    var color;
    var eventData;

    $("#rdv_motif").change(function(){
        if (this.value != ''){
            document.getElementById("imagegris").style.display = "none";
            console.log("coucou");
            var id_motif = this.value;
            console.log(id_motif);
            $.get(
                Routing.generate("app_rdv_newrdv"),
                {"id": id_motif},
                function(response) {
                    console.log(response);
                    acte = response["acte"]
                    duree = response["duree"]
                    color = response["couleur"]

                    eventData = {
                        title: acte, // récuperé en ajax
                        color: color, // recup en ajax
                        description: "description",
                        editable: true, // event editable ou pas
                    };
                }
            )
        } else {
            document.getElementById("imagegris").style.display = "block";
        }
    });




    $('#calendar').fullCalendar({
        locale: 'fr',
        header: {
            left: 'prev,next today',
            center: 'title',
            right: 'agendaDay,agendaWeek,month,listDay'
        },

        // customize the button names,
        // otherwise they'd all just say "list"
        views: {
            agendaDay: { buttonText: 'jour' },
            agendaWeek: { buttonText: 'semaine' },
            month: { buttonText: 'mois' },
            listDay: { buttonText: 'liste jour' }
        },
        themeSystem: 'bootstrap4',
        height: 770,
        defaultView: 'agendaWeek',
        allDaySlot: false, // pas de slot pour rdv qui prend toute la journée
        navLinks: true, // can click day/week names to navigate views
        selectable: true, // autorise à créer un rdv
        selectHelper: true,
        selectOverlap: false, // interdit de créer un rdv sur un autre
        slotEventOverlap: false, // juste de l'affichage pour l'overlap
        eventOverlap: false, // interdit de drag un rdv sur un autre
        eventDurationEditable: false, // pour interdire le resize (autoriser à l'admin?)
        minTime: "08:00:00", // 1ere heure affichée sur le cal: 8h
        maxTime: "19:00:00", // derniere heure
        slotDuration: '00:30:00', // temps d'une case
        forceEventDuration: true,
        businessHours: {
            // days of week. an array of zero-based day of week integers (0=Sunday)
            dow: [ 1, 2, 3, 4, 5 ], // Monday - Friday
            start: '09:00', // a start time (9am in this example)
            end: '18:00', // an end time (6pm in this example)
        }, // j'ai définis ici mes heures de boulot
        eventConstraint: "businessHours", // je ne peux pas déplacer en dehors des heures
        selectConstraint: "businessHours", // je ne peux pas créer en dehors des heures
        editable: true, // autorise à modifier les rdv, il faudrait qu'un user ne puisse modifier que SES rdv, admin peut tout modifier
        eventLimit: true, // allow "more" link when too many events
        dragScroll: false,
        defaultTimedEventDuration: '03:00:00',
        selectAllow: function(selectInfo) {
            var duration = moment.duration(selectInfo.end.diff(selectInfo.start));
            return duration.asHours() <= 0.5; // limite la selection à 30mn
        },



        events: rdvs,//appelle le tableau de données

        // -------- fonction select -------- //
        selectOverlap: function(event) {
            return revertFunc();
        },

        select: function(start, end) {


            // if (!confirm("choisir cette heure ?")) {
            //     $("#calendar").fullCalendar('removeEvent', function (eventObject) {
            //         return true;
            //     });
            // }
            // else {


            console.log(start);
            console.log(eventData);

            end =  $.fullCalendar.moment(start);
            end.add(duree, 'minutes');

            eventData[ "start" ] = start;
            eventData[ "end" ] = end;

            // eventData = {
            //     title: acte, // récuperé en ajax
            //     start: start, // créé direct par fullcalendar
            //     end: end, // calculé via start + duree
            //     color: color, // recup en ajax
            //     description: "description",
            //     editable: true, // event editable ou pas
            // };

            var start = moment(start).format('YYYY-MM-DD HH:mm');
            console.log(start);
            $('#rdv_debut').val(start);

            document.getElementById("button-rdv").disabled = false



            $('#calendar').fullCalendar('renderEvent', eventData, true); // stick? = true

            $('#calendar').fullCalendar('unselect');


            $.get(
                Routing.generate("app_rdv_getstart"),
                {"start": start},
                function(response) {
                    //console.log(response);
                }
            );
        // }
        },


        // -------- fonction eventClick -------- //

        eventClick: function(date, jsEvent, view, element) {

            // alert('Clicked on: ' + date.format());
            //
            // alert('Coordinates: ' + jsEvent.pageX + ',' + jsEvent.pageY);
            //
            // alert('Current view: ' + view.name);

            element.find(".fc-content").append("<div>YOUPIIIIIIIII</div>");

        },

        // -------- fonction eventDrop -------- //

        eventDrop: function(event) {
            var start = moment(event.start).format('YYYY-MM-DD HH:mm');

            $('#rdv_debut').val(start);

            $.get(
                Routing.generate("app_rdv_getstart"),
                {"start": start},
                function(response) {
                }
            );
        },

        // -------- fonction eventrender -------- //

        eventRender: function(event, element, view) {
            element.find('.fc-title').append("<br/>" + event.description);

                if (view.name == 'listDay') {
                    element.find(".fc-list-item-time").append("<span class='closeon'>X</span>");
                } else {
                    element.find(".fc-content").prepend("<span class='closeon'>X</span>");
                }
                element.find(".closeon").on('click', function () {
                    $('#calendar').fullCalendar('removeEvents', event._id);
            });

    }

});
});


