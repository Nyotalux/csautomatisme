<?php
use yii\helpers\Html;
use yii\helpers\Url;
use yii\web\JsExpression;

$this->title = 'Tableau de bord';
?>

<div class="dashboard-index">
    <div class="container-fluid">
        <!-- En-tête -->
        <div class="row mb-4">
            <div class="col-12">
                <h1 class="h3 mb-0">Tableau de bord</h1>
                <p class="text-muted">
                    Bonjour <?= Html::encode($user->getFullName()) ?>, 
                    bienvenue sur votre espace de gestion.
                </p>
            </div>
        </div>
        
        <?php if ($user->role && $user->role->slug === 'admin'): ?>
            <!-- Admin Dashboard -->
            <?= $this->render('_admin_dashboard', ['stats' => $stats]) ?>
            
        <?php elseif ($user->role && $user->role->slug === 'service_manager'): ?>
            <!-- Service Manager Dashboard -->
            <?= $this->render('_service_manager_dashboard', ['stats' => $stats]) ?>
            
        <?php else: ?>
            <!-- User Dashboard -->
            <?= $this->render('_user_dashboard', ['stats' => $stats]) ?>
            
        <?php endif; ?>
    </div>
</div>

<?php
$this->registerCss("
    .dashboard-card {
        transition: transform 0.3s ease, box-shadow 0.3s ease;
        border: none;
        border-radius: 15px;
    }
    .dashboard-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 30px rgba(0,0,0,0.1);
    }
    .stat-icon {
        width: 60px;
        height: 60px;
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 24px;
    }
    .activity-timeline {
        position: relative;
        padding-left: 30px;
    }
    .activity-item {
        position: relative;
        padding-bottom: 20px;
        border-left: 2px solid #e9ecef;
        padding-left: 20px;
        margin-left: 10px;
    }
    .activity-item:last-child {
        border-left: none;
    }
    .activity-icon {
        position: absolute;
        left: -12px;
        top: 0;
        width: 24px;
        height: 24px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 12px;
    }
");
?>