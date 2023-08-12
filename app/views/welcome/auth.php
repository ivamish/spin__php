<?php
    view('welcome.header', compact('title'));
?>
<body>
<div class="container">
    <main class="welcome">
        <form method="post" action="/signin" class="welcome-form">
            <div class="welcome-form__field control-input">
                <input value="<?= get_old_value('email') ?>" name="email" placeholder="email" type="email" class="welcome-form__input welcome-form__input--first">
                <div class="welcome-form__field-control">
                    <img src="/public/assets/images/check.svg" alt="check" class="welcome-form__field-check">
                    <div class="welcome-form__field-x">&#10060;</div>
                </div>
            </div>
            <div class="welcome-form__field">
                <input id="passwordInput" value="<?= get_old_value('password') ?>" name="password" placeholder="password" type="password" class="welcome-form__input">
                <div class="welcome-form__field-eye">
                    <img src="/public/assets/images/eye.png" alt="eye">
                </div>
            </div>
            <?php if(isset_err('register')): ?>
                <div style="color: #cd2131; margin: 15px; font-family: 'Poppins', sans-serif; font-weight: 700;" class="welcome__err">
                    <?= get_errors('register'); ?>
                </div>
            <?php endif;?>
            <button class="welcome-btn welcome-form__btn">Войти</button>
            <div class="welcome-form__epilog">
                У Вас нет аккаунта? <a href="/register">Зарегистрироваться</a>
            </div>
        </form>
    </main>
</div>
<script src="/public/assets/js/welcome.js"></script>
</body>
</html>
