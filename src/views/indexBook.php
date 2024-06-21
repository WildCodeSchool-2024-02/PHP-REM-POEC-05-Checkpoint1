<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="css/main.css">
    <link rel="stylesheet" href="css/book.css">
    <title>Checkpoint PHP 1</title>
</head>
<body>

<?php include 'header.php'; ?>

<main class="container">

    <section class="desktop">
        
        <img src="image/whisky.png" alt="a whisky glass" class="whisky"/>
        <img src="image/empty_whisky.png" alt="an empty whisky glass" class="empty-whisky"/>

        <div class="pages">
            <div class="page leftpage">
             <a class="" href="/add">Ajouter une personne</a> 
            
            </div>

            <div class="page rightpage">

            <?php if (isset($books)) : ?> 

                <table>
                <tbody>


                <?php foreach($books as $book) :?>

                    <tr>
                    <td><?= $book["name"] ?></td>
                    <td><?= $book["payment"] ?></td>
                    </tr>

                <?php endforeach; ?>
                
                </tbody>
                <tr>
                    <td></td>
                    <td>
                        Total : <?= $total_payment ?>
                    </td>
                </tr>
                
                </table>


            <?php endif ?>

            </div>
        </div>
        <img src="image/inkpen.png" alt="an ink pen" class="inkpen"/>
    </section>
</main>
</body>
</html>
