
;(function ($, win, doc, undefined) {
    console.log('base.js')

    var script_file = '';
    script_file += '<script src="/js/ui.global.js"></script>';
    script_file += '<script src="/js/ui.plugins.js"></script>';
    script_file += '<script src="/js/ui.common.js"></script>';
    script_file += '<script src="/js/lib/owl.carousel.js"></script>';

    $('head').append(script_file);

})(jQuery, window, document);	