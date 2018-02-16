<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="public/css/reset.css">
    <link rel="stylesheet" href="public/css/bootstrap.css">
    <link rel="stylesheet" href="public/css/style.css">
    <title>sign in</title>
</head>
<body>
    <div class="fluid-container">
        <div class="row">
            <form class="col-md-4 offset-4" id="login-form" action="/signin" method="POST" role="form">
                <legend>Sign In</legend>
                <div class="form-group">
                    <label for="login">Username:</label>
                    <input type="text" name="username" class="form-control" id="username" placeholder="Your name:">
                </div>
                <div class="form-group">
                    <label for="pwd">Password:</label>
                    <input type="password" name="password" class="form-control" id="pwd" placeholder="Your password">
                </div>
                <button type="submit" class="btn btn-primary">Sign in</button>
                <a href="/signup">sign up</a>
            </form>
        </div>
        
        <?php if ($context["problems"] != []): ?>
        <div class="row">
            <div class="col-md-4 offset-4 card-holder card">
                <div class="card-header bg-danger">
                    You have some problems:
                </div>
                <div class="card-body">
                    <ul class="list-group">
                        <?php foreach($context["problems"] as $problem): ?>
                        <li class="list-group-item list-group-item-danger"><?= $problem; ?></li>
                        <?php endforeach; ?>
                    </ul>
                </div>
            </div>
        </div>
        <?php endif; ?>

    </div>
</body>
</html>