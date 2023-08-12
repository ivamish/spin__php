<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/public/assets/css/style.css?_v=20230810210053">
    <title>Spin</title>
</head>
<body>
    <a href="/logout" class="logout"><img src="/public/assets/images/logout.png" alt="logout"></a>
    <main id="spin" class="spin">
        <div class="container">
            <div class="spin__wrap-title">
                <div class="spin__title">
                    <h1 class="spin__title-text">
                        FORTUNE
                        <br>
                        WHEEL
                    </h1>
                </div>
            </div>
            <div class="spin__wrap">
                <div data-rotate="false" id="wheel" class="spin__wheel">
                    <?php $i = 0; foreach ($sections as $name => $section): ?>

                        <?php if($name === "jackpot"): ?>
                            <div style="--i: <?= $i ?>; --count: 4;" id="jackpot" class="spin__wheel-item <?= $section['isActive'] ? '' : 'false' ?> corona">
                                <span>JACK<br>POT</span>
                                <img src="/public/assets/images/<?= $section['image'] ?>" alt="corona">
                            </div>
                        <?php else: ?>
                            <div style="--i: <?= $i ?>;" class="spin__wheel-item <?= $section['isActive'] ? '' : 'false' ?> <?= $section['name'] ?>">
                                <img src="/public/assets/images/<?= $section['image'] ?>" alt="<?= $name ?>">
                                <div class="spin__wheel-item-count"><span>x <?= $section['count'] ?></span></div>
                            </div>
                    <?php endif; ?>
                    <?php $i++ ?>
                    <?php endforeach; ?>

                </div>
                <div class="spin__circle"></div>
            </div>
            <button id="rotate" class="btn spin__btn"><span>SPIN!</span></button>
        </div>
    </main>
    <div id="modal" class="spin-modal">
        <div class="spin-modal__border">
            <div class="spin-modal__content">
                <h2 class="spin-modal__title">CONGRATS!</h2>
                <div class="spin-modal__img">

                </div>
                <div class="spin-modal__text">You got 4 free lifes</div>
                <button id="modalBtn" class="btn btn--small spin-modal__btn"><span>OK</span></button>
            </div>
        </div>
    </div>
<script src="/public/assets/js/script.js"></script>
</body>
</html>