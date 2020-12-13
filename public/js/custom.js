toastr.options = {
    "closeButton": true,
    "debug": false,
    "newestOnTop": true,
    "progressBar": true,
    "positionClass": "toast-top-right",
    "preventDuplicates": true,
    "onclick": null,
    "showDuration": "300",
    "hideDuration": "1000",
    "timeOut": "5000",
    "extendedTimeOut": "0",
    "showEasing": "swing",
    "hideEasing": "linear",
    "showMethod": "fadeIn",
    "hideMethod": "fadeOut"
}

/**
 * Select2 Tags
 */
$('.select2').select2({
    dropdownAutoWidth: true,
    width: '100%',
    allowClear: true,
    minimumInputLength: 1,
});

$('.select2tags').select2({
    dropdownAutoWidth: true,
    width: '100%',
    allowClear: true,
    minimumInputLength: 1,
    tokenSeparators: [',', ' '],
    tags: true
});

$('.select2all').select2({
    dropdownAutoWidth: true,
    width: '100%',
    allowClear: true,
    minimumInputLength: 0,
});
