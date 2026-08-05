<?php

namespace App\Modules\comments\Models;

use App\Helpers\UsesUuid;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Modules\Menfess\Models\Menfess;
use App\Modules\Pengguna\Models\Pengguna;


class comments extends Model
{
	use SoftDeletes;
	use UsesUuid;

	protected $casts      = ['deleted_at' => 'datetime', 'created_at' => 'datetime', 'updated_at' => 'datetime'];
	protected $table      = 'comments';
	protected $fillable   = ['*'];

	public function menfess(){
		return $this->belongsTo(Menfess::class,"id_menfess","id");
	}
public function pengguna(){
		return $this->belongsTo(Pengguna::class,"id_pengguna","id");
	}

}
