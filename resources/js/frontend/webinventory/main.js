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
            characterId: characterId,
            action: action
        },
        headers: {
            'X-CSRF-TOKEN': csrf,
        },
    }).done(function (response) {
        $goldState.html(
            '<span class="text-success small">' + response.data + '</span>'
        );

        $('#inventoryGold').html(
            response.gold.formatted
        );
        $goldAmount.attr({
            'max': response.gold.nonFormatted
        });
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
        $('#inventory').html(
            response.accountInventory
        );
        $('#inventoryGold').html(
            response.accountGoldFormatted
        );
        $('#goldAmountGameWeb').attr({
            'max': response.accountGold
        });

        $characterState.text('');
        characterId = response.characterId;
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
        }
    });
    let checkMark = null;
    $('[id^=selectInventory]').on('click', function () {
        if (checkMark) {
            checkMark.attr('hidden', true);
        }
        checkMark = $(this).find('.fa-check');
        $(this).find('.fa-check').removeAttr('hidden');

        $('#selectedItem').html(
            $(this).clone()
        ).find('.fa-check').attr('hidden', true);

    });
}
