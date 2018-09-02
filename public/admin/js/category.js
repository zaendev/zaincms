var updateOutput = function (e) {
    var list = e.length ? e : $(e.target),
        output = list.data('output');
    if (window.JSON) {
        output.val(window.JSON.stringify(list.nestable('serialize')));
    } else {
        output.val('JSON browser support required for this demo.');
    }
};
$('#nestable').nestable({
    group: 1
})
    .on('change', updateOutput);
updateOutput($('#nestable').data('output', $('#nestable-output')));

$(window).on('load', function () {
    loadDAta()
});

function loadDAta() {
    $.ajax({
        type: 'GET',
        url: $('#urlView').val(),
        success: function (data) {
            $('#viewMenu').html(data)
        }
    })
}

$(window).on('load', function () {
    loadDAtaCat()
});

var module = $('#module').val();

function loadDAtaCat() {
    $.ajax({
        type: 'GET',
        url: $('#urlViewCat').val(),
        success: function (data) {
            $('#viewCategory').html(data)
        }
    })
}

$(document).ready(function () {
    $("#saveCat").click(function () {
        $("#load").show();

        var dataString = {
            id: $("#id").val(),
            slug: $("#slug").val(),
            title: $("#title").val(),
            module: module,
            description: $("#description").val()
        };
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            type: "POST",
            url: $('#urlStoreCat').val(),
            data: dataString,
            dataType: "json",
            cache: false,
            success: function (data) {
                if ($.isEmptyObject(data.error)) {
                    if (data.type == 'add') {
                        $("#title-id").append(data.title);
                    } else if (data.type == 'edit') {
                        $('#title_show' + data.id).html(data.title);
                    }
                    $('#id').val('');
                    $('#slug').val('');
                    $('#title').val('');
                    $('#description').val('');
                    $(".show-error-msg").css('display', 'none');
                } else {
                    showErrorMsg(data.error);
                }
            }
        });
    });

    $('.dd').on('change', function () {
        var dataString = {
            data: $("#nestable-output").val(),
        };
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            type: "POST",
            url: $('#urlUpdateCat').val(),
            data: dataString,
            cache: false,
            success: function (data) {
            }, error: function (xhr, status, error) {
                // alert(error);
            }
        });
    });

    $("#saveCat").click(function () {
        var dataString = {
            data: $("#nestable-output").val(),
        };
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            type: "POST",
            url: $('#urlUpdateCat').val(),
            data: dataString,
            cache: false,
            success: function (data) {
                loadDAtaCat()
            }, error: function (xhr, status, error) {
                // alert(error);
            }
        });
    });

    $(document).on("click", ".del-button", function () {
        var x = confirm('Delete this category?');
        var id = $(this).attr('id');
        if (x) {
            $("#load").show();
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                type: "POST",
                url: $('#urlDeleteCat').val(),
                data: {
                    id: id
                },
                cache: false,
                success: function (data) {
                    $("#load").hide();
                    $("li[data-id='" + id + "']").remove();
                }, error: function (xhr, status, error) {
                    alert(error);
                }
            });
        }
    });

    $(document).on("click", ".edit-button", function () {
        $.ajax({
            type: "GET",
            url: $('#urlShowCat').val(),
            data: {"id": $(this).attr('id')},
            success: function (result) {
                $("#id").val(result.id);
                $("#slug").val(result.slug);
                $("#title").val(result.title);
                $("#description").val(result.description);
            }
        });
    });
});

function showErrorMsg(msg) {
    $(".show-error-msg").find("ul").html('');
    $(".show-error-msg").css('display', 'block');
    $.each(msg, function (key, value) {
        $(".show-error-msg").find("ul").append('<li>' + value + '</li>');
    });
}