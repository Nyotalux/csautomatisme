<?php
namespace app\components;

use Yii;
use yii\base\Widget;

class MenuWidget extends Widget
{
    public function run()
    {
        $user = Yii::$app->user->identity;
        $menu = [];
        
        if ($user) {
            // Menu principal
            $menu[] = ['label' => 'Dashboard', 'url' => ['/extranet/default/index'], 'icon' => 'dashboard'];
            
            // Services - selon permission
            if ($user->role && $user->role->slug === 'admin') {
                $menu[] = ['label' => 'Services', 'url' => ['/extranet/service/index'], 'icon' => 'cog'];
                $menu[] = ['label' => 'Secteurs', 'url' => ['/extranet/sector/index'], 'icon' => 'tags'];
                $menu[] = ['label' => 'Départements', 'url' => ['/extranet/department/index'], 'icon' => 'building'];
                $menu[] = ['label' => 'Régions', 'url' => ['/extranet/region/index'], 'icon' => 'map-marker'];
                $menu[] = ['label' => 'Utilisateurs', 'url' => ['/extranet/user/index'], 'icon' => 'users'];
                $menu[] = ['label' => 'Rôles', 'url' => ['/extranet/role/index'], 'icon' => 'key'];
                $menu[] = ['label' => 'Blog', 'url' => ['/extranet/post/index'], 'icon' => 'newspaper'];
                $menu[] = ['label' => 'Témoignages', 'url' => ['/extranet/testimonial/index'], 'icon' => 'comment'];
            } else {
                // Menu limité pour les autres rôles
                if ($user->service_id) {
                    $menu[] = ['label' => 'Mon Service', 'url' => ['/extranet/service/view', 'id' => $user->service_id], 'icon' => 'cog'];
                }
                if ($user->sector_id) {
                    $menu[] = ['label' => 'Mon Secteur', 'url' => ['/extranet/sector/view', 'id' => $user->sector_id], 'icon' => 'tags'];
                }
                $menu[] = ['label' => 'Mon Profil', 'url' => ['/extranet/user/profile'], 'icon' => 'user'];
            }
        }
        
        return $this->render('menu', ['menu' => $menu]);
    }
}