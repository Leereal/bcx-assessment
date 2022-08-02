<?php
if (!function_exists('has_permission')) {
    function has_permission($name) {
        $user = auth()->user();
        if ($user->role->id == 1) {
            return true;
        }
        $permission_list = $user->role->permissions;
        $permission      = $permission_list->firstWhere('permission', $name);

        if ($permission != null) {
            return true;
        }
        return false;
    }
}

if (!function_exists('permission_list')) {
    function permission_list() {

        $permission_list = \App\Models\Permission::where("role_id", auth()->user()->role_id)
            ->pluck('permission')->toArray();
        return $permission_list;
    }
}
