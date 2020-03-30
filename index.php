<!-- Login / Register Page-->

<html>
    <head> 
        <link rel="stylesheet" href="resources/css/bootstrap.min.css" type="text/css">
        <link rel="stylesheet" href="resources/css/style.css" type="text/css">
        <link rel="stylesheet" href="resources/css/noty.css" type="text/css">
        <link rel="stylesheet" href="resources/css/sunset.css" type="text/css">
    </head>
    <body>
        <div class="container index-container">
            <div class="row index-main-row">
                <div class="col-lg-12 index-data-div">
                    <div class="row index-row">
                        <div class="col-lg-5 login-tab">
                            <h1>Login</h1>
                            <div class="form-group">
                                <input class="form-control" type="email" placeholder="Email" id="login-email">                        
                            </div>
                            <div class="form-group">                                
                                <input class="form-control" type="password" placeholder="Password" id="login-password">                                
                            </div>                   
                            <a class="btn btn-green" id="login-btn">Login</a>   
                        </div>
                        <div class="col-lg-5 register-tab">
                            <h1>Register</h1>
                            <div class="form-group">
                                <input class="form-control" type="email" placeholder="Email" id="register-email">                        
                            </div>
                            <div class="form-group">                                
                                <input class="form-control" type="password" placeholder="Password" id="register-password">                                
                            </div>
                            <div class="form-group">                                
                                <input class="form-control" type="password" placeholder="Confirm Password" id="register-password-confirm">                            
                            </div>      
                            <a class="btn btn-green" id="register-btn">Register</a>                      
                        </div>
                    </div>                    
                </div>                
            </div>
        </div>
        <script type="text/javascript" src="resources/scripts/jquery-1.9.1.min.js"></script>
        <script type="text/javascript" src="resources/scripts/bootstrap.min.js"></script>
        <script type="text/javascript" src="resources/scripts/scripts.js"></script>        
        <script type="text/javascript" src="resources/scripts/popper.min.js"></script>     
        <script type="text/javascript" src="resources/scripts/noty.js"></script>     
        <script>
            $("#login-btn").click(function(){
                var email = $("#login-email").val();
                var password = $("#login-password").val();

                if(!email || !password) {
                    genError("Please ensure all fields are populated!");
                    return false;
                }
                
                if(email.length < 5 || password.length < 10) {
                    genError("Please ensure all fields are populated, correctly!");
                    return false;
                }

                $.ajax({
                    url: 'backend/login.php',
                    type: 'POST',
                    data: {
                        email: email,
                        password: password                        
                    },
                    cache: false,
                    success: function (data) {                        
                        genSuccess(data);               
                        setTimeout(function(){
                            location.href = "dashboard.php";
                        }, 2000);
                    },
                    error: function (data) {
                        genError(data.responseText);
                    }
                });
                
            });

            $("#register-btn").click(function(){
                var email = $("#register-email").val();
                var password = $("#register-password").val();
                var confirm_password = $("#register-password-confirm").val();

                if(!email || !password || !confirm_password) {
                    genError("Please ensure all fields are populated!");
                    return false;
                }

                if(password != confirm_password) {
                    genError("Please ensure the two passwords match!");
                    return false;
                }

                var validate_password = validatePassword(password);
                if(validate_password != true) {
                    genError(validate_password);
                    return false;
                }

                var validate_email = validateEmail(email);
                if(validate_email != true) {
                    genError(validate_email);
                    return false;
                }

                $.ajax({
                    url: 'backend/register.php',
                    type: 'POST',
                    data: {
                        email: email,
                        password: password,
                        confirm_password: confirm_password
                    },
                    cache: false,
                    success: function (data) {                        
                        genSuccess(data);               
                    },
                    error: function (data) {
                        genError(data.responseText);
                    }
                });
                
            });
        </script>   
    </body>
</html>