<?php
use yii\helpers\Html;
use yii\bootstrap5\Nav;
use yii\bootstrap5\NavBar;
use yii\bootstrap5\Breadcrumbs;

$this->beginPage();
?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?> | Extranet CS Automatisme</title>
    <?php $this->head() ?>
    
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <!-- Custom CSS -->
    <style>
        body {
            background-color: #f8f9fa;
        }
        .navbar-brand {
            font-weight: bold;
        }
        .sidebar {
            min-height: calc(100vh - 56px);
            background-color: #2c3e50;
            color: white;
        }
        .sidebar .nav-link {
            color: #ecf0f1;
            padding: 10px 20px;
            transition: all 0.3s ease;
        }
        .sidebar .nav-link:hover {
            background-color: #34495e;
            color: white;
        }
        .sidebar .nav-link.active {
            background-color: #3498db;
            color: white;
        }
        .sidebar .nav-link i {
            margin-right: 10px;
            width: 20px;
        }
        .content-wrapper {
            padding: 20px;
        }
        .card {
            border: none;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0,0,0,0.05);
        }
        .user-info {
            padding: 20px;
            border-bottom: 1px solid #34495e;
            margin-bottom: 20px;
        }
        .user-avatar {
            width: 50px;
            height: 50px;
            border-radius: 50%;
            background-color: #3498db;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 20px;
            color: white;
            margin-bottom: 10px;
        }
        .user-name {
            font-weight: bold;
            margin-bottom: 5px;
        }
        .user-role {
            font-size: 12px;
            color: #95a5a6;
        }
    </style>
</head>
<body>
<?php $this->beginBody() ?>

<div class="container-fluid">
    <div class="row">
        <!-- Sidebar -->
        <div class="col-md-3 col-lg-2 px-0 sidebar">
            <div class="user-info text-center">
                <div class="user-avatar mx-auto">
                    <i class="fas fa-user"></i>
                </div>
                <div class="user-name">
                    <?= Yii::$app->user->identity->getFullName() ?: Yii::$app->user->identity->username ?>
                </div>
                <div class="user-role">
                    <?= Yii::$app->user->identity->role ? Yii::$app->user->identity->role->name : 'Utilisateur' ?>
                </div>
            </div>
            
            <?php
            $menuItems = [];
            
            // Menu selon le rôle
            if (Yii::$app->user->identity->role && Yii::$app->user->identity->role->slug === 'admin') {
                $menuItems = [
                    ['label' => '<i class="fas fa-tachometer-alt"></i> Tableau de bord', 'url' => ['/extranet/dashboard/index']],
                    ['label' => '<i class="fas fa-building"></i> Départements', 'url' => ['/extranet/department/index']],
                    ['label' => '<i class="fas fa-cogs"></i> Services', 'url' => ['/extranet/service/index']],
                    ['label' => '<i class="fas fa-tags"></i> Secteurs', 'url' => ['/extranet/sector/index']],
                    ['label' => '<i class="fas fa-map-marker-alt"></i> Régions', 'url' => ['/extranet/region/index']],
                    ['label' => '<i class="fas fa-users"></i> Utilisateurs', 'url' => ['/extranet/user/index']],
                    ['label' => '<i class="fas fa-key"></i> Rôles', 'url' => ['/extranet/role/index']],
                    ['label' => '<i class="fas fa-newspaper"></i> Articles', 'url' => ['/extranet/post/index']],
                    ['label' => '<i class="fas fa-star"></i> Témoignages', 'url' => ['/extranet/testimonial/index']],
                ];
            } elseif (Yii::$app->user->identity->role && Yii::$app->user->identity->role->slug === 'service_manager') {
                $menuItems = [
                    ['label' => '<i class="fas fa-tachometer-alt"></i> Tableau de bord', 'url' => ['/extranet/dashboard/index']],
                    ['label' => '<i class="fas fa-cogs"></i> Mon Service', 'url' => ['/extranet/service/view', 'id' => Yii::$app->user->identity->service_id]],
                    ['label' => '<i class="fas fa-tags"></i> Mes Secteurs', 'url' => ['/extranet/sector/index']],
                    ['label' => '<i class="fas fa-newspaper"></i> Articles', 'url' => ['/extranet/post/index']],
                ];
            } else {
                $menuItems = [
                    ['label' => '<i class="fas fa-tachometer-alt"></i> Tableau de bord', 'url' => ['/extranet/dashboard/index']],
                    ['label' => '<i class="fas fa-user"></i> Mon Profil', 'url' => ['/extranet/user/profile']],
                ];
            }
            
            // Menu de déconnexion
            $menuItems[] = ['label' => '<i class="fas fa-sign-out-alt"></i> Déconnexion', 'url' => ['/site/logout'], 'linkOptions' => ['data-method' => 'post']];
            
            echo Nav::widget([
                'options' => ['class' => 'nav flex-column'],
                'items' => $menuItems,
                'encodeLabels' => false,
            ]);
            ?>
        </div>
        
        <!-- Main Content -->
        <div class="col-md-9 col-lg-10 ms-sm-auto px-0">
            <!-- Top Navigation -->
            <nav class="navbar navbar-expand-lg navbar-light bg-white border-bottom">
                <div class="container-fluid">
                    <button class="btn btn-link d-md-none" type="button" data-bs-toggle="collapse" data-bs-target="#sidebarMenu">
                        <i class="fas fa-bars"></i>
                    </button>
                    <span class="navbar-text ms-auto">
                        <i class="far fa-clock"></i> 
                        <?= date('d/m/Y H:i') ?>
                    </span>
                </div>
            </nav>
            
            <!-- Breadcrumbs -->
            <div class="px-3 pt-3">
                <?= Breadcrumbs::widget([
                    'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
                    'homeLink' => [
                        'label' => '<i class="fas fa-home"></i> Accueil',
                        'url' => ['/extranet/dashboard/index'],
                        'encode' => false,
                    ],
                ]) ?>
            </div>
            
            <!-- Content -->
            <div class="content-wrapper">
                <?= $content ?>
            </div>
        </div>
    </div>
</div>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>