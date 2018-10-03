var timer = {
    timer_interval: 100,
    timer_elem: null,
    timer: null,

    /**
     * Initialize the timer functionality
     * @param jQuery elem
     */
    initialize: function(elem) {

        this.timer_elem = elem;

        this.displayTime();

        var self = this;

        // add listener
        this.timer_elem.find('button.btn-start-timer').click(function() {
            self.runTimer();
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

    runTimer: function () {
        this.timer = window.setTimeout('timer.timeChangeHandler()', this.timer_interval);
    },

    timeChangeHandler: function() {
        var time         = this.timer_elem.data();
        var minutes      = time.minutes * 1;
        var seconds      = time.seconds * 1;
        var milliseconds = time.milliseconds * 1;

        milliseconds -= this.timer_interval;

        if (0 == minutes && 0 == seconds && 0 >= milliseconds) {
            // when time reaches 0, stop the timer
            this.stopTimer();
            milliseconds = 0;;
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
    },

    displayTime: function() {
        var time         = this.timer_elem.data();
        var minutes      = time.minutes * 1;
        var seconds      = time.seconds * 1;
        var milliseconds = time.milliseconds * 1;

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
};
