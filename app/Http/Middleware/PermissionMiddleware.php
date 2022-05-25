<?php

namespace App\Http\Middleware;

use Closure;

Use Auth, Session;
Use App\Action, App\viewPermission;

class PermissionMiddleware
{
   public function handle($request, Closure $next)
   {
      if (Auth::check()) {
         $route = $request->route();
         $nameRoute = $route->action['as'];

         $roleId = Auth::user()->role_id;

         $dataView = viewPermission::where('role_id', $roleId)
         ->where('action_route', $nameRoute)
         ->exists();
         if ($dataView) {
            return $next($request);
         }else{
            $actions = Action::where('reference', $nameRoute)
            ->whereNotNull('parent')
            ->with('getParent')
            ->first();
            if (!empty($actions)) {
               if ($actions->getParent) {
                  $dataViewParent = viewPermission::where('role_id', $roleId)
                  ->where('action_route', $actions->getParent->route)
                  ->exists();
                  if ($dataViewParent) {
                     return $next($request);
                  }
               }
            }

            if ($request->wantsJson()) {return response()->json(['error' => 'Lo siento, no tienes permiso.'], 401);}
            Session::flash('warning', 'Lo siento, no tienes permiso.');
            return back();
         }
      }else{
         if ($request->wantsJson()) {return response()->json(['error' => 'Lo siento, no tienes permiso.'], 401);}
         Session::flash('warning', 'Lo siento, no tienes permiso.');
         return back();
      }
   }
}
