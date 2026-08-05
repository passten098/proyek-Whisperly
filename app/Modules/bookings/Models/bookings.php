<?php

namespace App\Modules\bookings\Models;

use App\Helpers\UsesUuid;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Modules\Pengguna\Models\Pengguna;
use App\Modules\Talent\Models\Talent;


class bookings extends Model
{
	use SoftDeletes;
	use UsesUuid;

	protected $casts      = ['deleted_at' => 'datetime', 'created_at' => 'datetime', 'updated_at' => 'datetime'];
	protected $table      = 'bookings';
	protected $fillable   = ['*'];

	public function pengguna(){
		return $this->belongsTo(Pengguna::class,"id_pengguna","id");
	}
public function talent(){
		return $this->belongsTo(Talent::class,"id_talent","id");
	}

}
