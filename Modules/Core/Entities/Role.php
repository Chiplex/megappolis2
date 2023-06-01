<?php

namespace Modules\Core\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\User;
use Modules\Core\Entities\App;
use Modules\Core\Entities\Module;
use Modules\Core\Entities\Permission;

class Role extends Model
{
    use HasFactory;

    protected $fillable = [];
    
    protected static function newFactory()
    {
        return \Modules\Core\Database\factories\RoleFactory::new();
    }

    /**
     * The roles that belong to the modules.
     */
    public function modules()
    {
        return $this->belongsToMany(Module::class, Permission::class);
    }

    /**
     * Get the permissions for the role.
     */
    public function permissions()
    {
        return $this->hasMany(Permission::class);
    }

    /**
     * The roles that belong to the users.
     */
    public function users()
    {
        return $this->belongsToMany(User::class, 'roles_users');
    }

    /**
     * Get the app that owns the Role
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function app()
    {
        return $this->belongsTo(App::class);
    }
}
