<?php

namespace App\Modules\menfess\Models;

use App\Helpers\UsesUuid;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Modules\Pengguna\Models\Pengguna;
use App\Modules\Kategori\Models\Kategori;


class menfess extends Model
{
	use SoftDeletes;
	use UsesUuid;

	protected $casts      = ['deleted_at' => 'datetime', 'created_at' => 'datetime', 'updated_at' => 'datetime'];
	protected $table      = 'menfess';
	protected $fillable   = ['*'];

	public function pengguna(){
		return $this->belongsTo(Pengguna::class,"id_pengguna","id");
	}
public function kategori(){
		return $this->belongsTo(Kategori::class,"id_kategori","id");
	}

}
