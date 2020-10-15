// function alert autohide
$(document).ready (function(){
    $(".alert-success").alert();
    window.setTimeout(function () { 
        $(".alert-success").alert('close'); 
    }, 2000);
    $(".alert-danger").alert();
    window.setTimeout(function () { 
        $(".alert-danger").alert('close'); 
    }, 2000);
    $(".alert-warning").alert();
    window.setTimeout(function () { 
        $(".alert-warning").alert('close'); 
    }, 2000);
    $(".alert-info").alert();
    window.setTimeout(function () { 
        $(".alert-info").alert('close'); 
    }, 2000);
    $(".alert-primary").alert();
    window.setTimeout(function () { 
        $(".alert-primary").alert('close'); 
    }, 2000);
});