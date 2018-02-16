<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="public/css/reset.css">
    <link rel="stylesheet" href="public/css/bootstrap.css">
    <link rel="stylesheet" href="public/css/style.css">
    <link rel="stylesheet" href="public/css/flexslider.css">
    <script src="./public/js/jquery.min.js"></script>
    <script src="./public/js/jquery.flexslider.min.js"></script>
    <script>
        $(document).ready(function() {
            $('.flexslider').flexslider({
                animation: "slide",
                slideshow: "true",
                animationSpeed: 500
            });
        });
    </script>
    <title>crutchetzan</title>
</head>
<body>

<ul class="nav bg-light bordered-nav">
    <li class="nav-item">
        <div class="nav-link">Hello, <strong><?= $context["username"]; ?></strong></div>
    </li>
    <li class="nav-item">
        <a class="nav-link active" href="/logout">Logout</a>
    </li>
    <li class="nav-item">
        <a class="nav-link active" href="/images/settings">Settings</a>
    </li>
</ul>

<div class="flexslider-wrapper">
    <div class="flexslider">
        <ul class="slides">
        <?php $id_name = $context["id_name"]; ?>
        <?php for($i = 0; $i < count($id_name); $i++):?>
            <li>
                <div class="banner">
                    <div class="banner-label">
                        <?= ($i + 1).". "; ?>
                        <a href="images/<?= $id_name[$i]["id"]; ?>"><?=$id_name[$i]["name"]; ?></a>
                        <?= "#".$id_name[$i]["id"]; ?>
                    </div>
                    <img src="images/<?= $id_name[$i]["id"]; ?>" alt="img"> 
                </div>
            </li>
        <?php endfor; ?>
        </ul>
    </div>
</div>
</body>
</html>