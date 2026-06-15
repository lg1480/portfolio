<?php
    if(isset($_GET['id']) && is_numeric($_GET['id']))
    {
        $id = htmlspecialchars($_GET['id']);
    }
    else{
        header("LOCATION:404.php");
        exit();
    }

    require "config/connexion.php";

    $req = $bdd->prepare("SELECT * FROM products WHERE id=?");
    $req->execute([$id]);
    $don = $req->fetch();

    if(!$don)
    {
        header("LOCATION:404.php");
        exit();
    }
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/bootstrap-5.3.8-dist/css/bootstrap.min.css">
    <script src="assets/bootstrap-5.3.8-dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.1/css/all.min.css" integrity="sha512-2SwdPD6INVrV/lHTZbO2nodKhrnDdJK9/kg2XD1r9uGqPo1cUbujc+IYdlYdEErWNu69gVcYgdxlmVmzTWnetw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="build/style.css">
    <title>BI2 - Stock - <?= $don['name'] ?></title>
    <link rel="icon" type="image/x-icon" href="images/favicon.ico">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Instrument+Sans:ital,wght@0,400..700;1,400..700&display=swap');
        @import url('https://fonts.cdnfonts.com/css/lemonmilk');

        * { box-sizing: border-box; }

        .back-btn {
            position: fixed;
            background-color: #262C43;
            color: white;
            text-decoration: none;
            margin: 10px 10px;
            padding: 12px 12px;
            border-radius: 15px;
            font-family: 'Lemon/Milk light', sans-serif;
            z-index: 9999;
            transition: all 0.3s ease;
            border: none;
            cursor: pointer;
        }
        .back-btn:hover {
            background-color: #ffa600;
        }

        body {
            background-color: #EEE6DA;
            font-family: "Instrument Sans", sans-serif;
            margin: 0;
        }

        .page-wrapper {
            width: 100%;
            max-width: 1200px;
            margin: 0 auto;
            min-height: 100vh;
            padding: 60px 24px;
            display: flex;
            align-items: center;
        }

        .product-grid {
            display: flex;
            gap: 48px;
            align-items: center;
            justify-content: center;
            width: 100%;
        }

        .product-cover {
            flex: 1 1 45%;
            min-width: 0;
            display: flex;
            align-items: center;
        }
        .product-cover img {
            width: 100%;
            height: auto;
            display: block;
            border-radius: 8px;
        }
        .product-info {
            flex: 1 1 45%;
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 20px;
        }

        h1 {
            font-family: 'Lemon/Milk light', sans-serif;
            font-size: clamp(1.8rem, 4vw, 3rem);
            text-align: center;
            margin: 0;
        }
        h4 {
            font-family: "Instrument Sans", sans-serif;
            margin-bottom: 50px;
            color: #555;
        }
        .product-description {
            text-align: justify;
            width: 100%;
            word-break: break-word;
            overflow-wrap: break-word;
        }

        /* Gallery */
        .gallery-section {
            width: 100%;
            height: 450px;
            user-select: none;
            margin-top: 10px;
        }
        .drag-carousel {
            position: relative;
            overflow: hidden;
            border-radius: 8px;
            cursor: grab;
        }
        .drag-carousel.dragging { cursor: grabbing; }
        .drag-track {
            display: flex;
            transition: transform 0.35s cubic-bezier(0.25, 0.46, 0.45, 0.94);
        }
        .drag-track.no-transition { transition: none; }
        .drag-slide {
            min-width: 100%;
            aspect-ratio: 4/3;
        }
        .drag-slide img {
            width: 100%;
            height: 100%;
            object-fit: contain;
            display: block;
            pointer-events: none;
        }
        .drag-dots {
            display: flex;
            justify-content: center;
            align-items: center;
            gap: 6px;
            margin-top: 14px;
        }
        .drag-dot {
            background: #262C43;
            border-radius: 50%;
            transition: width 0.3s ease, height 0.3s ease, opacity 0.3s ease;
            opacity: 0.25;
            width: 7px;
            height: 7px;
        }
        .drag-dot.active {
            opacity: 1;
            width: 11px;
            height: 11px;
        }

        @media (max-width: 768px) {
            .product-grid {
                flex-direction: column;
            }
            .product-cover, .product-info {
                flex: 1 1 100%;
            }
        }
    </style>
