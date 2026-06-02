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
    background-color: #EEE6DA; /* couleur du rectangle */
    color: #262C43; /* couleur de la typo */
    padding: 0.6rem 1.2rem;
    border-radius: 30px; /* arrondi */
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
@media screen and (max-width: 768px){
    .container-fluid img{
        width:50px;
    }
}
                
</style>
<nav class="navbar navbar-expand-lg fixed-top" data-bs-theme="light">
    <div class="container-fluid">
        <a class="navbar-link" href="#accueil"><img src="images/logo finale noir 1.png" alt="logo" width="85" style="position: fixed; margin-left:1rem"></a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
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