<style>
@import url('https://fonts.cdnfonts.com/css/lemonmilk');
nav {
    font-family: 'Lemon/Milk', sans-serif;
    font-family: 'Lemon/Milk light', sans-serif;
    width: 100%;
    font-size: large;
}
.custom-gap{
    gap: 6rem;
}
.nav-linkaboutmeprojects{
    background-color: #EEE6DA;
    color: #262C43;
    padding: 0.6rem 1.2rem;
    border-radius: 30px;
    transition: 0.3s ease;
}
.nav-linkaboutmeprojects:hover{
    background-color: #262C43;
    color: #EEE6DA !important;
}
.nav-linkcontact{
    background-color: #262C43;
    color: #EEE6DA;
    padding: 0.6rem 1.2rem;
    border-radius: 30px;
    transition: 0.3s ease;
}
.nav-linkcontact:hover{
    background-color: #EEE6DA;
    color: #262C43 !important;
}
.nav-linkaboutmeprojects,
.nav-linkcontact{
    text-decoration: none;
}

/* Burger button */
.burger-btn {
    display: none;
    flex-direction: column;
    justify-content: center;
    align-items: center;
    width: 48px;
    height: 48px;
    background: none;
    border: none;
    cursor: pointer;
    gap: 6px;
    z-index: 10001;
    position: fixed;
    top: 14px;
    right: 16px;
}
.burger-btn .bar {
    display: block;
    width: 26px;
    height: 2.5px;
    background: #262C43;
    border-radius: 2px;
    transition: transform 0.35s ease, opacity 0.25s ease;
    transform-origin: center;
}
.burger-btn.open .bar:nth-child(1) {
    transform: translateY(8.5px) rotate(45deg);
}
.burger-btn.open .bar:nth-child(2) {
    opacity: 0;
    transform: scaleX(0);
}
.burger-btn.open .bar:nth-child(3) {
    transform: translateY(-8.5px) rotate(-45deg);
}

/* Drawer */
.burger-drawer {
    position: fixed;
    top: 0;
    right: 0;
    width: 75%;
    max-width: 360px;
    height: 100%;
    background: #EEE6DA;
    z-index: 10000;
    transform: translateX(100%);
    transition: transform 0.4s cubic-bezier(0.4, 0, 0.2, 1);
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    gap: 2.5rem;
}
.burger-drawer.open {
    transform: translateX(0);
}
.burger-drawer a {
    font-family: 'Lemon/Milk', sans-serif;
    font-family: 'Lemon/Milk light', sans-serif;
    text-decoration: none;
    font-size: 1.1rem;
    letter-spacing: 0.05em;
}
.burger-drawer .drawer-linkaboutme,
.burger-drawer .drawer-linkprojects {
    background-color: #EEE6DA;
    color: #262C43;
    padding: 0.6rem 1.4rem;
    border-radius: 30px;
    transition: background-color 0.3s ease, color 0.3s ease;
}
.burger-drawer .drawer-linkaboutme:hover,
.burger-drawer .drawer-linkprojects:hover {
    background-color: #262C43;
    color: #EEE6DA;
}
.burger-drawer .drawer-linkcontact {
    background-color: #262C43;
    color: #EEE6DA;
    padding: 0.6rem 1.4rem;
    border-radius: 30px;
    transition: background-color 0.3s ease, color 0.3s ease;
}
.burger-drawer .drawer-linkcontact:hover {
    background-color: #EEE6DA;
    color: #262C43;
}

/* Overlay */
.burger-overlay {
    display: none;
    position: fixed;
    inset: 0;
    background: rgba(0,0,0,0.35);
    z-index: 9999;
    opacity: 0;
    transition: opacity 0.4s ease;
}
.burger-overlay.active {
    display: block;
}
.burger-overlay.visible {
    opacity: 1;
}

@media screen and (max-width: 991px) {
    .burger-btn { display: flex; }
    .navbar-collapse { display: none !important; }
    .container-fluid img { width: 50px; }
}
</style>

<nav class="navbar navbar-expand-lg fixed-top" data-bs-theme="light">
    <div class="container-fluid">
        <a class="navbar-link" href="#accueil"><img src="images/logo finale noir 1.png" alt="logo" width="85" style="position: fixed; margin-left:1rem"></a>
        <button class="navbar-toggler d-none" type="button">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav ms-auto mb-2 mb-lg-0 mt-5 me-5 custom-gap">
                <li class="nav-item">
                    <a class="nav-linkaboutmeprojects" href="#aboutme">ABOUT ME</a>
                </li>
                <li class="nav-item">
                    <a class="nav-linkaboutmeprojects" href="#projects">PROJECTS</a>
                </li>
                <li class="nav-item">
                    <a class="nav-linkcontact" href="#contact">GET IN TOUCH</a>
                </li>
            </ul>
        </div>
    </div>
</nav>

<!-- Burger button (mobile only) -->
<button class="burger-btn" id="burgerBtn" aria-label="Menu">
    <span class="bar"></span>
    <span class="bar"></span>
    <span class="bar"></span>
</button>

<!-- Overlay -->
<div class="burger-overlay" id="burgerOverlay"></div>

<!-- Drawer -->
<div class="burger-drawer" id="burgerDrawer">
    <a class="drawer-linkaboutme" href="#aboutme" data-drawer-link>ABOUT ME</a>
    <a class="drawer-linkprojects" href="#projects" data-drawer-link>PROJECTS</a>
    <a class="drawer-linkcontact" href="#contact" data-drawer-link>GET IN TOUCH</a>
</div>

<script>
(function() {
    const btn      = document.getElementById('burgerBtn');
    const drawer   = document.getElementById('burgerDrawer');
    const overlay  = document.getElementById('burgerOverlay');
    const links    = drawer.querySelectorAll('[data-drawer-link]');

    function openDrawer() {
        const scrollbarWidth = window.innerWidth - document.documentElement.clientWidth;
        document.body.style.paddingRight = scrollbarWidth + 'px';
        document.body.style.overflow = 'hidden';
        drawer.classList.add('open');
        btn.classList.add('open');
        overlay.classList.add('active');
        requestAnimationFrame(() => overlay.classList.add('visible'));
    }

    function closeDrawer(cb) {
        drawer.classList.remove('open');
        btn.classList.remove('open');
        overlay.classList.remove('visible');
        document.body.style.overflow = '';
        document.body.style.paddingRight = '';
        setTimeout(() => {
            overlay.classList.remove('active');
            if(cb) cb();
        }, 400);
    }

    btn.addEventListener('click', () => {
        drawer.classList.contains('open') ? closeDrawer() : openDrawer();
    });

    overlay.addEventListener('click', () => closeDrawer());

    links.forEach(link => {
        link.addEventListener('click', e => {
            e.preventDefault();
            const target = link.getAttribute('href');
            closeDrawer(() => {
                const el = document.querySelector(target);
                if(el) el.scrollIntoView({ behavior: 'smooth' });
            });
        });
    });
})();
</script>