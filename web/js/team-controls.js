var team_controls = {
    team_elems: null,
    timer: null,
    game_api: null,
    game_api_event_url : null,

    /**
     * Initialize the input functionality
     * @param jQuery elems
     */
    initialize: function(elems, timer, game_api, game_api_event_url) {

        this.team_elems = elems;
        this.timer = timer;
        this.game_api = game_api;
        this.game_api_event_url = game_api_event_url;

        var self = this;

        // add listener
        this.team_elems.find('button.btn-add-points').click(function() {
            var elem       = $(this);
            var team_id    = self.getTeamId(elem);
            var points     = self.getPoints(elem);
            var score      = self.getCurrentScore(elem);
            var score_elem = self.getCurrentScoreDisplayElement(elem);

            self.addPoints(team_id, points, score, score_elem);
        });
        this.team_elems.find('button.btn-minus-points').click(function() {
            var elem       = $(this);
            var team_id    = self.getTeamId(elem);
            var points     = self.getPoints(elem);
            var score      = self.getCurrentScore(elem);
            var score_elem = self.getCurrentScoreDisplayElement(elem);

            self.minusPoints(team_id, points, score, score_elem);
        });
        this.team_elems.find('button.btn-set-score').click(function() {
            var elem       = $(this);
            var score      = elem.closest('div.team').find('input.text-score-input').val();
            var score_elem = self.getCurrentScoreDisplayElement(elem);

            self.setScore(score, score_elem);
        });
    },

    /**
     * Get the team id based on a clicked element
     * @param jQuery elem
     * @return string
     */
    getTeamId: function (elem) {
        return elem.closest('div.team').data('team_id');
    },

    /**
     * Get the points based on a clicked element
     * @param Object elem
     * @return string
     */
    getPoints: function (elem) {
        return elem.data('points');
    },

    /**
     * Get the score display element base on the clicked element
     * @param Object elem
     * @return jQuery
     */
    getCurrentScoreDisplayElement: function (elem) {
        return elem.closest('div.team').find('span.span-team-score');
    },

    /**
     * Get the points based on a clicked element
     * @param Object elem
     * @return string
     */
    getCurrentScore: function (elem) {
        var score_element = this.getCurrentScoreDisplayElement(elem);
        return score_element.html();
    },

    /**
     * Add points to a team score
     * @param string team_id
     * @param string points
     * @param string current_score
     * @param jQuery score_display_element
     */
    addPoints: function(team_id, points, current_score, score_display_element) {
        score_display_element.html((current_score * 1) + (points * 1));

        var period = this.timer.getPeriod();
        var time   = this.timer.getTimeFormatted();

        this.game_api.score(this.game_api_event_url, team_id, null, period, time, points, null, current_score);
    },

    /**
     * Subtract points to a team score
     * @param string team_id
     * @param string points
     * @param string current_score
     * @param jQuery score_display_element
     */
    minusPoints: function(team_id, points, current_score, score_display_element) {
        score_display_element.html((current_score * 1) - (points * 1));
    },

    /**
     * Set new team score
     * @param string team_id
     * @param string score
     * @param jQuery score_display_element
     */
    setScore: function(score, score_display_element) {
        score_display_element.html(score);
    },
};