</head>
<body>
    <button onclick="window.history.length > 1 ? history.back() : window.location.href='index.php';" class="back-btn">
        <i class="fa-solid fa-arrow-left"></i> back
    </button>

    <div class="page-wrapper">
        <div class="product-grid">
            <div class="product-cover">
                <?php if(!empty($don['video_url'])): ?>
                    <iframe
                        src="<?= htmlspecialchars($don['video_url']) ?>"
                        style="width:100%; aspect-ratio:16/9; border-radius:8px; display:block;"
                        frameborder="0"
                        allowfullscreen>
                    </iframe>
                <?php else: ?>
                    <img src="images/<?= $don['cover'] ?>" alt="image de <?= $don['name'] ?>">
                <?php endif; ?>
            </div>
            <div class="product-info">
                <h1><?= $don['name'] ?></h1>
                <h4><?= $don['date'] ?></h4>
                <div class="product-description"><?= $don['description'] ?></div>
                <?php
                $galerie = $bdd->prepare("SELECT * FROM images WHERE id_product=?");
                $galerie->execute([$id]);
                $count = $galerie->rowCount();
                if($count > 0):
                    $allImages = $galerie->fetchAll();
                ?>
                <div class="gallery-section">
                    <div class="drag-carousel" id="dragCarousel">
                        <div class="drag-track" id="dragTrack">
                            <?php foreach($allImages as $img): ?>
                            <div class="drag-slide">
                                <img src="images/<?= htmlspecialchars($img['fichier']) ?>" alt="Image de <?= htmlspecialchars($don['name']) ?>">
                            </div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                    <div class="drag-dots" id="dragDots">
                        <?php foreach($allImages as $i => $img): ?>
                        <div class="drag-dot <?= $i === 0 ? 'active' : '' ?>"></div>
                        <?php endforeach; ?>
                    </div>
                </div>

                <script>
                (function() {
                    const carousel = document.getElementById('dragCarousel');
                    const track    = document.getElementById('dragTrack');
                    const dots     = document.querySelectorAll('#dragDots .drag-dot');
                    const total    = dots.length;
                    let current = 0, startX = 0, isDragging = false, dragDelta = 0;

                    function goTo(index) {
                        current = Math.max(0, Math.min(index, total - 1));
                        track.classList.remove('no-transition');
                        track.style.transform = `translateX(-${current * 100}%)`;
                        dots.forEach((d, i) => d.classList.toggle('active', i === current));
                    }
                    carousel.addEventListener('mousedown', e => {
                        isDragging = true; startX = e.clientX; dragDelta = 0;
                        carousel.classList.add('dragging');
                        track.classList.add('no-transition');
                    });
                    window.addEventListener('mousemove', e => {
                        if (!isDragging) return;
                        dragDelta = e.clientX - startX;
                        track.style.transform = `translateX(${-current * carousel.offsetWidth + dragDelta}px)`;
                    });
                    window.addEventListener('mouseup', () => {
                        if (!isDragging) return;
                        isDragging = false;
                        carousel.classList.remove('dragging');
                        if (dragDelta < -60) goTo(current + 1);
                        else if (dragDelta > 60) goTo(current - 1);
                        else goTo(current);
                    });
                    carousel.addEventListener('touchstart', e => {
                        startX = e.touches[0].clientX; dragDelta = 0;
                        track.classList.add('no-transition');
                    }, { passive: true });
                    carousel.addEventListener('touchmove', e => {
                        dragDelta = e.touches[0].clientX - startX;
                        track.style.transform = `translateX(${-current * carousel.offsetWidth + dragDelta}px)`;
                    }, { passive: true });
                    carousel.addEventListener('touchend', () => {
                        if (dragDelta < -60) goTo(current + 1);
                        else if (dragDelta > 60) goTo(current - 1);
                        else goTo(current);
                    });
                })();
                </script>
                <?php endif; $galerie->closeCursor(); ?>
            </div>
        </div>
    </div>
</body>
</html>