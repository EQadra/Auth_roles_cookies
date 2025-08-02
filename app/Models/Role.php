<?php

namespace App\Models;

use Spatie\Permission\Models\Role as SpatieRole;
use Illuminate\Database\Eloquent\Casts\Attribute;

class Role extends SpatieRole
{
    /**
     * Accesor personalizado: nombre en mayúsculas al acceder.
     */
    protected function name(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => strtoupper($value),
        );
    }

    /**
     * Relación personalizada: por ejemplo, qué usuarios tienen este rol.
     */
    // public function users()
    // {
    //     return $this->morphedByMany(User::class, 'model', 'model_has_roles');
    // }

    /**
     * Método útil adicional.
     */
    public function isAdmin()
    {
        return $this->name === 'admin';
    }
}
