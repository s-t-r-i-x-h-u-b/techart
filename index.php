<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Галактический вестник</title>
    <link rel="stylesheet" type="text/css" href="styles/style.css"/>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,300..800;1,300..800&display=swap" rel="stylesheet">
</head>
<body>
    <?php include "includes/header.php" ?>
    <main>
        <div class="banner">
            <?php
                include "includes/db.php";
                $query = mysqli_query($connection, "SELECT `title`, `announce`, `image` FROM `news` ORDER BY `date` DESC LIMIT 1;");
                $result = mysqli_fetch_assoc($query);
                mysqli_close($connection);
            ?>
            <div class="banner_text">
                <h1 class="banner_title"><?php echo $result['title']; ?></h1>
                <?php echo $result['announce']; ?>
            </div>
            <img class="banner_image" src="images/<?php echo $result['image']; ?>"/>
            
        </div>
        <div class="container">
            <h1 class="container_title">Новости</h1>
            <div class="container_news">
                <?php
                    include "includes/db.php";
                    $per_page = 4;
                    $page = 1;

                    if ( isset($_GET['page']) ) {
                        $page = (int) $_GET['page'];
                    }
                    $total_count_q = mysqli_query($connection, "SELECT COUNT(`id`) AS `total_count` FROM `news`");
                    $total_count = mysqli_fetch_assoc($total_count_q);
                    $total_count = $total_count['total_count'];

                    $total_page = ceil( $total_count / $per_page = 4);

                    if ($page < 1 || $page > $total_page) {
                        $page = 1;
                    }

                    $offset = ($page - 1) * $per_page;

                    $query = mysqli_query($connection, "SELECT * FROM `news` ORDER BY `date` DESC LIMIT $offset, $per_page");
                    while ( $result = mysqli_fetch_assoc($query) ) {
                    ?>
                        <div class="news">
                            <div class="date"><?php echo date("d.m.Y", strtotime($result['date'])) ?></div>
                            <h2 class="title"><?php echo $result['title'] ?></h2>
                            <div class="announce"><?php echo $result['announce'] ?></div>
                            <a href="/news.php?id=<?php echo $result['id']?>"><button class="details">ПОДРОБНЕЕ &rarr;</button>
                        </a>
                        </div>
                    <?php }
                    mysqli_close($connection);
                ?>
            </div>
        </div>
        <div class="navigation">
                <div class="fill"></div>
                <?php
                    if ($page != 1) {?>
                        <a href="?page=<?php echo $page - 1?>"><button class="scroll">&larr;</button></a>
                    <?php } ?>
                    <?php if ($page == 1) { ?>
                        <a href="?page=<?php echo $page?>"><button class="navigation_btn current_page"><?php echo $page?></button></a>
                        <a href="?page=<?php echo $page + 1?>"><button class="navigation_btn"><?php echo $page + 1?></button></a>
                        <a href="?page=<?php echo $page + 2?>"><button class="navigation_btn"><?php echo $page + 2?></button></a>
                    <?php } else if ($page == $total_page) { ?>
                        <a href="?page=<?php echo $page - 2?>"><button class="navigation_btn"><?php echo $page - 2?></button></a>
                        <a href="?page=<?php echo $page - 1?>"><button class="navigation_btn"><?php echo $page - 1?></button></a>
                        <a href="?page=<?php echo $page?>"><button class="navigation_btn current_page"><?php echo $page?></button></a>
                    <?php } else { ?>
                         <a href="?page=<?php echo $page - 1?>"><button class="navigation_btn"><?php echo $page - 1?></button></a>
                        <a href="?page=<?php echo $page?>"><button class="navigation_btn current_page"><?php echo $page?></button></a>
                        <a href="?page=<?php echo $page + 1?>"><button class="navigation_btn"><?php echo $page + 1?></button></a>
                    <?php } ?>
                    <?php if ($page != $total_page) { ?>
                        <a href="?page=<?php echo $page + 1?>"><button class="scroll">&rarr;</button></a>
                    <?php } ?>
            </div>
    </main>
    <?php include "includes/footer.php" ?>
</body>
</html>

