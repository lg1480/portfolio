<?php
    require "config/connexion.php";

    if(isset($_GET['id']) && is_numeric($_GET['id']))
    {
        $mode = htmlspecialchars($_GET['id']);
        $reqSecu = $bdd->prepare("SELECT * FROM categories WHERE id=?");
        $reqSecu->execute([$mode]);
        $donSecu = $reqSecu->fetch(PDO::FETCH_ASSOC);
        if(!$donSecu)
        {
            header("LOCATION:404.php");
            exit();
        }
    }else{
        $mode = "all";
    }
?>

<!doctype html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="assets/bootstrap-5.3.8-dist/css/bootstrap.min.css">
    <script src="assets/bootstrap-5.3.8-dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.1/css/all.min.css" integrity="sha512-2SwdPD6INVrV/lHTZbO2nodKhrnDdJK9/kg2XD1r9uGqPo1cUbujc+IYdlYdEErWNu69gVcYgdxlmVmzTWnetw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="build/style.css">
    <title>Louis Geiregat</title>
    <link rel="icon" type="image/x-icon" href="images/favicon.ico">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Instrument+Sans:ital,wght@0,400..700;1,400..700&display=swap');
        @import url('https://fonts.cdnfonts.com/css/lemonmilk');
        body {
            background-color: #EEE6DA; /* fond sombre — change la couleur selon ton design */
            min-height: 100vh;
            overflow-y: scroll;
        }
        .btn-category {
            border: 1px solid #262C43;
            color: #262C43;
        }

        .btn-category:hover,
        .btn-category.active {
            background-color: #262C43;
            color: white;
        }

        .btn-see-more {
            background-color: #EEE6DA;
            border: none;
            color: #262C43;
        }

        .btn-see-more:hover {
            background-color: #ffa600;
        }
        .back-btn{
            position: fixed;
            background-color: #262C43;
            color: white;
            text-decoration: none;
            margin: 10px 10px;
            padding: 12px 12px;
            border-radius: 15px;
            font-family: 'Lemon/Milk', sans-serif;
            font-family: 'Lemon/Milk light', sans-serif;

            z-index: 9999;        /* toujours au-dessus du contenu */
            transition: all 0.3s ease;
        }

        .back-btn:hover{
            background-color: #ffa600;
        }
        .container{
            display: flex;
            flex-direction: column;
            width: 95vw;
            overflow: hidden;
        }
        .container-d-flex{
            height: 300px;
            width: 90%;
            display:flex;
            align-items: center;
            justify-content:center;
            flex-direction:column;
            gap: 30px;
            font-family: 'Lemon/Milk', sans-serif;
            font-family: 'Lemon/Milk light', sans-serif;
            
        }
        .container-d-flex h1{
            color:#262C43;
            font-size: 60px;
        }
        .col{
            display: flex;
            justify-content:center;
        }
        .card {
            background-color:#262C43;
            border: none;
            border-radius: 15px;
            overflow: hidden;
            transition: transform 0.2s ease, box-shadow 0.2s ease;
            font-family: "Instrument Sans", sans-serif;
            width: 250px;
            margin-bottom: 50px;
        }
        .card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 24px rgba(0,0,0,0.4);
        }
        .card-img-top {
            width: 100%;
            height: 180px;

        }
        .card-title {
            color: #fff;
        }
    </style>
</head>
<body>
    <a href="index.php#projects" class="back-btn">
        <i class="fa-solid fa-arrow-left"></i> Back
    </a>
    <div class="container">
        <div class="container-d-flex"> 
            <h1>PROJECTS</h1> 
            <div class="d-flex flex-wrap justify-content-center gap-2">
                <a href="categories.php" class="btn <?= ($mode == 'all') ? 'btn-secondary' : 'btn-outline-secondary' ?>">All</a>
                <?php
                    $catList = $bdd->query("SELECT * FROM categories");
                    while($donCatList = $catList->fetch())
                    {
                        $isActive = ($mode == $donCatList['id']) ? 'active' : '';
                        echo "<a href='categories.php?id=".$donCatList['id']."' 
                        class='btn btn-category ".$isActive."'>".$donCatList['name']."</a>";
                    }
                    $catList->closeCursor();
                ?>
            </div>
        </div> 
        <!-- Grille de projets : 3 colonnes sur desktop, 2 sur tablette, 1 sur mobile -->
        <div class="row row-cols-ld-4">
            <?php
            if($mode == "all")
            {
                $req = $bdd->query("SELECT products.cover AS cover, products.name AS pname, categories.name AS cname, DATE_FORMAT(products.date, '%d/%m/%Y') AS mydate, products.id AS pid, categories.id AS cid FROM products INNER JOIN categories ON products.category = categories.id ORDER BY products.date DESC");
            }else{
                $req = $bdd->prepare("SELECT products.cover AS cover, products.name AS pname, categories.name AS cname, DATE_FORMAT(products.date, '%d/%m/%Y') AS mydate, products.id AS pid, categories.id AS cid FROM products INNER JOIN categories ON products.category = categories.id WHERE products.category=? ORDER BY products.date DESC");
                $req->execute([$mode]);
            }

            $count = $req->rowCount();
            if($count > 0)
            {
                while($don = $req->fetch())
                {
                    echo '<div class="col">';
                        echo '<div class="card">';
                            echo '<img src="images/mini_'.$don['cover'].'" class="card-img-top" alt="image de '.$don['pname'].'">';
                            echo '<div class="card-body d-flex flex-column align-items-center gap-3">';
                                echo '<h5 class="card-title">'.$don['pname'].'</h5>';
                                echo '<div class="d-flex justify-content-between align-items-center mt-auto">';
                                    echo '<a href="product.php?id='.$don['pid'].'" class="btn btn-see-more btn-sm">See more.</a>';
                                echo '</div>';
                            echo '</div>';
                        echo '</div>';
                    echo '</div>';
                }
            }else{
                echo "<p class='col-12 text-center text-black'>Work in progress.</p>";
            }
            $req->closeCursor();
            ?>
        </div>

    </div>
</body>
</html>