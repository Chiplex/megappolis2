<?php

namespace Modules\Core\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Spatie\ModelStatus\HasStatuses;
use Modules\Core\Entities\Module;
use Modules\Core\Entities\Role;

class Permission extends Model
{
    use HasFactory;

    protected $fillable = ['role_id', 'module_id', 'name'];
    
    protected static function newFactory()
    {
        return \Modules\Core\Database\factories\PermissionFactory::new();
    }

    /**
     * Get the module for the permission.
     */
    public function module()
    {
        return $this->belongsTo(Module::class);
    }

    /**
     * Get the role for the permission.
     */
    public function role()
    {
        return $this->belongsTo(Role::class);
    }
}
