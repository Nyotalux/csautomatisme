<?php
use yii\helpers\Html;
use yii\helpers\Url;

$serviceName = $stats['service_name'];
$totalSectors = $stats['total_sectors'];
$totalUsers = $stats['total_users'];
$totalRegions = $stats['total_regions'];
?>

<div class="row mb-4">
    <div class="col-12">
        <div class="alert alert-info">
            <i class="fas fa-chart-line"></i> 
            Tableau de bord du service : <strong><?= Html::encode($serviceName) ?></strong>
        </div>
    </div>
</div>

<!-- Cartes de statistiques -->
<div class="row mb-4">
    <div class="col-md-4 mb-3">
        <div class="card dashboard-card shadow-sm">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h6 class="text-muted mb-2">Secteurs</h6>
                        <h2 class="mb-0"><?= $totalSectors ?></h2>
                    </div>
                    <div class="stat-icon bg-primary bg-opacity-10">
                        <i class="fas fa-tags text-primary"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <div class="col-md-4 mb-3">
        <div class="card dashboard-card shadow-sm">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h6 class="text-muted mb-2">Utilisateurs</h6>
                        <h2 class="mb-0"><?= $totalUsers ?></h2>
                    </div>
                    <div class="stat-icon bg-success bg-opacity-10">
                        <i class="fas fa-users text-success"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <div class="col-md-4 mb-3">
        <div class="card dashboard-card shadow-sm">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h6 class="text-muted mb-2">Régions couvertes</h6>
                        <h2 class="mb-0"><?= $totalRegions ?></h2>
                    </div>
                    <div class="stat-icon bg-info bg-opacity-10">
                        <i class="fas fa-map-marker-alt text-info"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Secteurs du service -->
<div class="row mb-4">
    <div class="col-12">
        <div class="card shadow-sm">
            <div class="card-header bg-white">
                <h5 class="mb-0">Secteurs d'intervention</h5>
            </div>
            <div class="card-body">
                <div class="row">
                    <?php foreach ($stats['sectors'] as $sector): ?>
                    <div class="col-md-3 mb-3">
                        <div class="border rounded p-3 text-center">
                            <i class="<?= $sector->icon ?: 'fas fa-building' ?> fa-2x text-primary mb-2"></i>
                            <h6><?= Html::encode($sector->name) ?></h6>
                            <small class="text-muted"><?= Html::encode($sector->description) ?></small>
                        </div>
                    </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Graphiques -->
<div class="row mb-4">
    <div class="col-lg-6 mb-3">
        <div class="card shadow-sm">
            <div class="card-header bg-white">
                <h5 class="mb-0">Utilisateurs par secteur</h5>
            </div>
            <div class="card-body">
                <canvas id="usersBySectorChart" height="250"></canvas>
            </div>
        </div>
    </div>
    
    <div class="col-lg-6 mb-3">
        <div class="card shadow-sm">
            <div class="card-header bg-white">
                <h5 class="mb-0">Répartition par région</h5>
            </div>
            <div class="card-body">
                <canvas id="regionsChart" height="250"></canvas>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Utilisateurs par secteur
    var usersBySector = <?= json_encode($stats['users_by_sector']) ?>;
    var sectorCtx = document.getElementById('usersBySectorChart').getContext('2d');
    new Chart(sectorCtx, {
        type: 'bar',
        data: {
            labels: usersBySector.map(item => item.name),
            datasets: [{
                label: 'Nombre d\'utilisateurs',
                data: usersBySector.map(item => item.count),
                backgroundColor: 'rgba(102, 126, 234, 0.5)',
                borderColor: 'rgba(102, 126, 234, 1)',
                borderWidth: 1
            }]
        },
        options: {
            responsive: true,
            scales: { y: { beginAtZero: true, ticks: { stepSize: 1 } } }
        }
    });
    
    // Répartition par région
    var regionsData = <?= json_encode($stats['regions_distribution']) ?>;
    var regionsCtx = document.getElementById('regionsChart').getContext('2d');
    new Chart(regionsCtx, {
        type: 'pie',
        data: {
            labels: regionsData.map(item => item.name),
            datasets: [{
                data: regionsData.map(item => item.count),
                backgroundColor: ['#667eea', '#764ba2', '#f093fb', '#4facfe', '#00f2fe']
            }]
        }
    });
});
</script>