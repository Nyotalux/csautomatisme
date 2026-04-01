<?php

namespace app\modules\extranet\controllers;

use Yii;
use yii\web\Controller;
use yii\filters\AccessControl;
use app\models\Service;
use app\models\Sector;
use app\models\Region;
use app\models\User;
use app\models\Post;
use app\models\Testimonial;
use yii\db\Expression;

class DashboardController extends Controller
{
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::class,
                'rules' => [
                    [
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
        ];
    }

    public function actionIndex()
    {
        $user = Yii::$app->user->identity;
        
        // Statistiques selon le rôle
        if ($user->role && $user->role->slug === 'admin') {
            // Admin - voit toutes les statistiques
            $stats = $this->getAdminStats();
        } elseif ($user->role && $user->role->slug === 'service_manager') {
            // Responsable de service - voit les stats de son service
            $stats = $this->getServiceManagerStats($user);
        } else {
            // Technicien, commercial - voit ses propres stats limitées
            $stats = $this->getUserStats($user);
        }
        
        return $this->render('index', [
            'stats' => $stats,
            'user' => $user,
        ]);
    }
    
   private function getAdminStats()
{
    // Statistiques globales pour admin
    $stats = [
        'total_services' => Service::find()->count(),
        'total_sectors' => Sector::find()->count(),
        'total_regions' => Region::find()->count(),
        'total_users' => User::find()->count(),
        'total_posts' => Post::find()->where(['status' => 1])->count(),
        'total_testimonials' => Testimonial::find()->where(['status' => 1])->count(),
        
        // Répartition par service - CORRIGÉ
        'services_distribution' => Service::find()
            ->select(['service.name as name', 'COUNT(sector.id) as count']) // Spécifier la table
            ->leftJoin('sector', 'service.id = sector.service_id')
            ->groupBy('service.id')
            ->asArray()
            ->all(),
        
        // Répartition par région - CORRIGÉ
        'regions_distribution' => Region::find()
            ->select(['region.name as name', 'COUNT(user.id) as count']) // Spécifier la table
            ->leftJoin('user', 'region.id = user.region_id')
            ->groupBy('region.id')
            ->asArray()
            ->all(),
        
        // Derniers utilisateurs
        'recent_users' => User::find()
            ->orderBy(['created_at' => SORT_DESC])
            ->limit(5)
            ->all(),
        
        // Activités récentes
        'recent_activities' => $this->getRecentActivities(),
        
        // Statistiques de vues des articles
        'top_posts' => Post::find()
            ->orderBy(['views' => SORT_DESC])
            ->limit(5)
            ->all(),
    ];
    
    return $stats;
}
    
private function getServiceManagerStats($user)
{
    $service = $user->service;
    
    if (!$service) {
        return $this->getUserStats($user);
    }
    
    $stats = [
        'service_name' => $service->name,
        'total_sectors' => Sector::find()->where(['service_id' => $service->id])->count(),
        'total_users' => User::find()->where(['service_id' => $service->id])->count(),
        'total_regions' => User::find()
            ->select(['region_id'])
            ->where(['service_id' => $service->id])
            ->andWhere(['not', ['region_id' => null]])
            ->distinct()
            ->count(),
        
        // Secteurs du service
        'sectors' => Sector::find()
            ->where(['service_id' => $service->id])
            ->all(),
        
        // Utilisateurs par secteur - CORRIGÉ
        'users_by_sector' => Sector::find()
            ->select(['sector.name as name', 'COUNT(user.id) as count']) // Spécifier la table
            ->leftJoin('user', 'sector.id = user.sector_id')
            ->where(['sector.service_id' => $service->id])
            ->groupBy('sector.id')
            ->asArray()
            ->all(),
        
        // Répartition par région pour ce service - CORRIGÉ
        'regions_distribution' => User::find()
            ->select(['region.name as name', 'COUNT(user.id) as count']) // Spécifier la table
            ->leftJoin('region', 'region.id = user.region_id')
            ->where(['user.service_id' => $service->id])
            ->andWhere(['not', ['user.region_id' => null]])
            ->groupBy('user.region_id')
            ->asArray()
            ->all(),
        
        // Dernières activités
        'recent_activities' => $this->getRecentActivities($service->id),
    ];
    
    return $stats;
}
private function getUserStats($user)
{
    $stats = [
        'username' => $user->username,
        'full_name' => $user->getFullName(),
        'role' => $user->role ? $user->role->name : 'Utilisateur',
        'service' => $user->service ? $user->service->name : 'Non assigné',
        'sector' => $user->sector ? $user->sector->name : 'Non assigné',
        'region' => $user->region ? $user->region->name : 'Non assigné',
        'last_login' => $user->last_login,
        'joined_date' => $user->created_at,
        
        // Ses propres statistiques
        'my_activities' => $this->getUserActivities($user->id),
    ];
    
    return $stats;
}
    private function getRecentActivities($serviceId = null)
    {
        // Simuler des activités récentes
        $activities = [];
        
        // Derniers articles publiés
        $query = Post::find()->orderBy(['created_at' => SORT_DESC])->limit(3);
        if ($serviceId) {
            // Ici vous pouvez ajouter une relation si les posts sont liés aux services
        }
        $recentPosts = $query->all();
        
        foreach ($recentPosts as $post) {
            $activities[] = [
                'type' => 'post',
                'title' => $post->title,
                'description' => 'Nouvel article publié',
                'time' => $post->created_at,
                'icon' => 'fas fa-newspaper',
                'color' => 'info',
            ];
        }
        
        // Derniers utilisateurs
        $query = User::find()->orderBy(['created_at' => SORT_DESC])->limit(3);
        if ($serviceId) {
            $query->where(['service_id' => $serviceId]);
        }
        $recentUsers = $query->all();
        
        foreach ($recentUsers as $user) {
            $activities[] = [
                'type' => 'user',
                'title' => $user->getFullName(),
                'description' => 'Nouvel utilisateur inscrit',
                'time' => $user->created_at,
                'icon' => 'fas fa-user-plus',
                'color' => 'success',
            ];
        }
        
        // Témoignages récents
        $recentTestimonials = Testimonial::find()
            ->orderBy(['created_at' => SORT_DESC])
            ->limit(3)
            ->all();
        
        foreach ($recentTestimonials as $testimonial) {
            $activities[] = [
                'type' => 'testimonial',
                'title' => $testimonial->client_name,
                'description' => 'Nouveau témoignage reçu',
                'time' => $testimonial->created_at,
                'icon' => 'fas fa-star',
                'color' => 'warning',
            ];
        }
        
        // Trier par date
        usort($activities, function($a, $b) {
            return strtotime($b['time']) - strtotime($a['time']);
        });
        
        return array_slice($activities, 0, 10);
    }
    
    private function getUserActivities($userId)
    {
        // Simuler les activités d'un utilisateur spécifique
        $activities = [];
        
        // Dernières connexions
        $activities[] = [
            'type' => 'login',
            'description' => 'Dernière connexion',
            'time' => date('Y-m-d H:i:s'),
            'icon' => 'fas fa-sign-in-alt',
            'color' => 'primary',
        ];
        
        return $activities;
    }
}