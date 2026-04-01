<?php
use yii\helpers\Html;
use yii\helpers\Url;

// Statistiques globales
$totalServices = $stats['total_services'];
$totalSectors = $stats['total_sectors'];
$totalRegions = $stats['total_regions'];
$totalUsers = $stats['total_users'];
$totalPosts = $stats['total_posts'];
$totalTestimonials = $stats['total_testimonials'];
?>

<!-- Cartes de statistiques -->
<div class="row mb-4">
    <div class="col-md-6 col-lg-3 mb-3">
        <div class="card dashboard-card shadow-sm">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h6 class="text-muted mb-2">Services</h6>
                        <h2 class="mb-0"><?= $totalServices ?></h2>
                    </div>
                    <div class="stat-icon bg-primary bg-opacity-10">
                        <i class="fas fa-cogs text-primary"></i>
                    </div>
                </div>
                <?= Html::a('Voir tout', ['/extranet/service/index'], ['class' => 'small text-decoration-none mt-2 d-inline-block']) ?>
            </div>
        </div>
    </div>
    
    <div class="col-md-6 col-lg-3 mb-3">
        <div class="card dashboard-card shadow-sm">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h6 class="text-muted mb-2">Secteurs</h6>
                        <h2 class="mb-0"><?= $totalSectors ?></h2>
                    </div>
                    <div class="stat-icon bg-success bg-opacity-10">
                        <i class="fas fa-tags text-success"></i>
                    </div>
                </div>
                <?= Html::a('Voir tout', ['/extranet/sector/index'], ['class' => 'small text-decoration-none mt-2 d-inline-block']) ?>
            </div>
        </div>
    </div>
    
    <div class="col-md-6 col-lg-3 mb-3">
        <div class="card dashboard-card shadow-sm">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h6 class="text-muted mb-2">Régions</h6>
                        <h2 class="mb-0"><?= $totalRegions ?></h2>
                    </div>
                    <div class="stat-icon bg-info bg-opacity-10">
                        <i class="fas fa-map-marker-alt text-info"></i>
                    </div>
                </div>
                <?= Html::a('Voir tout', ['/extranet/region/index'], ['class' => 'small text-decoration-none mt-2 d-inline-block']) ?>
            </div>
        </div>
    </div>
    
    <div class="col-md-6 col-lg-3 mb-3">
        <div class="card dashboard-card shadow-sm">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h6 class="text-muted mb-2">Utilisateurs</h6>
                        <h2 class="mb-0"><?= $totalUsers ?></h2>
                    </div>
                    <div class="stat-icon bg-warning bg-opacity-10">
                        <i class="fas fa-users text-warning"></i>
                    </div>
                </div>
                <?= Html::a('Voir tout', ['/extranet/user/index'], ['class' => 'small text-decoration-none mt-2 d-inline-block']) ?>
            </div>
        </div>
    </div>
    
    <div class="col-md-6 col-lg-3 mb-3">
        <div class="card dashboard-card shadow-sm">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h6 class="text-muted mb-2">Articles</h6>
                        <h2 class="mb-0"><?= $totalPosts ?></h2>
                    </div>
                    <div class="stat-icon bg-danger bg-opacity-10">
                        <i class="fas fa-newspaper text-danger"></i>
                    </div>
                </div>
                <?= Html::a('Voir tout', ['/extranet/post/index'], ['class' => 'small text-decoration-none mt-2 d-inline-block']) ?>
            </div>
        </div>
    </div>
    
    <div class="col-md-6 col-lg-3 mb-3">
        <div class="card dashboard-card shadow-sm">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h6 class="text-muted mb-2">Témoignages</h6>
                        <h2 class="mb-0"><?= $totalTestimonials ?></h2>
                    </div>
                    <div class="stat-icon bg-secondary bg-opacity-10">
                        <i class="fas fa-star text-secondary"></i>
                    </div>
                </div>
                <?= Html::a('Voir tout', ['/extranet/testimonial/index'], ['class' => 'small text-decoration-none mt-2 d-inline-block']) ?>
            </div>
        </div>
    </div>
</div>

<!-- Graphiques et répartitions -->
<div class="row mb-4">
    <div class="col-lg-6 mb-3">
        <div class="card shadow-sm">
            <div class="card-header bg-white">
                <h5 class="mb-0">Répartition par service</h5>
            </div>
            <div class="card-body">
                <canvas id="servicesChart" height="250"></canvas>
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

