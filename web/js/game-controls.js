$(document).ready(function () {
    game_api.initialize();
    team_controls.initialize($('div.team'), timer, game_api, game_api_event_url);
    timer.initialize($('div.timer'), game_api, game_api_time_url);

    $(window).bind('beforeunload', function(){
        if (timer.isRunning()) {
            return 'Are you sure you want to leave?';
        }
    });
});


