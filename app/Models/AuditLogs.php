<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

class AuditLogs extends Model
{
    use HasFactory;
    protected $table = 'audit_log';

    protected static function boot()
    {
        parent::boot();

        static::addGlobalScope('deleted', function (Builder $builder) {
            $builder->where('audit_log.is_deleted','0');
        });
    }

   /* protected $casts = [
        'ip' => 'array',
    ];*/

   /* protected $fillable = [
        'name',
        'token',
        'ip',
    ];*/
}
