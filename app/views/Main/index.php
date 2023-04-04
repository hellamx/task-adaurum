<main class="main">
                <h1 class="main__title">Все компании</h1>
                <?php if(isset($_SESSION['alert'])): ?>
                <div class="common_alerts">
                    <ul>
                        <?= $_SESSION['alert'] ?>
                    </ul>
                </div>
                <?php unset($_SESSION['alert']); endif; ?>
                <div class="main__search">
                    <form action="/search" autocomplete="off" method="get">
                        <input type="text" id="typeahead" class="typeahead" placeholder="Поиск" name="s">
                        <input type="submit" value="Искать">
                    </form>
                </div>
                <?php if(isLogin()): ?>
                <a href="/company/add" class="main__addCompany--btn"><img src="/icons/add.svg" alt="Добавить">Новая компания</a>
                <?php else: ?>
                <p class="main__addCompany--notUser">Для добавления компаний необходимо <a href="/user/login">авторизоваться</a></p>
                <?php endif; ?>
                <div class="content">
                    <?php if($data): ?>
                    <?php foreach($data as $value): ?>
                    <div class="content__wrapper">
                        <a href="/company/<?= $value['id'] ?>" class="content__wrapper--title"><?= $value['name'] ?></a>
                        <div class="content__wrapper--info">
                            <ul>
                                <li><span>Адрес</span><?= $value['address'] ?></li>
                                <li><span>Телефон</span><?= $value['phone'] ?></li>
                                <li><span>Генеральный директор</span><?= $value['director'] ?></li>
                            </ul>
                            <div class="content__wrapper--btn">
                                <a class="btnOpen" href="/company/<?= $value['id'] ?>">Открыть</a>
                                <?php if(isset($_SESSION['user'])): ?>
                                <a class="btnDelete btnDeleteCompany" href="/company/delete?id=<?= $value['id'] ?>"><img src="/icons/delete.svg" alt="Удалить">Удалить</a>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                    <?php endforeach; ?>
                    <?php else: ?>
                    <p>Компаний еще нет</p>
                    <?php endif; ?>
                </div>
                <?php if($data && \cnotes\App::$app::get("companyPagination")): ?>
                <div class="main__pagination">
                    <ul>
                        <?= \cnotes\App::$app::get("companyPagination") ?>
                    </ul>
                </div>
				<?php endif ?>
            </main>