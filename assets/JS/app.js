$(document).ready(function()
{
    $('.col-slider.signup > .alert').each(function() {
        $(this).parent().before(this);
    });
    $("#signup_change").click(function(){
        $(".slider").toggleClass("move");
        $(".login").fadeOut(function(){
            $(".signup").fadeIn();
        });
        $(".alert").hide();
        
    });
    $("#login_change").click(function(){
        $(".slider").toggleClass("move");
        $(".signup").fadeOut(function(){
            $(".login").fadeIn();
        });
        $(".alert").addClass("none");
    });    

});

window.onload = function() {
    var labels = document.getElementsByClassName("label-name");
    var inputs = document.getElementsByClassName('input-name');
    var newLabels=[];
    for (var i = 0; i < labels.length; i++) {
        var str = labels[i].innerHTML.replace(" ", "_");
        inputs[i].setAttribute("value", str);
    }
};