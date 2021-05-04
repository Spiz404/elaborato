
// controllo contenuto form di login 
function checkFormLogin(){
        
        var valid = true;
        var username = document.getElementById("username");
        var password = document.getElementById("psw");
        if(username.value == ""){
            valid = false;
            if(!document.getElementById("error-span")){
                username.style.border = "1px solid red";
                var span = document.createElement("span");
                var span_text = document.createTextNode("Inserire username");
                span.className = "error-span";
                span.id = "error-span";
                span.style.color = "red";
                span.style.paddingTop = "3px";
                span.appendChild(span_text);		
                document.getElementById("username-div").appendChild(span);
            }
        }

        if(password.value == ""){
            valid = false;
            if(!document.getElementById("error-span1")){
                password.style.border = "1px solid red";
                var span = document.createElement("span");
                var span_text = document.createTextNode("Inserire password");
                span.className = "error-span";
                span.id = "error-span1";
                span.style.color = "red";
                span.style.paddingTop = "3px";
                span.appendChild(span_text);		
                document.getElementById("password-div").appendChild(span);
            }
        }
        
        return valid;
}
