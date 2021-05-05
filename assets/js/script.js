const flashData = $('.flash-data').data('alert');

if (flashData) {
    swal({
        title: "Success",
        text: flashData,
        icon: "success",
        buttons: [false, true],
    })
}