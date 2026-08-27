<?php

namespace App\Modules\Log\Models;

use stdClass;
use App\Helpers\UsesUuid;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Log extends Model
{
	use SoftDeletes;
	use UsesUuid;

	protected $casts      = ['deleted_at' => 'datetime', 'created_at' => 'datetime', 'updated_at' => 'datetime'];
	protected $table      = 'log';
	protected $fillable   = ['*'];

	public function user()
	{
		return $this->belongsTo(User::class, 'id_user', 'id');
	}

	public function record(Request $request, $activity, $context = null, $data = null)
	{
		$route = $request->route()?->getName();
		$elm = $route ? explode('.', $route) : [];
		$action = $elm ? end($elm) : null;
		$webUser = Auth::guard('web')->user();

		if (! $webUser) {
			return;
		}

		$this->id_user = $webUser->id;
		$this->name = $webUser->name ?? 'Guest';
		$this->aktivitas = $activity;
		$this->route = $route;
		$this->action = $action;
		$this->context = $context == null ? null : json_encode($context);
		$this->data = $data == null ? null : json_encode($data);
		$this->ip_address = $request->ip();
		$this->user_agent = $request->userAgent();
		$this->save();

	}
}
