<main class="main">
                <h1 class="main__title">Результаты поиска</h1>
                <div class="main__search">
                    <form action="/search" autocomplete="off" method="get">
                        <input type="text" id="typeahead" class="typeahead" placeholder="Поиск" name="s">
                        <input type="submit" value="Искать">
                    </form>
                </div>
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
                                <a class="btnDelete" data-id="<?= $value['id'] ?>" href="/company/delete"><img src="/icons/delete.svg" alt="Удалить">Удалить</a>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                    <?php endforeach; ?>
                    <?php else: ?>
                    <p>Ничего не найдено</p>
                    <?php endif; ?>
                </div>
            </main>