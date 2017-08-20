$(document).ready(function() {
    var countdown = $('.block_countdown_timer');
    countdown.countdown(countdown.data('datetime'), function(event) {
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
