var timer = {
    timer_interval: 100,
    timer_elem: null,
    timer: null,
    game_api: null,
    game_api_time_url: null,
    is_running: false,

    /**
     * Initialize the timer functionality
     * @param jQuery elem
     */
    initialize: function(elem, game_api, game_api_time_url) {

        this.timer_elem = elem;
        this.game_api = game_api;
        this.game_api_time_url = game_api_time_url;

        this.displayTime();

        var self = this;

        // add listener
        this.timer_elem.find('button.btn-start-timer').click(function() {
            self.startTimer();
        });
        this.timer_elem.find('button.btn-stop-timer').click(function() {
            self.stopTimer();
        });
        this.timer_elem.find('button.btn-set-timer').click(function() {
            this.timer_elem.data(
                {
                    minutes      : minutes,
                    seconds      : seconds,
                    milliseconds : milliseconds,
                }
            );
        });
    },

    startTimer: function() {
        if (!this.is_running) {
            this.runTimer();
            this.game_api.time(this.game_api_time_url, 'start', this.getPeriod(), this.getTimeFormatted());
        }
    },

    runTimer: function () {
        this.timer = window.setTimeout('timer.timeChangeHandler()', this.timer_interval);
        this.is_running = true;
    },

    timeChangeHandler: function() {

        var time = this.getTimeArray(); 
        var minutes = time.minutes;
        var seconds = time.seconds;
        var milliseconds = time.milliseconds;

        milliseconds -= this.timer_interval;

        if (0 == minutes && 0 == seconds && 0 >= milliseconds) {
            // when time reaches 0, stop the timer
            this.stopTimer();
            milliseconds = 0;
        } else {
            if (0 > milliseconds) {
                milliseconds = 1000 - this.timer_interval;
                seconds -= 1;
            }

            if (0 > seconds) {
                seconds = 59;
                minutes -= 1;
            }

            if (0 > minutes) {
                minutes = 0;
            }
            // run the timer again
            this.runTimer();
        }

        this.timer_elem.data(
            {
                minutes      : minutes,
                seconds      : seconds,
                milliseconds : milliseconds,
            }
        );
        this.displayTime();
    },

    stopTimer: function() {
        window.clearTimeout(this.timer);
        this.game_api.time(this.game_api_time_url, 'stop', this.getPeriod(), this.getTimeFormatted());
        this.is_running = false;
    },

    displayTime: function() {

        var time = this.getTimeArray(); 
        var minutes = time.minutes;
        var seconds = time.seconds;
        var milliseconds = time.milliseconds;

        if (minutes <= 0) {
            var display = (
                (seconds < 10 ? ("0" + seconds) : ("" + seconds)) +
                "." +
                (milliseconds / this.timer_interval)
            ); 
        } else {
            var display = (
                (minutes < 10 ? ("0" + minutes) : ("" + minutes)) +
                ":" +
                (seconds < 10 ? ("0" + seconds) : ("" + seconds))
            );
        } 

        this.timer_elem.find('span.span-game-timer').html(display);
    },

    getTimeArray: function() {
        var time = this.timer_elem.data();
        
        return {
            minutes : time.minutes * 1,
            seconds : time.seconds * 1,
            milliseconds : time.milliseconds * 1
        }
    },

    getTimeFormatted: function() {
        var time = this.getTimeArray(); 
        var minutes = time.minutes;
        var seconds = time.seconds;
        var milliseconds = time.milliseconds;
        var string = "";

        if (minutes < 10) {
            string += "0";
        }

        string += minutes + ":";

        if (seconds < 10) {
            string += "0";
        }

        string += seconds + ":";

        if (milliseconds < 10) {
            string += "00";
        } else if (milliseconds < 100) {
            string += "0";
        }

        string += milliseconds;

        return string;
    },

    getPeriod: function() {
        var time = this.timer_elem.data();
        
        return time.period * 1;
    },

    isRunning: function() {
        return this.is_running;
    }
};
