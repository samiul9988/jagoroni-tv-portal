<script>
    "use strict";
    
    $('#input-year').on('input', function() {
            updateMaxDayByYear(this);
    });

    $('#input-year').on('blur', function() {
        typeYear(this);
    });

    $('#input-days').on('input', function() {
        typeDays(this);
    });

    $('#input-hour').on('blur', function() {
        typeHours(this);
    });

    $('#input-minute').on('blur', function() {
        typeMinutes(this);
    });

    $('#input-month').on('change', function() {
        updateMaxDayByMonth(this);
    });

    $('#displayDateTimePublish, #closeDateTimePublish').on('click', function(){
        $('#displayDateTimeEdit, #displayDateTimePublish, #closeDateTimePublish').toggleClass('d-none');
    });

    function updateMaxDayByMonth(element) {
        var month = parseInt($(element).val());

        var day = parseInt($('#input-days').val());
        var year = parseInt($('#input-year').val());

        var maxDay = new Date(year, month, 0).getDate();

        if (day < 1 || day > maxDay) {
            $('#input-days').val(maxDay);
        }
    }

    function updateMaxDayByYear(element) {
        var year = parseInt($(element).val());

        var day = parseInt($('#input-days').val());
        var month = parseInt($('#input-month').val());

        var maxDay = new Date(year, month, 0).getDate();

        if (day < 1 || day > maxDay) {
            $('#input-days').val(maxDay);
        }
    }

    function typeDays(element) {
        var day = parseInt($(element).val());

        var month = parseInt($('#input-month').val());
        var year = parseInt($('#input-year').val());

        var maxDay = new Date(year, month, 0).getDate();

        if (day < 1 || day > maxDay || $(element).val().length === 0) {
            $(element).val(maxDay);
        }
    }

    function typeHours(element) {
        var hours = parseInt($(element).val());

        if ($(element).val().length === 1) {
            var hoursUpdated = '0' + hours;
        } else if (hours > 12) {
            var hoursUpdated = 12;
        } else {
            var hoursUpdated = hours;
        }

        $(element).val(hoursUpdated);
    }

    function typeMinutes(element) {
        var minutes = parseInt($(element).val());

        if ($(element).val().length === 1) {
            var minutesUpdated = '0' + minutes;
        } else if (minutes > 59) {
            var minutesUpdated = 59;
        } else {
            var minutesUpdated = minutes;
        }

        $(element).val(minutesUpdated);
    }

    function typeYear(element) {
        var year = parseInt($(element).val());

        var yearNow = new Date().getFullYear();
        var yearMax = yearNow + 5;
        var yearMin = 2000;

        if (year < yearMin || year > yearMax) {
            console.log('The year must be in the range of 2000 to the next five years ');
            $(element).val(yearNow);
        }
    }
</script>