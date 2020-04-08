$(document).ready(function () {
    currentTimer('#timerCurrent');

    let timerArray = {};

    function timerServerInterval(element) {
        if (!document.all && !document.getElementById) {
            return;
        }
        let h = serverTime.getHours();
        let m = serverTime.getMinutes();
        let s = serverTime.getSeconds();
        serverTime.setSeconds(s + 1);
        if (h <= 9) {
            h = "0" + h;
        }
        if (m <= 9) {
            m = "0" + m;
        }
        if (s <= 9) {
            s = "0" + s;
        }
        $(element).text(h.toString() + ':' + m.toString() + ':' + s.toString());
    }


    function timestampTimer(endTimestamp, currentTimestamp, e) {
        currentTimestamp = currentTimestamp - Math.round(+new Date() / 1000) - endTimestamp;
        let id = $('#' + e);
        if (currentTimestamp < 0) {
            id.html('00:00:00');
            return false;
        }
        let diffDay = ((currentTimestamp / (3600 * 24)).toString()).split('.');
        let diffHour = ((currentTimestamp / 3600 % 24).toString()).split('.');
        let diffMin = ((currentTimestamp / 60 % 60).toString()).split('.');
        let diffSek = ((currentTimestamp % 60).toString()).split('.');
        if (parseInt(diffDay[0]) !== 0) {
            id.html(diffDay[0] + 'd ' + timerCheckLength(diffHour[0]) + ':' + timerCheckLength(diffMin[0]) + ':' + timerCheckLength(diffSek[0]));
            return true;
        }
        id.text(timerCheckLength(diffHour[0]) + ':' + timerCheckLength(diffMin[0]) + ':' + timerCheckLength(diffSek[0]));
        return true;
    }

    function timerCheckLength(str) {
        str = str.toString();
        if (str.length === 1) {
            str = '0' + str;
        }
        return str;
    }

    function timerInterval() {
        $.each(timerArray, function (key, endTime) {
            if (!timestampTimer(currentTimestamp, endTime, key)) {
                clearInterval(timerArray[key]);
            }
        });
    }

    function currentTimer(element) {
        timerServerInterval(element);
        window.setInterval(function () {
            timerServerInterval(element);
        }, 999);
    }

    $('.timerCountdown').each(function () {
        timerArray[$(this).attr('id')] = $(this).data('time');
        timerInterval();
    });
    window.setInterval(timerInterval, 999);
});
