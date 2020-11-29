$(function () {
    $('.vakancy-btn').click(function () {
        $(this).find('.arrowDown').toggleClass('rotate blue');
        $(this).toggleClass('blue');
    });

    $('.vakancy-btn').blur(function () {
        $(this).find('.arrowDown').removeClass('rotate blue');
        $(this).removeClass('blue');
    });
});

$(function () {
    $('.arrow-toggle-down-btn').click(function () {
        $(this).find('.arrowDown').toggleClass('rotate');
    });

    $('.arrow-toggle-down-btn').blur(function () {
        $(this).find('.arrowDown').removeClass('rotate');
    });
});

$(function () {
    $('.nselect-1').nSelect();
    $('#no-filter').editableSelect({
        filter: false
    });
    $('.dpicker').datepicker({
        language: "ru",
        todayHighlight: true
    });
});

$(function () {
    $('.vacancy-filter-btn').click(function () {
        $('.vakancy-page-filter-block').toggleClass('vakancy-page-filter-block-dnone dblock scroll');
        $('body').toggleClass('cover');
        $(this).addClass('opacity-none');
    });
});

$(function () {
    $('.vakancy-page-filter-block__row img').click(function () {
        $('.vakancy-page-filter-block').toggleClass('vakancy-page-filter-block-dnone dblock scroll');
        $('body').toggleClass('cover');
        $('.vacancy-filter-btn').removeClass('opacity-none');
    });
});

$(function () {
    $('[data-toggle="tooltip"]').tooltip()
});

$(function () {
    $('.navigation-toggler').click(function () {
        $(this).toggleClass('change');
        $('.navigation-menu__mobile').toggleClass('navigation-menu__mobile-width');
        $('body').toggleClass('cover');
    });
});

$(function () {
    $('.vakancy-page-block__flag-img img').hover(function () {
        var el = $(this)
        el.data('orig', el.attr('src'))
        el.attr('src', el.data('img2'))
    }, function () {
        $(this).attr('src', $(this).data('orig'))
    })
});

$(function () {
    $("input:radio[name='radio-group3']").click(function () {
        $('.hide-block').hide();
        $('#' + $("input:radio[name='radio-group3']:checked").val()).show();
    });
});
