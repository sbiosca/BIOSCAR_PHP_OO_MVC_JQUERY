function refresh_cookies() {
    ajaxPromise('modules/login/ctrl/ctrl_login.php?op=refresh_cookies', 'POST', 'JSON')
        .then(function(result){
            console.log(result);
        }).catch(function(error){
            console.log(error);
        });
}
function regenerate_token(data) {
    console.log(data);
    setInterval(function(){
        ajaxPromise('modules/login/ctrl/ctrl_login.php?op=refresh_token', 'POST', 'JSON', data)
        .then(function(result){
            console.log(result);
            localStorage.setItem("token", result);
        }).catch(function(){
            console.log("3rro");
        });
    }, 600000); //solicitud al servidor cada 600 segundos - 10minutos (600000 milisegundos)
    refresh_cookies();
}

function protecturl() {
    setInterval(function(){
        ajaxPromise('modules/login/ctrl/ctrl_login.php?op=controluser', 'GET')
            .then(function(data){
                console.log(data);
                if(data=="type"){
                    //setTimeout(' window.location.href = "index.php?modules=modules/home/ctrl/ctrl_home&op=list"; ',1000);
                }else if (data=="!type"){
                    toastr.options = {
                        'closeButton': true,                
                    }
                    toastr.warning("DEBES REALIZAR LOGIN");
                // setTimeout('window.location.href = window.location.href;',1000);
                }
            }).catch(function(){

            });
        }, 600000);
}

function protectactivity() {
    setInterval(function(){
        ajaxPromise('modules/login/ctrl/ctrl_login.php?op=activity', 'GET')
        .then(function(data){
            console.log(data);
            if (data=="inactivo") {
                    toastr.options = {
                        'closeButton': true,                
                    }
                    toastr.error("TIEMPO DE INACTIVIDAD SUPERADO");
                //logout();
            }
        }).catch(function(){

        });
    }, 600000); //solicitud al servidor cada 600 segundos - 10minutos (600000 milisegundos)
    protecturl();
}

$(document).ready(function(){
    protectactivity();
});

