
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

            <?php if (count($photos)): ?>
                <?php foreach ($photos as $photo):?>
                <form method="post">
                    <tr>
                        <td>
                            <input type="checkbox" name="<?=(string) $photo['_id'] ?>"  <?php if(isset($_SESSION[(string) $photo['_id']])) echo "checked=checked"?> />
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
                    <input type="submit" value="Zapamietaj wybrane" />
                    </tr>
                </form>
            </tbody>

            <tfoot>

            <tr>
                <td colspan="2">Łącznie: <?= $count ?></td>
                <td colspan="2">Stron: <?= $maxpage ?></td>
                <td>
                    <a href="edit">nowe zdjęcie</a>
                    <a href="deletec">usun wszystkie zdjecia</a>
                    <a href="fav">zapamiętane</a>
                    <a href="search">wyszukaj zdjęcie</a>
                </td>
            </tr>
            <tr>
                <td>
                    <div class="pagination">
                        <a href="photos?page=<?= $page - 1  ?>">&laquo;</a>
                        <a class="<?php if ($page==$menu1) {echo "active"; } ?>" href="photos?page=<?=  $menu1  ?>"><?=  $menu1  ?></a>
                        <a class="<?php if ($page==$menu2) {echo "active"; } ?>" href="photos?page=<?=  $menu2  ?>"><?=  $menu2  ?></a>
                        <a class="<?php if ($page==$menu3) {echo "active"; } ?>" href="photos?page=<?=  $menu3  ?>"><?=  $menu3  ?></a>
                        <a class="<?php if ($page==$menu4) {echo "active"; } ?>" href="photos?page=<?=  $menu4  ?>"><?=  $menu4  ?></a>
                        <a class="<?php if ($page==$menu5) {echo "active"; } ?>" href="photos?page=<?=  $menu5  ?>"><?=  $menu5  ?></a>
                        <a href="photos?page=<?= $page + 1  ?>">&raquo;</a>
                    </div>
                </td>
            </tr>
            <tr>
                <td>
                <a href="main"> wróć </a>
                </td>
            </tr>
            </tfoot>

        </table>
    </main>
</div>
</body>
</html>