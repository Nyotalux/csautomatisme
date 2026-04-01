<?php
use yii\helpers\Html;

$totalServices = isset($totalServices) ? $totalServices : 0;
$totalArticles = isset($totalArticles) ? $totalArticles : 0;
?>

<div class="row mt-5 pt-4 text-center bg-light py-5 rounded">
    <div class="col-md-4 mb-3">
        <div class="counter">
            <i class="fas fa-cogs fa-3x text-primary mb-2"></i>
            <h2 class="display-4 fw-bold"><?= $totalServices ?></h2>
            <p class="text-muted">Services proposés</p>
        </div>
    </div>
    <div class="col-md-4 mb-3">
        <div class="counter">
            <i class="fas fa-newspaper fa-3x text-primary mb-2"></i>
            <h2 class="display-4 fw-bold"><?= $totalArticles ?></h2>
            <p class="text-muted">Articles publiés</p>
        </div>
    </div>
    <div class="col-md-4 mb-3">
        <div class="counter">
            <i class="fas fa-smile fa-3x text-primary mb-2"></i>
            <h2 class="display-4 fw-bold">500+</h2>
            <p class="text-muted">Clients satisfaits</p>
        </div>
    </div>
</div>

<?php
$this->registerCss("
    .bg-light {
        background-color: #f8f9fa !important;
    }
    .counter {
        padding: 20px;
        transition: transform 0.3s ease;
    }
    .counter:hover {
        transform: translateY(-5px);
    }
    .display-4 {
        font-size: 2.5rem;
        font-weight: bold;
    }
");
?>