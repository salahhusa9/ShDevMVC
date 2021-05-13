<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <link rel="stylesheet" href="assets/css/style.css">
      <link rel="preconnect" href="https://fonts.gstatic.com">
      <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300&display=swap" rel="stylesheet">
    <title>Login form</title>
</head>
<body>


    <div class="sign-up">
        <!--Left Side -->
        <div class="account-left">
            <div class="account-text">
                <h1>Let's Chat</h1>
                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit.
                    Et praesentium veritatis deserunt adipisci, placeat perferendis
                </p>
            </div>
        </div>

        <!--Right Side -->
        <div class="account-right">
            <div class="form-area">

                <form action="" method="post">
                    <div class="group">

                        <h2 class="form-heading">
                            User Login
                        </h2>

                    </div>

                    <div class="group">

                        <input type="email" name="full_email" class="control" placeholder="Enter Your Email" -value="<?php if(isset($email)) : echo $email; endif; ?>">
            
                    </div>
                    <div class="group">

                        <input type="password" name="password" class="control" placeholder="Create password..." -value="<?php if(isset($password)) : echo $password; endif; ?>">


                    </div>

                    <div class="group">
                        <input type="submit" name="login" class="btn account-btn" value="Login">

                    </div>
                    <div class="group">

                        <a href="signup.html" class="link">Create new account</a>

                    </div>
                </form>

            </div>
        </div>


    </div>
</body>
</html>