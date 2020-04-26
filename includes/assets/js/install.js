$('a.iamagree').on('click', function(){
    $(this).toggleClass('active');
    $('a.nextstep').attr('href', '/manager/install/setup.php?step=two').toggleClass('active');
    $('span.nextstepLayer').addClass('allowed');
});