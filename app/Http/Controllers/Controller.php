<?php

namespace App\Http\Controllers;

use Auth;
use Modules\Core\Entities\App;
use Modules\Core\Entities\Module;
use Modules\Core\Entities\Permission;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;

    protected $role = 'CORE-ADMIN';

    public function getInfo($data)
    {
        $module = $this->getModule();
        $permission = $this->getPermission();
        return [
            'module' => $module,
            'permission' => $permission,
            'data' => $data
        ];
    }

    public function getModule()
    {
        $user = Auth::user();
        $appName = request()->segment(1) ?? 'core';
        $app = $user->apps()->where(['name' => $appName])->first();
        if (!$app) return null;
        $controller = request()->segment(2) ?? 'home';
        $action = request()->segment(3)?? 'index';
        $module = $app->modules()->where([
            'controller' => $controller,
            'action' => $action
        ])->first();

        return $module;
    }


    public function getPermission()
    {
        $module = $this->getModule();
        $moduleID = $module->id;
        $userRoles = Auth::user()
            ->roles()
            ->where('app_id', $module->app->id)
            ->pluck('name')
            ->toArray();
        
        if(in_array($this->role, $userRoles)) {
            return Permission::where('module_id', $moduleID)
                ->orderBy('name')
                ->distinct('name')
                ->pluck('name')
                ->toArray();
        }

        return $userRoles; 
    }

}
