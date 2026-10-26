<?php

use yii\helpers\Html;

?>
<!-- Navbar -->
<nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <ul class="navbar-nav">
        <li class="nav-item">
            <a class="nav-link" data-widget="pushmenu" href="#" role="button" aria-label="Toggle sidebar">
                <i class="fas fa-bars"></i>
            </a>
        </li>
    </ul>

    <ul class="navbar-nav ml-auto">
        <?php if (!Yii::$app->user->isGuest): ?>
            <li class="nav-item">
                <span class="nav-link navbar-username">
                    <?= Html::encode(Yii::$app->user->identity->username) ?>
                </span>
            </li>
            <li class="nav-item">
                <?= Html::a(
                    '<i class="fas fa-sign-out-alt" aria-hidden="true"></i>',
                    ['/site/logout'],
                    [
                        'data-method' => 'post',
                        'class' => 'nav-link',
                        'aria-label' => 'Logout',
                        'title' => 'Logout',
                    ],
                ) ?>
            </li>
        <?php endif ?>
    </ul>
</nav>
<!-- /.navbar -->
