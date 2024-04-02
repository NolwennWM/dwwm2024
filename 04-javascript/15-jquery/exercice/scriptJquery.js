"use strict";
let idInterval;
$(document).ready(function () {
    $('#slider ul li:nth-child(odd)').css("background", "#aaa")
    $('#checkbox').change(function () {
        if($(this)[0].checked){
            idInterval = setInterval(moveRight, 1500);
        }else{
            clearInterval(idInterval)
        }
        
    });

    let slideCount = $('#slider ul li').length;
    let slideWidth = $('#slider ul li').width();
    let slideHeight = $('#slider ul li').height();
    let sliderUlWidth = slideCount * slideWidth;

    $('#slider').css({
        width: slideWidth,
        height: slideHeight
    });

    $('#slider ul').css({
        width: sliderUlWidth,
        marginLeft: -slideWidth
    });

    $('#slider ul li:last-child').prependTo('#slider ul');

    function moveLeft() {
        $('#slider ul').animate({
            left: +slideWidth
        }, 200, function () {
            $('#slider ul li:last-child').prependTo('#slider ul');
            $('#slider ul').css('left', '');
        });
    };

    function moveRight() {
        $('#slider ul').animate({
            left: -slideWidth
        }, 200, function () {
            $('#slider ul li:first-child').appendTo('#slider ul');
            $('#slider ul').css('left', '');
        });
    };

    $('a.control_prev').click(moveLeft);

    $('a.control_next').click(moveRight);

});