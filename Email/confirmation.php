<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        
        <!-- Bootstrap -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.5/dist/umd/popper.min.js" integrity="sha384-Xe+8cL9oJa6tN/veChSP7q+mnSPaj5Bcu9mPX5F5xIGE0DVittaqT5lorf0EI7Vk" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.min.js" integrity="sha384-ODmDIVzN+pFdexxHEHFBQH3/9/vQ9uori45z4JjnFsRydbmQbmL5t1tQ0culUzyK" crossorigin="anonymous"></script>
        <!-- Bootstrap -->

        <!-- Font Awesome 5 -->
        <script src="https://kit.fontawesome.com/8a969bbba5.js" crossorigin="anonymous"></script>
        <!-- Font Awesome 5 -->

        <!-- Javascript -->
        
        <!-- Javascript -->

        <title>Email Activation</title>
    </head>

    <body>

        <div class="row maincontainer" style="text-align:center;margin:10px 25vw; padding:32px;border-radius:32px;box-shadow: 3px 3px 32px 5px rgba(0,0,0,0.5);">

            <div class="row">
                <h1>Welcome to TENSAI!</h1>
            </div>

            <div class="row">
                <p>An account was created using <i>%s</i> as the email.</p>
                
                <div style="background-color:rgba(185, 207, 255);color:rgba(15,31,88);">
                    <p>Please confirm your email address using the button below:</p>
                    <a style='text-decoration:none; margin: 10px 15px; padding:10px 15px; border-radius:32px; color: #fff; background-color:rgba(15,31,88);' href='localhost/TENSAI/Accounts/Confirmation/confirm.php?email=%s&role=%s&code=%s'> Confirm Email </a>
                </div>

            </div>

        </div>

    </body>

</html>