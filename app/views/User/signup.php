<main class="main">
                <h1 class="main__title">Регистрация пользователя</h1>
                <div class="alerts"></div>
                <div class="content">
                    <div class="content__user">
                        <form class="signupForm" action="#" method="post">
                            <div class="formWrap">
                                <div class="firstBlock">
                                    <label for="fullname">ФИО</label>
                                    <input type="text" placeholder="Ваше ФИО" name="fullname">
                                    <label for="login">Логин</label>
                                    <input type="text" placeholder="Придумайте логин" name="login">
                                    <label for="email">E-mail</label>
                                    <input type="text" placeholder="Ваш E-mail" name="email">
                                </div>
                                <div class="lastBlock">
                                    <label for="password">Пароль</label>
                                    <input type="password" placeholder="Придумайте пароль" autocomplete="on" name="password">
                                    <label for="age">Возраст</label>
                                    <select name="age">
                                        <?php for($i = 18; $i <= 65; $i++): ?>
                                        <option value="<?= $i ?>"><?= $i ?></option>
                                        <?php endfor; ?>
                                    </select>
                                    <label for="position">Ваша должность</label>
                                    <select name="position">
                                        <option value="Разработчик">Разработчик</option>
                                        <option value="Менеджер">Менеджер</option>
                                        <option value="Бухгалтер">Бухгалтер</option>
                                        <option value="Редактор">Редактор</option>
                                    </select>
                                </div>
                            </div>
                            <input type="submit" value="Сохранить">
                        </form>
                    </div>
                </div>
            </main>