<!-- Derniers utilisateurs et activités -->
<div class="row">
    <div class="col-lg-6 mb-3">
        <div class="card shadow-sm">
            <div class="card-header bg-white">
                <h5 class="mb-0">Derniers utilisateurs</h5>
            </div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover mb-0">
                        <thead>
                            <tr>
                                <th>Utilisateur</th>
                                <th>Rôle</th>
                                <th>Service</th>
                                <th>Date</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($stats['recent_users'] as $user): ?>
                            <tr>
                                <td>
                                    <strong><?= Html::encode($user->getFullName()) ?></strong><br>
                                    <small class="text-muted"><?= Html::encode($user->username) ?></small>
                                </td>
                                <td><?= $user->role ? $user->role->name : '-' ?></td>
                                <td><?= $user->service ? $user->service->name : '-' ?></td>
                                <td><?= Yii::$app->formatter->asDate($user->created_at) ?></td>
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="card-footer bg-white">
                <?= Html::a('Voir tous les utilisateurs', ['/extranet/user/index'], ['class' => 'btn btn-sm btn-outline-primary']) ?>
            </div>
        </div>
    </div>
    
    <div class="col-lg-6 mb-3">
        <div class="card shadow-sm">
            <div class="card-header bg-white">
                <h5 class="mb-0">Activités récentes</h5>
            </div>
            <div class="card-body">
                <div class="activity-timeline">
                    <?php foreach ($stats['recent_activities'] as $activity): ?>
                    <div class="activity-item">
                        <div class="activity-icon bg-<?= $activity['color'] ?> bg-opacity-10">
                            <i class="<?= $activity['icon'] ?> text-<?= $activity['color'] ?>"></i>
                        </div>
                        <div class="ms-3">
                            <strong><?= Html::encode($activity['title']) ?></strong><br>
                            <small class="text-muted"><?= $activity['description'] ?></small><br>
                            <small class="text-muted">
                                <i class="far fa-clock"></i> <?= Yii::$app->formatter->asRelativeTime($activity['time']) ?>
                            </small>
                        </div>
                    </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Articles les plus vus -->
<div class="row">
    <div class="col-12 mb-3">
        <div class="card shadow-sm">
            <div class="card-header bg-white">
                <h5 class="mb-0">Articles les plus consultés</h5>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>Titre</th>
                                <th>Vues</th>
                                <th>Date</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($stats['top_posts'] as $post): ?>
                            <tr>
                                <td><?= Html::encode($post->title) ?></td>
                                <td><span class="badge bg-primary"><?= $post->views ?> vues</span></td>
                                <td><?= Yii::$app->formatter->asDate($post->created_at) ?></td>
                                <td>
                                    <?= Html::a('Voir', ['/blog/view', 'slug' => $post->slug], ['class' => 'btn btn-sm btn-outline-primary', 'target' => '_blank']) ?>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Chart.js pour les graphiques -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Graphique des services
    var servicesCtx = document.getElementById('servicesChart').getContext('2d');
    var servicesData = <?= json_encode(array_map(function($item) {
        return ['name' => $item['name'], 'count' => $item['count']];
    }, $stats['services_distribution'])) ?>;
    
    new Chart(servicesCtx, {
        type: 'bar',
        data: {
            labels: servicesData.map(item => item.name),
            datasets: [{
                label: 'Nombre de secteurs',
                data: servicesData.map(item => item.count),
                backgroundColor: 'rgba(102, 126, 234, 0.5)',
                borderColor: 'rgba(102, 126, 234, 1)',
                borderWidth: 1
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: true,
            scales: {
                y: {
                    beginAtZero: true,
                    ticks: { stepSize: 1 }
                }
            }
        }
    });
    
    // Graphique des régions
    var regionsCtx = document.getElementById('regionsChart').getContext('2d');
    var regionsData = <?= json_encode(array_filter(array_map(function($item) {
        return $item['name'] ? ['name' => $item['name'], 'count' => $item['count']] : null;
    }, $stats['regions_distribution']))) ?>;
    
    new Chart(regionsCtx, {
        type: 'pie',
        data: {
            labels: regionsData.map(item => item.name),
            datasets: [{
                data: regionsData.map(item => item.count),
                backgroundColor: [
                    'rgba(102, 126, 234, 0.8)',
                    'rgba(118, 75, 162, 0.8)',
                    'rgba(255, 99, 132, 0.8)',
                    'rgba(54, 162, 235, 0.8)',
                    'rgba(255, 206, 86, 0.8)',
                    'rgba(75, 192, 192, 0.8)'
                ]
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: true
        }
    });
});
</script>