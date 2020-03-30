function genError(text) {
    new Noty({
        theme: "sunset",
        text: text,
        type: "error",
        layout: "topCenter",
        timeout: 3000
    }).show();;
}

function genSuccess(text) {
    new Noty({
        theme: "sunset",
        text: text,
        type: "success",
        layout: "topCenter",
        timeout: 3000
    }).show();;
}

function validatePassword(string) {
    var specialChars = "/[!@#$%^&*()_+\-=\[\]{};':\"\\|,.<>\/?]+/";
    var numbers = "0123456789";

    if(string.length < 5 || string.length > 125) {
        return result = "Please ensure your password is no more than 100 characters, and a minimum of 10!";
    }

    var specials_included = false;
    for(i = 0; i < string.length;i++){
        if(string.indexOf(specialChars[i]) > -1){
            specials_included = true;
            break;
         }
    }

    var numbers_included = false;
    for(i = 0; i < string.length;i++){
        if(string.indexOf(numbers[i]) > -1){
            numbers_included = true;
            break;
         }
    }

    if(!specials_included) {
        return result = "Please ensure your password contains at least one special character!"
    }

    if(!numbers_included) {
        return result = "Please ensure your password contains at least one number!"
    }

    return true;
}

function validateEmail(string) {
    var specialChars = "@.";

    if(string.length < 5 || string.length > 125) {
        return result = "Please ensure your email is no more than 125 characters, and a minimum of 5!";
    }

    if(string.indexOf("@") < 0 || string.indexOf(".") < 0) {
        return result = "Please ensure your email is valid!";
    }

    return true;
}