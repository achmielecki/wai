<div id="login">

    <h5>Logowanie</h5>

    <form method="post">
        <tr>
            <td>
                <label>
                    Login: <input type="text" name="login" value="" />
                </label><br/>
                <label>
                    Hasło: <input type="password" name="pass" />
                </label>
            </td>
            <td>
                <?php if($f4 == true): ?>
                    <p>logowanie nie powiodło się</p>
                <?php endif ?>
                <input type="submit" value="Login" />
                <a href="register"> Załóż konto </a>
            </td>
        </tr>

    </form>
</div>
