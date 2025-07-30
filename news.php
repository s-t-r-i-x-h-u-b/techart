<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Галактический вестник</title>
    <link rel="stylesheet" type="text/css" href="styles/style.css"/>
</head>
<body>
    <?php include "includes/header.php" ?>
    <main class="news_page">
        <?php
        include "includes/db.php";
        $query = mysqli_query($connection, "SELECT * FROM `news` WHERE `id` = " . (int) $_GET['id']);
        $result = mysqli_fetch_assoc($query);
        mysqli_close($connection);
        ?>
        <div class="panel">Главная / <span class="panel_grey"><?php echo $result['title'] ?></span></div>
        <h1 class="title_news"><?php echo $result['title'] ?></h1>
        <div class="date_news"><?php echo date("d.m.Y", strtotime($result['date'])) ?></div>
        <div class="grid_container">
            <div>
                <div class="announce_news"><?php echo $result['announce'] ?></div>
                <div class="content_news"><?php echo $result['content'] ?></div>
                <a href="/"><button class="button_news">&larr; Назад к новостям</button></a>
            </div> 
            <div class="image_news" style="
            background-position: center;
            background-size: contain;
            background-repeat: no-repeat;
            background-image: url(images/<?php echo $result['image']; ?>)">
            </div>
        </div>
    </main>
    <?php include "includes/footer.php" ?>
</body>
</html>