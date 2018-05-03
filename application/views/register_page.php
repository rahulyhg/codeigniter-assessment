<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Register Page - CodeIgniter Assessment</title>
    <!-- Import styles -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <div id="container">
        <div id="content">
            <div class="row">
                <div class="col-sm-6 text-center">
                    <div class="panel panel-primary">
                        <form method="post" action="">
                            <div class="input-field">
                                <input type="text" name="first_name" placeholder="First Name (Required)" required>
                            </div>
                            <div class="input-field">
                                <input type="text" name="last_name" placeholder="Last Name (Required)" required>
                            </div>
                            <div class="input-field">
                                <input type="text" name="username" placeholder="Username (Required)" required>
                            </div>
                            <div class="input-field">
                                <input type="email" name="email" placeholder="Email (Required)" required>
                            </div>
                            <div class="input-field">
                                <input type="password" name="password" placeholder="Password (Required)" required>
                            </div>
                            <div class="input-field">
                                <input type="text" name="phone" placeholder="Phone">
                            </div>
                            <div class="input-field">
                                <a href="<?php echo base_url('users/login');?>" class="btn btn-success">Login Page</a>
                                <input type="submit" class="btn btn-primary" name="register" value="Register">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js" type="text/javascript"></script>
</body>
</html>
