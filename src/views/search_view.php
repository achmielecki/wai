
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
        <h4>Menu<span class="expand">  &equiv;   </span></h4>
        <nav>
            <ul>
                <li><a href="main">Strona główna</a></li>
                <li class="active"><a class="active" href="gallery">Galeria</a></li>
            </ul>
        </nav>
    </aside>

    <main>
        <form>
            <input type="text" size="30" name="search" onkeyup="search_func(this.value);">
            <div id="search"></div>
        </form>
        <table id="search">

            <tbody>
            </tbody>
            <tfoot>
            <tr>
                <td>
                    <a href="photos"> wróć </a>
                </td>
            </tr>
            </tfoot>

        </table>
    </main>
</div>
</body>
</html>