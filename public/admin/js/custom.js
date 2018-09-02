$('#addCat').click(function () {
    $('.showCat').toggle();
});
$('#addMenu').click(function () {
    $('.showMenu').toggle();
});

$('.close-alert').click(function () {
    $('.alert-dismissible').hide();
});

$('#saveCat').click(function (e) {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    var dataString = {
        category: $("#category").val(),
        parent: $("#parentCat").val(),
        module: $("#module").val(),
    };

    jQuery.ajax({
        url: $('#urlSaveCategory').val(),
        method: 'post',
        data: dataString,

        success: function (data) {
            if ($.isEmptyObject(data.error)) {
                $('#viewCat').html(data);
                $('#saveCat').hide();
                $(".show-error-msg").css('display', 'none');
            } else {
                showErrorMsg(data.error);
            }
        }
    });
});
$('#saveMenu').click(function (e) {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    var dataString = {
        menu: $("#menu").val(),
        parent: $("#parentMenu").val(),
    };

    jQuery.ajax({
        url: $('#urlSaveMenu').val(),
        method: 'post',
        data: dataString,

        success: function (data) {
            if ($.isEmptyObject(data.error)) {
                $('#viewMenu').html(data);
                $('#saveMenu').hide();
                $(".show-error-msg").css('display', 'none');
            } else {
                showErrorMsg(data.error);
            }
        }
    });
});

function showErrorMsg(msg) {
    $(".show-error-msg").find("ul").html('');
    $(".show-error-msg").css('display', 'block');
    $.each(msg, function (key, value) {
        $(".show-error-msg").find("ul").append('<li>' + value + '</li>');
    });
}

$('#saveData').click(function () {
    $('#dataCheckedCategory').val($('.checked-category:checked').map(function () {
        return this.value;
    }).get().join(','));
    $('#dataCheckedPlugin').val($('.checked-plugin:checked').map(function () {
        return this.value;
    }).get().join(','));
});

$('#saveDataMenu').click(function () {
    $('#dataCheckedMenu').val($('.checked-menu:checked').map(function () {
        return this.value;
    }).get().join(','));
    $('#dataCheckedPlugin').val($('.checked-plugin:checked').map(function () {
        return this.value;
    }).get().join(','));
});


function uploadImage(input, id) {
    $('#box-image' + id).hide();
    if (input.files && input.files[0]) {
        var reader = new FileReader();

        reader.onload = function (e) {
            $('#ShowImage' + id).html('<img src=' + e.target.result + '>');
            $('#change-img' + id).show();
            $('#change-img1' + id).show();
            $('#updateImg' + id).attr('value', '');
        };

        reader.readAsDataURL(input.files[0]);
    }

}

function removeImage(id) {
    $('#change-img' + id).hide();
    $('#change-img1' + id).hide();
    $('#ShowImage' + id).empty();
    $('#ShowImage1' + id).remove();
    $('#box-image' + id).show();
    $('#showUpload' + id).show();
    $('#file' + id).val('');
    $('#updateImg' + id).attr('value', 0);
}


//slug
function slug(text){
    return text.toString().toLowerCase()
        .replace(/\s+/g, '-')           // Replace spaces with -
        .replace(/[^\u0100-\uFFFF\w\-]/g,'-') // Remove all non-word chars ( fix for UTF-8 chars )
        .replace(/\-\-+/g, '-')         // Replace multiple - with single -
        .replace(/^-+/, '')             // Trim - from start of text
        .replace(/-+$/, '');            // Trim - from end of text
}

$("#title").keyup(function(){
    var Text = $(this).val();
    Text = slug(Text);
    $("#slug").val(Text);
});