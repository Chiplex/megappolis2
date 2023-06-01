<?php

namespace Modules\Core\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Spatie\ModelStatus\HasStatuses;
use Modules\Core\Entities\App;
use Modules\Core\Entities\Permission;
use Modules\Core\Entities\Role;

class Module extends Model
{
    use HasFactory, HasStatuses;

    protected $fillable = [
        'app_id',
        'controller',
        'action',
        'name',
        'description',
        'type',
        'icon',
        'module_id'
    ];
    
    protected static function newFactory()
    {
        return \Modules\Core\Database\factories\ModuleFactory::new();
    }

    /**
     * Get the app that owns the page.
     */
    public function app()
    {
        return $this->belongsTo(App::class);
    }

    /**
     * Get all of the modules for the Page
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function modules()
    {
        return $this->hasMany(Module::class);
    }

    /**
     * Get the Module that owns the Module
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function module()
    {
        return $this->belongsTo(Module::class);
    }

    /**
     * Get the persmisions that owns the Page
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function permissions()
    {
        return $this->hasMany(Permission::class);
    }

    /**
     * Get the roles that owns the Page
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function roles()
    {
        return $this->belongsToMany(Role::class);
    }

    /**
     * Build the view
     * 
     * @param array $modules
     */
    public static function buildView($modules)
    {
        return $this->app->name.'::'.$this->controller.'\\'.$this->action;
    }

    /**
     * Build the title
     *
     * @return string
     */
    public function buildTitle()
    {
        return $this->name;
    }

    /**
     * Build the url of the page
     *
     * @return string
     */
    public function buildUrl()
    {
        return $this->app->name.'/'.$this->controller.'/'.$this->action;
    }

    /**
     * Build the breadcrumbs as tree of the page and return it as an array
     *
     * @return array
     */
    public function buildBreadcrumbs($currentPage)
    {
        $breadcrumbs = [];

        $breadcrumbs[] = [
            'name' => ucfirst($this->app->name),
            'url' => '/yeipi',
            'active' => false
        ];

        if($currentPage->type == 'page'){
            $breadcrumbs[] = [
                'name' => $currentPage->name,
                'url' => "#",
                'active' => false
            ];
        }
        else{
            $breadcrumbs[] = [
                'url' => $this->buildUrl(),
                'name' => $this->name,
                'active' => $currentPage->id == $this->id
            ];
        }

        if ($currentPage->id != null) {
            $page = Page::firstWhere('page_id', $this->page_id);
            if ($page != null) {
                $breadcrumbs = array_merge($breadcrumbs, $this->buildBreadcrumbs($page));
            }
        }

        return $breadcrumbs;
    }
}
