<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update checkpoint1</title>
</head>

<body>
    <!-- échapement php dans HTML ;) -->
    <?php if (isset($errors)) : ?> 
        <?php foreach($errors as $error) :?>
           <p><?= $error ?></p>
            <?php endforeach; ?>
    <?php endif ?>
<h1>Mise a jour </h1>
    <form action="" method="post">
        <input type="hidden" name="id" value=" <?php echo $checkpoint1['id']; ?>">
        <label for="title">Titre</label>
        <input type="text" id="title" name="title" value="<?php echo $checkpoint1['title']; ?>">
        <label for="description">Description</label>
        <input type="text" id="description" name="description" value="<?php echo $checkpoint1['description']; ?>">
        <input type="submit" value="Enregistrer">
    </form>


</body>

</html>