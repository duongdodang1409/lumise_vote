$(document).ready(function() {
    $('.commentComposer #exampleFormControlTextarea1').click(function () {
        $('.commentComposer').find('.form-group-bottom').toggleClass("show_form");

    });
    $('.text-post .click_reply').click(function () {
        $('.text-post').find('.form-reply').toggleClass("show_reply");

    });
    $('.click_heart').click(function () {
        $(this).toggleClass("show_heart");

    });
    $('.votepost').click(function () {
        $(this).find('.icon').toggleClass("active");
    });
});
