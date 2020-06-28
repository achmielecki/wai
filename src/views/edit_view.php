<!doctype html>
<html>
<head>
    <meta charset="UTF-8" />
    <title>Pojazdy pancerne</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="static/css/index.css" />
    <link rel="stylesheet" href="static/css/jquery-ui.min.css" />
    <script src="static/script/jquery.js"></script>
    <script src="static/script/jquery-ui.min.js"></script>
    <script src="static/script/main.js"></script>
</head>
<body>
<div id="content">
    <header>
        Pojazdy pancerne w okresie 2 wojny światowej
    </header>
    <aside>
        <h4>Menu<span class="expand">  &equiv;   </span></h4>
        <nav>
            <ul>
                <li><a href="main">Strona główna</a></li>
                <li class="active"><a class="active" href="gallery">Galeria</a></li>
            </ul>
        </nav>
    </aside>

    <main>
        <?php if($_SESSION['f1'] ): ?>
            <p>plik za duży</p>
        <?php endif ?>
        <?php if($_SESSION['f2'] ): ?>
            <p>złe rozszerzenie pliku </p>
        <?php endif ?>
        <form method="post" enctype="multipart/form-data">
            <label>
                <span>Plik:</span>
                <input type="file" name="zdjecie"  required/>
                <input type="hidden" name="id" />
            </label></br>
            <label>
                <span>Tytuł:</span>
                <input type="text" name="tytul"  required/>
            </label></br>
            <label>
                <span>Autor:</span>
                <input type="text" name="autor"  required/>
            </label></br>
            <label>
                <span>Znak wodny:</span>
                <input type="text" name="znakwodny"  required/>
            </label></br>
            <div>

                <input  type="submit" value="Wyślij"/>
                <a href="main" class="cancel">Anuluj</a>
                <a href="photos" class="cancel">Do obrazków</a>
            </div>
        </form>
    </main>
</div>
</body>
</html>
