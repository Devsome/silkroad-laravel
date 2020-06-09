function updateGold($value, $btn, action, state, route, csrf) {
    let oldText = $btn.html();
    $btn.html(
        '<i class="fas fa-spin fa-circle-notch"></i>'
    );
    let $goldAmount = $value;
    let $goldState = state;

    $.post({
        url: route,
        data: {
            _token: csrf,
            amount: $goldAmount.val(),
            characterId: $('#selectedCharacter').val(),
            action: action
        },
        headers: {
            'X-CSRF-TOKEN': csrf,
        },
    }).done(function (response) {
        $goldState.html(
            '<span class="text-success small">' + response.data + '</span>'
        );
        $goldAmount.attr({
            'max': response.gold.nonFormatted
        });
        $('#inventoryGoldGame').html(
            response.gold.formatted
        );
        $('#inventoryGoldWeb').html(
            response.goldWeb.formatted
        );
        $goldAmount.val('');
    }).error(function (error) {
        const errors = error.responseJSON;
        let errorsHtml = '<div class="fade show text-danger small" role="alert"><ul class="list-unstyled">';
        $.each(errors.error, function (k, v) {
            errorsHtml += '<li>' + v + '</li>';
        });
        errorsHtml += '</ul></di>';
        $goldState.html(errorsHtml);
    }).always(function () {
        $btn.html(
            oldText
        );
    });
}

function selectCharacterWebInventory($btn, route, csrf) {
    let oldText = $btn.html();
    $btn.html(
        '<i class="fas fa-spin fa-circle-notch"></i>'
    );
    let $characterState = $('#selectedCharacterState');

    $.get({
        url: route,
        data: {
            _token: csrf,
            characterId: $('#selectedCharacter').val()
        },
        headers: {
            'X-CSRF-TOKEN': csrf,
        },
    }).done(function (response) {
        $('#buttonGoldAmountGameWeb').removeAttr('disabled');
        $('#buttonGoldAmountWebGame').removeAttr('disabled');
        $('#gameInventory').html(
            response.accountInventory
        );
        $('#webInventory').html(
            response.accountWebInventory
        );
        $('#inventoryGoldGame').html(
            response.accountGoldFormatted
        );
        $('#goldAmountGameWeb').attr({
            'max': response.accountGold
        });

        $characterState.text('');
        itemInfo();
    }).error(function (error) {
        $characterState.text(
            JSON.parse(error.responseText).error
        ).addClass('text-danger');
    }).always(function () {
        $('.inventorySpinner').attr('hidden', 'hidden');
        $btn.html(
            oldText
        );
    });
}

function itemInfo() {
    $(document).tooltip({
        items: "[data-itemInfo], [title]",
        position: {my: "left+5 center", at: "right center"},
        content: function () {
            let element = jQuery(this);
            if (jQuery(this).prop("tagName").toUpperCase() === 'IFRAME') {
                return;
            }
            if (element.is("[data-itemInfo]")) {
                if (element.parent().parent().find('.itemInfo').html() === '') {
                    return;
                }
                return element.parent().parent().find('.itemInfo').html();
            }
            if (element.is("[title]")) {
                return element.attr("title");
            }
        },
        close: function (event, ui) {
            $(".ui-helper-hidden-accessible").remove();
        }
    });
    let checkMarkGame = null;
    $('#gameInventory [id^=selectInventory]').on('click', function () {
        if (checkMarkGame) {
            checkMarkGame.attr('hidden', true);
        }
        checkMarkGame = $(this).find('.fa-check');
        $(this).find('.fa-check').removeAttr('hidden');

        $('#selectedItemGame').html(
            $(this).clone()
        ).find('.fa-check').attr('hidden', true);
        $('#buttonTransferItemToWeb').removeAttr('disabled');
    });

    let checkMarkWeb = null;
    $('#webInventory [id^=selectInventory]').on('click', function () {
        if (checkMarkWeb) {
            checkMarkWeb.attr('hidden', true);
        }
        checkMarkWeb = $(this).find('.fa-check');
        $(this).find('.fa-check').removeAttr('hidden');

        $('#selectedItemWeb').html(
            $(this).clone()
        ).find('.fa-check').attr('hidden', true);
        $('#buttonTransferItemToGame').removeAttr('disabled');
    });
}

function transferItemToWeb($btn, serial64, route, csrf) {
    let oldText = $btn.html();
    $btn.html(
        '<i class="fas fa-spin fa-circle-notch"></i>'
    );
    let itemSerial = $('#gameInventory *[data-serial64="' + serial64 + '"]');

    $.post({
        url: route,
        data: {
            _token: csrf,
            serial64: serial64,
            characterId: $('#selectedCharacter').val(),
        },
        headers: {
            'X-CSRF-TOKEN': csrf,
        },
    }).done(function (response) {
        $('#transferItemStateGame').html(
            '<span class="text-success small">' + response.data + '</span>'
        );
        let nItem = $("#webInventory").find("[class^='col']").append(
            itemSerial.clone()
        );
        nItem.find('.fa-check').attr('hidden', true);
        itemSerial.remove();
        $('#selectedItemGame').html('<div class="empty-slot"><div class="itemslot">' +
            '<div class="image"> </div> </div> <div class="itemInfo"></div></div>');
    }).error(function (error) {
        const errors = error.responseJSON;
        let errorsHtml = '<div class="fade show text-danger small" role="alert"><ul class="list-unstyled">';
        $.each(errors.error, function (k, v) {
            errorsHtml += '<li>' + v + '</li>';
        });
        errorsHtml += '</ul></di>';
        $('#transferItemStateGame').html(errorsHtml);
    }).always(function () {
        $btn.html(
            oldText
        );
    });
}

function transferItemToGame($btn, serial64, route, csrf) {
    let oldText = $btn.html();
    $btn.html(
        '<i class="fas fa-spin fa-circle-notch"></i>'
    );
    let itemSerial = $('#webInventory *[data-serial64="' + serial64 + '"]');

    $.post({
        url: route,
        data: {
            _token: csrf,
            serial64: serial64,
            characterId: $('#selectedCharacter').val(),
        },
        headers: {
            'X-CSRF-TOKEN': csrf,
        },
    }).done(function (response) {
        $('#transferItemStateWeb').html(
            '<span class="text-success small">' + response.data + '</span>'
        );
        let nItem = $("#gameInventory").find("[class^='col']").append(
            itemSerial.clone()
        );
        nItem.find('.fa-check').attr('hidden', true);
        itemSerial.remove();
        $('#selectedItemWeb').html('<div class="empty-slot"><div class="itemslot">' +
            '<div class="image"> </div> </div> <div class="itemInfo"></div></div>');
    }).error(function (error) {
        const errors = error.responseJSON;
        let errorsHtml = '<div class="fade show text-danger small" role="alert"><ul class="list-unstyled">';
        $.each(errors.error, function (k, v) {
            errorsHtml += '<li>' + v + '</li>';
        });
        errorsHtml += '</ul></di>';
        $('#transferItemStateWeb').html(errorsHtml);
    }).always(function () {
        $btn.html(
            oldText
        );
    });
}
