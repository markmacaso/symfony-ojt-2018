var game_api = {

    initialize: function ()
    {
    },

    score : function(url, team_id, player_id, period, time, points, description, score, callback)
    {
        var data = {
            type : 'score',
            team_id : team_id,
            player_id : player_id,
            period : period,
            time : time,
            points : points,
            description : description,
            score: score
        };

        this.send(url, data);
    },

    time: function(url, action, period, time, callback)
    {
        var data = {
            action : action,
            period : period,
            time : time
        };
        this.send(url, data, callback);
    },

    send : function(url, data, callback)
    {
        $.post({
            url: url,
            dataType: 'json',
            data: data,
            async: true,
            success: function(result)
            {
                console.log(result);
            }
        });
    }
};
