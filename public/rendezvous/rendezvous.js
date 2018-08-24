$(function() {

    $('#calendar').fullCalendar({
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

        defaultView: 'agendaWeek',
        defaultDate: '2018-03-12',
        allDaySlot: false, // pas de slot pour rdv qui prend toute la journée
        navLinks: true, // can click day/week names to navigate views
        selectable: true, // autorise à créer un rdv
        selectHelper: true,
        selectOverlap: false, // interdit de créer un rdv sur un autre
        slotEventOverlap: false, // juste de l'affichage pour l'overlap
        eventOverlap: false, // interdit de drag un rdv sur un autre
        eventDurationEditable: false, // pour interdire le resize (autoriser à l'admin?)
        minTime: "08:00:00", // 1ere heure affichée sur le cal: 8h
        maxTime: "18:00:00", // derniere heure
        slotDuration: '00:15:00', // temps d'une case
        defaultTimedEventDuration: '00:30:00', // temps d'un rdv par défaut (ne sert probablement à rien car ils st def dans chaque event)
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
        // chargement des events pour affichage
        events: rdvs,//appelle le tableau de données

        // -------- fonction select -------- //


        select: function(start) {
            var eventData;

            if (title) {
                eventData = {
                    title: acte, // dans la table motif
                    start: start, // créé direct par fullcalendar?
                    end: end, // créé au dessus à partir de durée
                    color: couleur, // dans la table motif
                    nompatient: nomprenom, // chaine avec nom et prenom de la table utilisateur
                    commentaire: textelibre, // faudrait l'afficher que pour l'admin, table rdv
                    editable: true, // event editable ou pas
                };
                $('#calendar').fullCalendar('renderEvent', eventData, true); // stick? = true
            }
            $('#calendar').fullCalendar('unselect');
        },

        eventRender: function(event, element) {
            element.find('.fc-title').append("<br/>" + event.description);
        },


        /*

                events: function(start, end, timezone, callback) {
                    $.ajax({
                        url: '../../src/controller/RdvController.php',

                        error: function() {
                            $('#script-warning').show();
                        },

                        success: function(doc) {
                            var events = [];
                            $(doc).find('event').each(function() {
                                events.push({
                                    title: $(this).attr('title'),
                                    start: $(this).attr('start') // will be parsed
                                });
                            });
                            callback(events);
                        }
                    });
                }
        */



/*

    select: function(start, end, allDay) {
        var title = prompt('Event Title:');
        if (title) {
            start = $.fullCalendar.formatDate(start, "yyyy-MM-dd HH:mm:ss");
            end = $.fullCalendar.formatDate(end, "yyyy-MM-dd HH:mm:ss");
            $.ajax({
                url: 'http://localhost/fullcalendar/add_events.php',
                data: 'title='+ title+'&start='+ start +'&end='+ end ,
                type: "POST",
                success: function(json) {
                    alert('OK');
                }
            });
            calendar.fullCalendar('renderEvent',
                {
                    title: title,
                    start: start,
                    end: end,
                    allDay: allDay
                },
                true // make the event "stick"
            );
        }
        calendar.fullCalendar('unselect');
    }

*/





    });
    });

















/*else if (title == "15mn") {
                end = $.fullCalendar.moment(start);
                end.add(0.25, 'hours');
                eventData = {
                    title: title,
                    start: start,
                    end: end,
                    color: "green", // à changer en fonction de l'event
                    editable: true, // cet event uniquement est éditable
                    description: "Nom du patient"

                }
                ;
                $('#calendar').fullCalendar('renderEvent', eventData, true); // stick? = true
            }
*/

/*
if (title == "2h") {
                end = $.fullCalendar.moment(start);
                end.add(2, 'hours');
                eventData = {
                    title: title,
                    start: start,
                    end: end,
                    color: "red", // à changer en fonction de l'event
                    editable: true, // cet event uniquement est éditable
                    description: "Nom du patient"

                }
                ;
                $('#calendar').fullCalendar('renderEvent', eventData, true); // stick? = true

            }
 */



