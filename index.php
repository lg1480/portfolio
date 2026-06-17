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
    <link href="https://fonts.cdnfonts.com/css/lemonmilk" rel="stylesheet">
    <title>Louis Geiregat</title>
    <meta
      name="description"
      content="Louis Geiregat Portfolio"
    >
    <meta name="application-name" content="Louis Geiregat">
    <meta property="og:title" content="Louis Geiregat's professional portfolio">
    <meta property="og:type" content="website">
    <meta property="og:image" content="https://louisgeiregat.be/images/logofinalenoir1.png">
    <meta property="og:image:width" content="111">
    <meta property="og:image:height" content="111">
    <meta property="og:url" content="https://www.louisgeiregat.be/">
    <meta property="og:description" content="Welcome to my portfolio. I invite you to explore my work and discover the projects that have shaped my creative journey."> 
    <meta property="og:locale" content="fr_FR">
    <meta property="og:site_name" content="Louis Geiregat">
    <link rel="icon" type="image/x-icon" href="images/favicon.ico">
</head>
<body>

    <div class="slideaccueil" id="accueil">
        <div class="bg"></div>
        <img src="images/animation.webp" id="gif">
        <?php
            include("partials/nav.php");
        ?>
    </div>
    <div class="slideaboutme" id="aboutme">
        <div class="containerdescontainers">
            <div class="container">
            <div class="rectangle1"><p>Hello ! My name is <strong>Louis</strong> , welcome to my portfolio :) <br>I was born in <strong>Belgium</strong> on October 2nd, 2003, and I live in Enghien. I’m a computer graphics student at the <strong>EPSE</strong>, currently in the second year of a three-year program. You can check out my work in the “<strong>Projects</strong>” section  below.</p> </div>
            <div class="rectangle2">
                <div class="icone">
                    <div class="iconepng">
                        <img src="images/cartedidentite.png">
                    </div>
                    <p>Louis Geiregat</p>
                </div>
                <div class="icone">
                    <div class="iconepng">
                        <img src="images/cartesetemplacements.png">
                    </div>
                    <p>Enghien - Belgium</p>
                </div>
                <div class="icone">
                    <div class="iconepng">
                        <img src="images/study.png">
                    </div>
                    <p>Computer Graphics - EPSE</p>
                </div>
            </div>
            <div class="rectangle2">
                <div class="icone">
                    <div class="iconepng">
                        <img src="images/guitare.png">
                    </div>
                    <p>Music</p>
                </div>
                <div class="icone">
                    <div class="iconepng">
                        <img src="images/avion.png">
                    </div>
                    <p>Travel</p>
                </div>
                <div class="icone">
                    <div class="iconepng">
                        <img src="images/basketball.png">
                    </div>
                    <p>basketball</p>
                </div>
            </div>
            <div class="rectangle1"><p>Ever since I was young, I’ve always felt the need to create. I started <strong>drawing</strong> and playing <strong>music</strong> at an early age, and both are still an important part of my life today. I also love <strong>traveling</strong>, discovering new places and cultures, staying active through <strong>sports</strong>, and I’m a huge <strong>basketball</strong> fan.</p></div>
            </div>
            <div class="container">
                <div class="rectangleinvisible">
                    <div id="skills">
                        <div id="skillsrect">
                            <?php
                            include("config/connexion.php");
                                $skills = $bdd->query('SELECT * FROM skills');
                                while ($skill = $skills->fetch(PDO::FETCH_ASSOC)) {
                                    echo "<div class='skills'>";
                                        echo "<img src='images/".$skill['image']."' alt='logo ".$skill['nom']."'>";
                                    echo "</div>";
                                }
                                $skills->closeCursor();
                            ?>
                        </div>
                        
                    </div>
                </div>
                <div class="rectangletel">+32 484 56 87 37 - louis.geiregat@hotmail.be</div>
                
            </div>
        </div>
        
    
    </div>
    <div class="slideprojects" id="projects">
        <div class="containerdescontainersprojects">
            <div class="containerprojects">
                <p id="allofmywork">ALL OF MY WORK</p>
                <a href="categories.php" class="btn" id="illuprojects">Click here</a>
            </div>
            <div class="containerprojects">
                <div class="rectlatest">
                    <p id="latest">LATEST PROJECTS</p>
                </div>
                <div class="galerie">
                    <?php
                        include("config/connexion.php");
                        $stmt = $bdd->query("SELECT * FROM products ORDER BY date DESC LIMIT 5");
                        $projects = $stmt->fetchAll(PDO::FETCH_ASSOC);

                        foreach ($projects as $project) : ?>
                            <div class="item">
                                <a href="product.php?id=<?= $project['id'] ?>">
                                    <img src="images/<?= htmlspecialchars($project['cover']) ?>" alt="<?= htmlspecialchars($project['name']) ?>">
                                    <div class="item-overlay">
                                        <p><?= htmlspecialchars($project['name']) ?></p>
                                    </div>
                                </a>
                            </div>
                        <?php endforeach; ?>
                </div>
            </div>
        </div>
        
            
    </div>
    </div>

    <div class="slidecontact" id="contact">
        <div class="containerdescontainerscontact">
            <div class="containercontact">
                <div class="containercontact1">
                    <h2>Want to work together?</h2>
                    <h4>Fill this form,
                        any idea is welcome.
                    </h4>
                    <p>You can also find my phone number and email-adress in the <strong>ABOUT ME</strong> section and in the <strong>footer</strong>. </p>
                </div>
                <div class="containercontact2">
                    <?php
                    if(isset($_GET['success']))
                    {
                        echo "<div class='message-success'>Votre message à bien été envoyé! Merci</div>";
                    }

                    if(isset($_GET['error']))
                    {
                        echo "<div class='message-error'>Une erreur est survenue</div>";
                    }

                    ?>
                    <form action="treatmentContact.php" method="POST">
                        <div class="containernameemail">
                            <div class="form-group">
                                <label for="nom" id="contacttitle">NAME. </label>
                                <input type="text" name="nom" id="nom">
                            </div>
                            <div class="form-group">
                                <label for="email" id="contacttitle">E-MAIL. </label>
                                <input type="email" name="email" id="email">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="message" id="contacttitle">MESSAGE. </label>
                            <textarea name="message" id="message"></textarea>
                        </div>
                        <div class="form-group">
                            <input type="submit" value="SEND">
                        </div>
                    </form>
                </div>
            </div>    
        </div>
        <footer class="footer">
            <div class="footer-container">

                <!-- Colonne gauche -->
                <div class="footer-column">
                    <a href="#accueil" class="footer-icon">
                        <img src="images/logofinaleblanc.png" alt="Logo">
                    </a>

                    <a href="#aboutme" class="footer-link">
                        ABOUT ME
                    </a>
                </div>

                <!-- Colonne centre -->
                <div class="footer-column footer-center">

                    <p class="copyright">
                        © LOUIS GEIREGAT – all rights reserved
                    </p>

                    <div class="contact-info">
                        <p>ENGHIEN, BELGIUM</p>
                        <p>LOUIS.GEIREGAT@HOTMAIL.BE</p>
                        <p>+32 484 56 87 37</p>
                        <a href="legal-notice.php" class="footer-link" id="legal-link">
                            LEGAL NOTICE
                        </a>
                    </div>

                    <a href="#projects" class="footer-link">
                        PROJECTS
                    </a>

                </div>

                <!-- Colonne droite -->
                <div class="footer-column">
                    <a href="https://www.instagram.com/louisgeiregat/" target="_blank" class="footer-icon">
                        <img src="images/instagram.png" alt="Instagram">
                    </a>

                    <a href="#contact" class="footer-link">
                        GET IN TOUCH !
                    </a>
                </div>
            </div>
        </footer>
    </div>
</body>
</html>