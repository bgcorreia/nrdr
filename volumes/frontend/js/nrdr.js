
$(".goBack").click(function(){
    window.history.back();
});
$(".goFirst").click(function(){
    window.history.go(-2);
});
$(".goMoreFirst").click(function(){
    window.history.go(-3);
});


var pageName = (function () {
    var page = location.pathname.substring(1);
    a = page.lastIndexOf("/");
    b = page.lastIndexOf(".");
    return page.slice(a + 1, b);
    }());
if(pageName == ''){pageName = "index";}

if($("#menu-"+pageName).hasClass("submenu")){
    $("#menu-"+pageName).parent().parent().addClass("active");
}else{
    $("#menu-"+pageName).addClass("active");
}


/* testes com versões */
$('#ver1').click(function(){
    $('body').removeClass('ver-f7');
    $('.pageInfo').removeClass('ver-ff');
    $('.pageInfo').removeClass('ver-f7');
    $('body').removeClass('ver-ff');
	$('.breadcrumb').removeClass('ver-ff');
	$('.breadcrumb').addClass('ver-f7');

});
$('#ver2').click(function(){
    $('.pageInfo').removeClass('ver-f7');
    $('.pageInfo').addClass('ver-ff');

    $('body').removeClass('ver-ff');
    $('body').addClass('ver-f7');
	
	$('.breadcrumb').removeClass('ver-f7');
	$('.breadcrumb').addClass('ver-ff');
	
});