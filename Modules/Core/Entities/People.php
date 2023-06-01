<?php

namespace Modules\Core\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Spatie\ModelStatus\HasStatuses;
use App\Models\User;

class People extends Model
{
    use HasFactory;

    protected $fillable = [ 
        'tipo',
        'name',
        'otherName',
        'lastName',
        'otherLastName',
        'birth',
        'country',
        'city',
        'phone',
        'sex',
        'document',
    ];
    
    protected static function newFactory()
    {
        return \Modules\Core\Database\factories\PeopleFactory::new();
    }

    /**
     * Get Name Complete
     * 
     * @return string
     */
    public function getNameCompleteAttribute()
    {
        return "{$this->name} {$this->lastName}";
    }

    /**
     * Get the users for the people.
     */
    public function user()
    {
        return $this->hasOne(User::class);
    }
}
