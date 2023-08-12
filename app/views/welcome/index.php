<?php
 view('welcome.header', compact('title'));
 ?>
<body>
<div class="container">
    <main class="welcome">
        <h1 class="welcome__title">Колесо фортуны</h1>
        <div class="welcome__btns">
            <a href="/auth" class="welcome-btn welcome__btn">Войти</a>
            <a href="/register" class="welcome-btn welcome__btn welcome-btn--transparent">Регистрация</a>
        </div>
    </main>
</div>
</body>
</html>
