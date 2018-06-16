$(document).ready(function() {
    var countdown = $('.block-countdown-timer');
    var time = Date.UTC(
        countdown.data('year'),
        countdown.data('month') - 1,
        countdown.data('day'),
        countdown.data('hour'),
        countdown.data('minute')
    );
    var offset = (new Date().getTimezoneOffset() * 60) * 1000;
    var date = new Date(time + offset);
    countdown.countdown(date, function(event) {
        $(this).html(
            event.strftime(
                '<span class="countdown-days">%-D</span> <span class="countdown-daystext">' +
                countdown.data('daystext') + '</span> ' +
                '<span class="countdown-hours">%H</span><span class="countdown-devider">:</span>' +
                '<span class="countdown-minutes">%M</span><span class="countdown-devider">:</span>' +
                '<span class="countdown-seconds">%S</span>'
            )
        );
    });
});
