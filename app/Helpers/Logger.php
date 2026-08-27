<?php
namespace App\Helpers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Modules\Log\Models\Log;

trait Logger{

	public function log(Request $request, $activity, $context = NULL, $data = NULL)
	{
		$route = $request->route()?->getName();
		$elm = $route ? explode('.', $route) : [];
		$action = $elm ? end($elm) : null;
		$webUser = Auth::guard('web')->user();

		if (! $webUser) {
			return;
		}

		$log = $this->log;
		$log->id_user = $webUser->id;
		$log->name = $webUser->name ?? 'Guest';
		$log->aktivitas = $activity;
		$log->route = $route;
		$log->action = $action;
		$log->context = $context == null ? null : json_encode($context);
		$log->data = $data == null ? null : json_encode($data);
		$log->ip_address = $request->ip();
		$log->user_agent = $request->userAgent();
		$log->save();
	}

}
