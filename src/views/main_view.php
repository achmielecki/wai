<!doctype html>
<html>
<head>
    <meta charset="UTF-8" />
    <title>Pojazdy pancerne</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="static/css/index.css" />
    <script type="text/javascript" src="static/script/jquery.js"></script>
    <script type="text/javascript" src="static/script/jquery-ui.min.js"></script>
    <script type="text/javascript" src="static/script/main.js"></script>
</head>
   <body>
       <div id="content">
           <header>
               Pojazdy pancerne w okresie 2 wojny światowej
           </header>


           <aside>
               <?php if(isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) {dispatch($routing, '/logout');} else {dispatch($routing, '/login');} ?>
               <div id="menu" >
                   <h4>Menu<span class="expand">  &equiv; </span></h4>
               </div>
               <nav>
                   <ul>
                       <li class="active"><a class="active" href="main">Strona główna</a></li>
                       <li><a href="gallery">Galeria</a></li>
                   </ul>
               </nav>
           </aside>
           <main>
               <div >
                   <section id="sec">
                       <img onclick="mod();" src="static/img/tankmain.jpg" alt="tu powinno byc zdjecie" id="mainpic" />
                       <p align="center"><h3>Witaj na stronie poświęconej pojazdom pancernym drugiej wojny światowej!</h3></p>

                   </section>
               </div>
           </main>
       </div>

	</body>
</html>