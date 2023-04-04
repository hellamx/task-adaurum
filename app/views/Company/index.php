<?php 
    use \app\models\Note;
?>
<main class="main">
                <h1 class="main__title"><?= $data['name'] ?></h1>
                <div class="main__company">
                    <div class="main__company--title">
                        <h3>О компании</h3>
                    </div>
                    <div class="main__company--info">
                        <div id="info__wrap">
                            <div class="info--main info--first">
                                <p><span>Адрес</span><?= $data['address'] ?></p>
                                <?php if(isLogin()): ?>
                                <p><a class="addNote" href="#!">Добавить комментарий</a></p>
                                <?php endif; ?>
                            </div>
                            <div class="addField" id="address">
                                <form action="/note/add" data-company="<?= $this->route['alias'] ?>" class="noteForm" method="post">
                                    <div class="textareaWrap">
                                        <textarea name="text" data-field="address" cols="10" rows="5" placeholder="Сообщение"></textarea>
                                    </div>
                                    <input type="submit" value="Сохранить">
                                </form>
                            </div>
                            <?php if(Note::getField($this->route['alias'], "address") && isLogin()): ?>
                                <?php foreach(Note::getField($this->route['alias'], "address") as $v): ?>
                                <div class="note__main wrapperDelete">
                                    <h3 class="note__main--title">Примечание</h3>
                                    <div class="note__main--wrap">
                                        <div class="note__desc">
                                            <div class="note__main--info">
                                                <p>Пользователь: <span><?= $v['user_name'] ?></span></p>
                                                <p>Дата: <span><?= $v['date'] ?></span></p>
                                            </div>
                                            <div class="note__main--text">
                                                <p>Текст примечания: <span><?= $v['text'] ?></span></p>
                                            </div>
                                            <a class="btnDelete viewDeleteBtn" data-delete="<?= $v['id'] ?>" href="#!"><img src="/icons/delete.svg" alt="Удалить">Удалить</a>
                                        </div>
                                    </div>
                                </div>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        </div>
                        <div id="info__wrap">
                            <div class="info--main">
                                <p><span>ИНН</span><?= $data['inn'] ?></p>
                                <?php if(isLogin()): ?>
                                <p><a class="addNote" href="#!">Добавить комментарий</a></p>
                                <?php endif; ?>
                            </div>
                            <div class="addField" id="inn">
                                <form action="/note/add" data-company="<?= $this->route['alias'] ?>" class="noteForm" method="post">
                                    <div class="textareaWrap">
                                        <textarea name="text" data-field="inn" cols="10" rows="5" placeholder="Сообщение"></textarea>
                                    </div>
                                    <input type="submit" value="Сохранить">
                                </form>
                            </div>
                            <?php if(Note::getField($this->route['alias'], "inn") && isLogin()): ?>
                                <?php foreach(Note::getField($this->route['alias'], "inn") as $v): ?>
                                <div class="note__main wrapperDelete">
                                    <h3 class="note__main--title">Примечание</h3>
                                    <div class="note__main--wrap">
                                        <div class="note__desc">
                                            <div class="note__main--info">
                                                <p>Пользователь: <span><?= $v['user_name'] ?></span></p>
                                                <p>Дата: <span><?= $v['date'] ?></span></p>
                                            </div>
                                            <div class="note__main--text">
                                                <p>Текст примечания: <span><?= $v['text'] ?></span></p>
                                            </div>
                                            <a class="btnDelete viewDeleteBtn" data-delete="<?= $v['id'] ?>" href="#!"><img src="/icons/delete.svg" alt="Удалить">Удалить</a>
                                        </div>
                                    </div>
                                </div>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        </div>
                        <div id="info__wrap">
                            <div class="info--main">
                                <p><span>Генеральный директор</span><?= $data['director'] ?></p>
                                <?php if(isLogin()): ?>
                                <p><a class="addNote" href="#!">Добавить комментарий</a></p>
                                <?php endif; ?>
                            </div>
                            <div class="addField" id="director">
                                <form action="/note/add" data-company="<?= $this->route['alias'] ?>" class="noteForm" method="post">
                                    <div class="textareaWrap">
                                        <textarea name="text" data-field="director" cols="10" rows="5" placeholder="Сообщение"></textarea>
                                    </div>
                                    <input type="submit" value="Сохранить">
                                </form>
                            </div>
                            <?php if(Note::getField($this->route['alias'], "director") && isLogin()): ?>
                                <?php foreach(Note::getField($this->route['alias'], "director") as $v): ?>
                                <div class="note__main wrapperDelete">
                                    <h3 class="note__main--title">Примечание</h3>
                                    <div class="note__main--wrap">
                                        <div class="note__desc">
                                            <div class="note__main--info">
                                                <p>Пользователь: <span><?= $v['user_name'] ?></span></p>
                                                <p>Дата: <span><?= $v['date'] ?></span></p>
                                            </div>
                                            <div class="note__main--text">
                                                <p>Текст примечания: <span><?= $v['text'] ?></span></p>
                                            </div>
                                            <a class="btnDelete viewDeleteBtn" data-delete="<?= $v['id'] ?>" href="#!"><img src="/icons/delete.svg" alt="Удалить">Удалить</a>
                                        </div>
                                    </div>
                                </div>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        </div>
                        <div id="info__wrap">
                            <div class="info--main">
                                <p><span>Общая информация</span><?= $data['content'] ?></p>
                                <?php if(isLogin()): ?>
                                <p><a class="addNote" href="#!">Добавить комментарий</a></p>
                                <?php endif; ?>
                            </div>
                            <div class="addField" id="content">
                                <form action="/note/add" data-company="<?= $this->route['alias'] ?>" class="noteForm" method="post">
                                    <div class="textareaWrap">
                                        <textarea name="text" data-field="content" cols="10" rows="5" placeholder="Сообщение"></textarea>
                                    </div>
                                    <input type="submit" value="Сохранить">
                                </form>
                            </div>
                            <?php if(Note::getField($this->route['alias'], "content") && isLogin()): ?>
                                <?php foreach(Note::getField($this->route['alias'], "content") as $v): ?>
                                <div class="note__main wrapperDelete">
                                    <h3 class="note__main--title">Примечание</h3>
                                    <div class="note__main--wrap">
                                        <div class="note__desc">
                                            <div class="note__main--info">
                                                <p>Пользователь: <span><?= $v['user_name'] ?></span></p>
                                                <p>Дата: <span><?= $v['date'] ?></span></p>
                                            </div>
                                            <div class="note__main--text">
                                                <p>Текст примечания: <span><?= $v['text'] ?></span></p>
                                            </div>
                                            <a class="btnDelete viewDeleteBtn" data-delete="<?= $v['id'] ?>" href="#!"><img src="/icons/delete.svg" alt="Удалить">Удалить</a>
                                        </div>
                                    </div>
                                </div>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        </div>
                        <div id="info__wrap">
                            <div class="info--main">
                                <p><span>Телефон</span><?= $data['phone'] ?></p>
                                <?php if(isLogin()): ?>
                                <p><a class="addNote" href="#!">Добавить комментарий</a></p>
                                <?php endif; ?>
                            </div>
                            <div class="addField" id="phone">
                                <form action="/note/add" data-company="<?= $this->route['alias'] ?>" class="noteForm" method="post">
                                    <div class="textareaWrap">
                                        <textarea name="text" data-field="phone" cols="10" rows="5" placeholder="Сообщение"></textarea>
                                    </div>
                                    <input type="submit" value="Сохранить">
                                </form>
                            </div>
                            <?php if(Note::getField($this->route['alias'], "phone") && isLogin()): ?>
                                <?php foreach(Note::getField($this->route['alias'], "phone") as $v): ?>
                                <div class="note__main wrapperDelete">
                                    <h3 class="note__main--title">Примечание</h3>
                                    <div class="note__main--wrap">
                                        <div class="note__desc">
                                            <div class="note__main--info">
                                                <p>Пользователь: <span><?= $v['user_name'] ?></span></p>
                                                <p>Дата: <span><?= $v['date'] ?></span></p>
                                            </div>
                                            <div class="note__main--text">
                                                <p>Текст примечания: <span><?= $v['text'] ?></span></p>
                                            </div>
                                            <a class="btnDelete viewDeleteBtn" data-delete="<?= $v['id'] ?>" href="#!"><img src="/icons/delete.svg" alt="Удалить">Удалить</a>
                                        </div>
                                    </div>
                                </div>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        </div>
                    </div>
                    <div class="main__company--title title--common">
                        <h3>Общие комментарии</h3>
                    </div>
                    <div class="main__company--comments" id="main">
                        <?php if(Note::getField($this->route['alias'], "main") && isLogin()): ?>
                            <?php foreach(Note::getField($this->route['alias'], "main") as $k => $v): ?>
                                <div class="comments__wrapper wrapperDelete">
                                    <span class="comments__wrapper--title">Комментарий</span>
                                    <div class="comments__main">
                                        <div class="comments__wrapper--info">
                                            <p>Дата: <span><?= $v['date'] ?></span></p>
                                            <p>Пользователь: <span><?= $v['user_name'] ?></span></p>
                                        </div>
                                        <div class="comments__wrapper--text">
                                            <p>Текст примечания: <span><?= $v['text'] ?></span></p>
                                        </div>
                                        <a class="viewDeleteBtn" data-delete="<?= $v['id'] ?>" href="#!"><img src="/icons/delete.svg" alt="Удалить">Удалить</a>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                            <button class="addBtn" href="#!">Добавить комментарий</button>
                                <div class="addWrap">
                                    <form class="addMainForm noteForm" data-main="main" data-company="<?= $this->route['alias'] ?>" method="post" action="/note/add">
                                        <label for="maintext">Сообщение</label>
                                        <div class="textareaWrap">
                                            <textarea name="text" data-field="main" cols="10" rows="5" placeholder="Сообщение"></textarea>
                                        </div>
                                        <input type="submit" value="Сохранить">
                                    </form>
                                </div>
                        <?php elseif (!isLogin()): ?>
                        <p class="emptyField">Для обсуждения необходимо <a href="/user/login">авторизоваться</a></p>
                        <?php else: ?>
                        <p class="emptyField">Комментариев ещё нет</p>
                        <button class="addBtn" href="#!">Добавить комментарий</button>
                        <div class="addWrap">
                            <form class="addMainForm noteForm" data-main="main" data-company="<?= $this->route['alias'] ?>" method="post" action="/note/add">
                                <label for="maintext">Сообщение</label>
                                <div class="textareaWrap">
                                    <textarea name="text" data-field="main" cols="10" rows="5" placeholder="Сообщение"></textarea>
                                </div>
                                <input type="submit" value="Сохранить">
                            </form>
                        </div>
                        <?php endif; ?>
                    </div>
                </div>
            </main>