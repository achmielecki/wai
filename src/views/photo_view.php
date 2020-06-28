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
        <img id="mainpicgal" src="<?= 'upload/'. $id .'_watermark'.'.png' ?>" alt="" />
    </main>
</div>

</body>
</html>