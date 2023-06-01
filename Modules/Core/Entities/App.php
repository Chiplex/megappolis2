<?php

namespace Modules\Core\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Spatie\ModelStatus\HasStatuses;
use App\Models\User;
use Modules\Core\Entities\Page;

class App extends Model
{
    const STATUS_PENDING = 'pending';
    const STATUS_APPROVED = 'approved';
    const STATUS_REJECTED = 'rejected';

    use HasFactory, HasStatuses;

    protected $fillable = [
        'name',
        'type',
        'user_id',
        'description',
        'url',
    ];
    
    protected static function newFactory()
    {
        return \Modules\Core\Database\factories\AppFactory::new();
    }

    /**
     * Get the modules for the app.
     */
    public function modules()
    {
        return $this->hasMany(Module::class);
    }

    /**
     * Get the app that owns the user.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
