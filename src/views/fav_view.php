
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
        <table>

            <tbody>
            <?php if (count($fav)): ?>
            <?php foreach ($fav as $photo):?>
            <form method="post">
                <tr>
                    <td>
                        <input type="checkbox" name="<?=(string) $photo['_id'] ?>"  <?php if(!isset($_SESSION[(string) $photo['_id']])) echo "checked=checked"?> />
                    </td>
                    <td>
                        <a href ="photo?id=<?= $photo['_id'] ?>" ><img src="<?= 'upload/'. $photo['_id'].'_thumb'.'.'. $photo['ext'] ?>" onclick= alt="" class="miniphoto"/></a>

                    </td>
                    <td>
                        <a><?= $photo['tytul'] ?></a>
                    </td>
                    <td>
                        <a><?= $photo['autor'] ?></a>
                    </td>
                    <td>
                        <a href="delete?id=<?= $photo['_id']?>"> usuń </a>
                    </td>
                </tr>

                <?php endforeach ?>
                <?php else: ?>
                    <tr>
                        <td colspan="3">Brak zdjęć</td>
                    </tr>
                <?php endif ?>

                <tr>
                    <input type="submit" value="Zapomnij wybrane" />
                </tr>
            </form>
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