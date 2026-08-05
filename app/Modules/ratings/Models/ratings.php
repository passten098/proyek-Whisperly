<?php

namespace App\Modules\ratings\Models;

use App\Helpers\UsesUuid;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Modules\Booking\Models\Booking;
use App\Modules\Pengguna\Models\Pengguna;


class ratings extends Model
{
	use SoftDeletes;
	use UsesUuid;

	protected $casts      = ['deleted_at' => 'datetime', 'created_at' => 'datetime', 'updated_at' => 'datetime'];
	protected $table      = 'ratings';
	protected $fillable   = ['*'];

	public function booking(){
		return $this->belongsTo(Booking::class,"id_booking","id");
	}
public function pengguna(){
		return $this->belongsTo(Pengguna::class,"id_pengguna","id");
	}

}
