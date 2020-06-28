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
        <form method="post" >
            <label>
                <span>Login</span>
                <input type="text" name="login" required/>
            </label></br>
            <label>
                <span>Email:</span>
                <input type="text" name="email"  required/>
            </label></br>
            <label>
                <span>Hasło:</span>
                <input type="password" name="pass"  required/>
            </label></br>
            <label>
                <span>Powtórz hasło:</span>
                <input type="password" name="passrep"  required/>
                <?php if($f3 == true): ?>
                <p>hasła nie są zgodne</p>
                <?php endif ?>
                <?php if($f5 == true): ?>
                    <p>login zajęty</p>
                <?php endif ?>
            </label></br>
            <div>

                <input  type="submit" value="Zarejestruj"/>
                <a href="main" class="cancel">Anuluj</a>
            </div>
        </form>
    </main>
</div>
</body>
</html>
