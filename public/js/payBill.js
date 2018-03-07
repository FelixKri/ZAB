$(".pay").on('click', function () {

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    }); 

    $.ajax({
        type: "POST",
        url: "/",
        data: {
            '_token': $('input[name=_token]').val(),
            'rechnungsposid': this.name,
        },
        success: function (response) {
            //response["rechnungsposid"]

            $('#' + response['rechnungsposid']).fadeOut('slow');

            //alert("Success");
        },
        error: function(response){
            alert("Error");
            console.log(response);
        }
    });
});