<?php

/** @var yii\web\View $this */
/** @var string $content */

use app\assets\AppAsset;
use app\widgets\Alert;
use yii\bootstrap5\Breadcrumbs;
use yii\bootstrap5\Html;
use yii\bootstrap5\Nav;
use yii\bootstrap5\NavBar;

AppAsset::register($this);

$this->registerCsrfMetaTags();
$this->registerMetaTag(['charset' => Yii::$app->charset], 'charset');
$this->registerMetaTag(['name' => 'viewport', 'content' => 'width=device-width, initial-scale=1, shrink-to-fit=no']);
$this->registerMetaTag(['name' => 'description', 'content' => $this->params['meta_description'] ?? '']);
$this->registerMetaTag(['name' => 'keywords', 'content' => $this->params['meta_keywords'] ?? '']);
$this->registerLinkTag(['rel' => 'icon', 'type' => 'image/x-icon', 'href' => Yii::getAlias('@web/favicon.ico')]);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>" class="h-100">
<head>
    <?php
// Balise canonical
$canonical = Yii::$app->request->absoluteUrl;
$this->registerLinkTag(['rel' => 'canonical', 'href' => $canonical]);
?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
    <!-- AOS Animation Library -->
<link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
<link href="css/custom.css" rel="stylesheet">
</head>

<body class="d-flex flex-column h-100">
<?php $this->beginBody() ?>

<header id="header">
    
    <?php
    
    NavBar::begin([
        'brandLabel' => Yii::$app->name,
        'brandUrl' => Yii::$app->homeUrl,
        'options' => ['class' => 'navbar-expand-md navbar-dark bg-dark fixed-top']
    ]);
    echo Nav::widget([
        'options' => ['class' => 'navbar-nav'],
        'items' => [
            ['label' => 'Home', 'url' => ['/site/index']],
            ['label' => 'About', 'url' => ['/site/about']],
            ['label' => 'Contact', 'url' => ['/site/contact']],
            ['label' => 'Blog', 'url' => ['/blog/index']],
            ['label' => 'Tableau de bord', 'url' => ['/extranet/dashboard/index']],
            ['label' => 'Services', 'url' => ['/extranet/service/index']],
            ['label' => 'Secteurs', 'url' => ['/extranet/sector/index']],
            Yii::$app->user->isGuest
                ? ['label' => 'Login', 'url' => ['/site/login']]
                : '<li class="nav-item">'
                    . Html::beginForm(['/site/logout'])
                    . Html::submitButton(
                        'Logout (' . Yii::$app->user->identity->username . ')',
                        ['class' => 'nav-link btn btn-link logout']
                    )
                    . Html::endForm()
                    . '</li>'
        ]
    ]);
    NavBar::end();
    ?>
</header>

<main id="main" class="flex-shrink-0" role="main">
    <div class="container">
        <?php if (!empty($this->params['breadcrumbs'])): ?>
            <?= Breadcrumbs::widget(['links' => $this->params['breadcrumbs']]) ?>
        <?php endif ?>
        <?= Alert::widget() ?>
        <?= $content ?>
    </div>
</main>

<footer class="bg-dark text-white mt-5 py-4">
    <div class="container">
        <div class="row">
            <div class="col-md-4 mb-3">
                <h5>CS Automatisme</h5>
                <p>Expert en automatisme, domotique et électricité industrielle depuis 20 ans.</p>
            </div>
            <div class="col-md-4 mb-3">
                <h5>Liens rapides</h5>
                <ul class="list-unstyled">
                    <li><?= Html::a('Services', ['service/index'], ['class' => 'text-white text-decoration-none']) ?></li>
                    <li><?= Html::a('Secteurs', ['sector/index'], ['class' => 'text-white text-decoration-none']) ?></li>
                    <li><?= Html::a('Blog', ['blog/index'], ['class' => 'text-white text-decoration-none']) ?></li>
                    <li><?= Html::a('Contact', ['site/contact'], ['class' => 'text-white text-decoration-none']) ?></li>
                </ul>
            </div>
            <div class="col-md-4 mb-3">
                <h5>Contact</h5>
                <p><i class="fas fa-phone"></i> +33 1 23 45 67 89<br>
                <i class="fas fa-envelope"></i> contact@csautomatisme.com<br>
                <i class="fas fa-map-marker-alt"></i> 123 Avenue des Automatismes, 75000 Paris</p>
            </div>
        </div>
        <div class="text-center mt-3 pt-3 border-top border-secondary">
            <small>&copy; <?= date('Y') ?> CS Automatisme. Tous droits réservés.</small>
        </div>
    </div>
</footer>

<?php $this->endBody() ?>
<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
<script>
    AOS.init({
        duration: 1000,
        once: true,
        offset: 100
    });
</script>
</body>
</html>
<?php $this->endPage() ?>
