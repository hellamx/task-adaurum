<main class="main">
                <h1 class="main__title">Авторизация пользователя</h1>
                <div class="alerts"></div>
                <div class="content">
                    <div class="content__user">
                        <form class="loginForm" action="/user/login" method="post">
                            <div class="formWrap">
                                <div class="firstBlock">
                                    <label for="login">Логин</label>
                                    <input type="text" placeholder="Ваш логин" name="login">
                                    <label for="password">Пароль</label>
                                    <input type="password" autocomplete="on" placeholder="Ваш пароль" name="password">
                                </div>
                            </div>
                            <input type="submit" value="Войти">
                        </form>
                        <button id="resetPasswordBtn">Забыли пароль?</button>
                        <div class="formWrapper">
                            <form class="resetForm" action="/user/reset" method="post">
                                <input type="text" placeholder="Ваш логин" name="login-reset">
                                <input type="submit" value="Сбросить пароль">
                            </form>
                        </div>
                    </div>
                </div>
            </main>