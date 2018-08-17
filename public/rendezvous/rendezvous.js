$(function() {
    YUI().use(
        'aui-scheduler',
        function (Y) {
            var events = [
                {
                    color: "#8d8",
                    content: 'Earth Day Lunch',
                    disabled: true,
                    endDate: new Date(2013, 3, 22, 13),
                    meeting: true,
                    reminder: true,
                    startDate: new Date(2013, 3, 22, 12)
                },

            ];


            var weekView = new Y.SchedulerWeekView();

            var eventRecorder = new Y.SchedulerEventRecorder();

            new Y.Scheduler(
                {
                    activeView: weekView,
                    boundingBox: '#myScheduler',
                    date: new Date(2013, 3, 25),
                    eventRecorder: eventRecorder,
                    items: events,
                    render: true,
                    views: [weekView]
                }
            );
        }
    );
});