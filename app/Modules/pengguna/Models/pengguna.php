<?php
namespace App\Modules\pengguna\Models;
use App\Helpers\UsesUuid;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\SoftDeletes;

class pengguna extends Authenticatable
{
        use SoftDeletes;
        use UsesUuid;
        use Notifiable;

        protected $casts      = ['deleted_at' => 'datetime', 'created_at' => 'datetime', 'updated_at' => 'datetime'];
        protected $table      = 'pengguna';
        protected $fillable   = ['username', 'email', 'password', 'role', 'created_by', 'updated_by', 'deleted_by'];
        protected $hidden     = ['password', 'remember_token'];
}