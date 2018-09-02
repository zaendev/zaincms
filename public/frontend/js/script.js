$(document).ready(function () {

    $(function () {
        $('#category').metisMenu();
        $('#category1').metisMenu();
        $('#menu1').metisMenu();
    });

    $('#openNavSearch').click(function () {
        var lebar = $('#search-nav').width();
        if (lebar == '') {
            $("#search-nav").width("100%");
        } else {
            $("#search-nav").width("0");
        }
    });
    $('#openNavCategory').click(function () {
        var lebar = $('#category-nav').width();
        if (lebar == '') {
            $("#category-nav").width("100%");
        } else {
            $("#category-nav").width("0");
        }
    });
    $('#openNavFilter').click(function () {
        var lebar = $('#filter-nav').width();
        if (lebar == '') {
            $("#filter-nav").width("100%");
        } else {
            $("#filter-nav").width("0");
        }
    });

    $('#closeNavCategory').click(function () {
        $("#category-nav").width("0");
    });
    $('#closeNavSearch').click(function () {
        $("#search-nav").width("0");
    });
    $('#closeNavFilter').click(function () {
        $("#filter-nav").width("0");
    });


    $(function () {
        $('[data-toggle="tooltip"]').tooltip()
    });

    $("#share").jsSocials({
        showLabel: false,
        showCount: false,
        shares: ["email", "twitter", "facebook", "googleplus", "pinterest", "whatsapp"]
    });

});