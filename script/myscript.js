function ajaxRequest(){
    try{
        var request =  new XMLHttpRequest();
    } catch(e1){
        try{
            request = new ActiveXObject("Msxm12.XMLHTTP");
        } catch(e2) {
            try{
                request = new ActiveXObject("Microsoft.XMLHTTP");
            } catch(e3){
                request = false;
            }
        }
    }
    return request;

} 