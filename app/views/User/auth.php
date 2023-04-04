<main class="main">
                <h1 class="main__title">Восстановление пароля</h1>
                <div class="alerts"></div>
                <div class="content">
                    <div class="content__user">
                        <form class="resaveForm" action="/user/auth" method="post">
                            <div class="formWrap">
                                <div class="firstBlock">
                                    <label for="password">Новый пароль</label>
                                    <input type="password" autocomplete="on" placeholder="Ваш пароль" name="password">
                                </div>
                            </div>
                            <input type="submit" value="Сменить пароль">
                        </form>
                    </div>
                </div>
            </main>