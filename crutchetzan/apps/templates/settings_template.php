<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="../public/css/reset.css">
    <link rel="stylesheet" href="../public/css/bootstrap.css">
    <link rel="stylesheet" href="../public/css/style.css">
    <title>settings</title>
</head>
<body>

<div class="fluid-container">
<table class="table table-striped table-bordered">
    <thead class="bg-info">
        <tr>
            <th scope="col">#</th>
            <th scope="col">position</th>
            <th scope="col">name</th>
            <th scope="col">url</th>
            <th scope="col"></th>
            <th scope="col"></th>
            <th scope="col"></th>
        </tr>
    </thead>
    <tbody>
    <?php $id_name = $context["id_name"]; ?>
    <?php for($i = 0; $i < count($id_name); $i++):?>
    <tr>
        <td><?= $id_name[$i]["id"]; ?></th>
        <td><?= $i+1; ?></td>
        <td><?= $id_name[$i]["name"]; ?></td>
        <td><a href="<?= "/images/{$id_name[$i]["id"]}"?>"><?= "/images/{$id_name[$i]["id"]}"?></a></td>
        <td><a href="<?= "/images/{$id_name[$i]["id"]}"?>/delete" class="btn btn-outline-danger table-button">DELETE</a></td>
        <td><a href="<?= "/images/{$id_name[$i]["id"]}"?>/moveup" class="btn btn-outline-primary table-button">UP</a></td>
        <td><a href="<?= "/images/{$id_name[$i]["id"]}"?>/movedown" class="btn btn-outline-primary table-button">DOWN</a></td>
    </tr>
    <?php endfor; ?>
    <tr>
        <form action="/images/add" enctype="multipart/form-data" method="POST">
            <td>
            <input class="inputfile" name="user_picture" id="file" type="file">
                <label class="btn btn-outline-primary table-button" for="file">Choose a file</label>
            </td>
            <td>
                <input type="text" name="name" class="form-control" placeholder="name">
            </td>
            <td><input class="btn btn-outline-primary table-button" type="submit" value="Send File"></td>

        </form>
    </tr>
  </tbody>
</table>
</div>


</body>
</html>