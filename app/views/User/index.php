<main class="main">
                <h1 class="main__title">Аккаунт пользователя</h1>
                <div class="alerts"></div>
                <div class="content">
                    <div class="content__user">
                        <p>ФИО: <span><?= $_SESSION['user']['fullname'] ?></span></p>
                        <p>Логин: <span><?= $_SESSION['user']['login'] ?></span></p>
                        <p>Email: <span><?= $_SESSION['user']['email'] ?></span></p>
                        <p>Возраст: <span><?= $_SESSION['user']['age'] ?></span></p>
                        <p>Должность: <span><?= $_SESSION['user']['position'] ?></span></p>
                        <p>Дата регистрации: <b><span><?= $_SESSION['user']['signup_date'] ?></span></b></p>
                    </div>
                </div>
            </main>