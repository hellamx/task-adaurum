<!DOCTYPE html>
<html lang="ru">
	<head>
        <?= $meta ?>
		<meta charset="utf-8">
    	<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
   		<link rel="shortcut icon" href="/icons/favicon.ico" type="image/x-icon">
    	<link rel="stylesheet" href="/css/style.css">
    	<link rel="stylesheet" href="/css/mobile.css">
	</head>
    <body>
        <div class="wrapper">
            <header class="header">
                <a class="header__logo" href="/">Company<span>Notes</span></a>
                <button id="nav-show"><img src="/icons/menu.svg" alt="Меню">Меню</button>
                <div id="nav-desktop" class="header__nav">
                    <ul>
                        <li><a href="/">Все компании</a></li>
                        <?php if(isLogin()): ?>
                        <li><a href="/user">Аккаунт</a></li>
                        <li><a href="/user/logout">Выход</a></li>
                        <?php else: ?>
                        <li><a href="/user/signup">Регистрация</a></li>
                        <li><a href="/user/login">Авторизация</a></li>
                        <?php endif; ?>
                    </ul>
                </div>
                <div id="nav-mobile" class="header__nav">
                    <ul>
                        <li><a href="/">Все компании</a></li>
                        <?php if(isLogin()): ?>
                        <li><a href="/user">Аккаунт</a></li>
                        <li><a href="/user/logout">Выход</a></li>
                        <?php else: ?>
                        <li><a href="/user/login">Авторизация</a></li>
                        <li><a href="/user/signup">Регистрация</a></li>
                        <?php endif; ?>
                        <li><a class="closeBtn" href="#">Закрыть меню</a></li>
                    </ul>
                </div>
            </header>
            <?= $content ?>
            <footer class="footer">
                <h5>Company<span>Notes <?= date("Y") ?></span></h5>
            </footer>
        </div>
        <script>
        var path = "<?= PATH ?>";
        </script>
        <script src="/js/jquery-3.6.3.min.js"></script>
        <script src="/js/nav.js"></script>
        <?php if($this->route['controller'] == "Main" || $this->route['controller'] == "Search"): ?>
        <script src="/js/typeahead.js"></script>
        <script src="/js/search.js"></script>
        <?php endif; ?>
        <?php if($this->route['controller'] == "User"): ?>
        <script src="/js/user.js"></script>    
        <?php endif; ?>
        <?php if($this->route['controller'] == "Company" && isLogin()): ?>
        <script src="/js/listener.js"></script>    
        <script src="/js/company.js"></script>
        <?php endif; ?>
        <script src="/js/notes.js"></script>
    </body>
</html>