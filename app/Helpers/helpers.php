<?php

use App\Helpers\FileHelper;
use App\Models\Admin;
use App\Models\AdminProfile;
use App\Models\Announcement;
use Illuminate\Support\Facades\File;
use Spatie\Permission\Models\Permission;
use Symfony\Component\HttpFoundation\File\UploadedFile;

if (! function_exists('save_image')) {
    function save_image(UploadedFile $file, $maxWidth = 150, $path = null, Closure $callback = null)
    {
        return FileHelper::saveImage($file, $maxWidth, $path, $callback);
    }
}

if (! function_exists('upload_path')) {
    function upload_path()
    {
        return 'uploads';
    }
}

if (!function_exists('make_directory')) {
    function make_directory($dir_names)
    {
        File::ensureDirectoryExists(upload_path(),777);
        if (is_array($dir_names)){
            $path = public_path(upload_path().'/');
            foreach ($dir_names as $dir_name){
                $path .= $dir_name.'/';
            }
        }else{
            $path = public_path(upload_path().'/'.$dir_names);
        }
        File::ensureDirectoryExists($path,777);
        return $path.'/';

    }
}

if (!function_exists('image_exists')) {
    function image_exists($image,$folder)
    {
        if ($image && File::exists(public_path(upload_path()."/$folder/$image"))){
            return asset(upload_path()."/$folder/$image");
        }

        return null;


    }
}

if (! function_exists('default_avatar')) {
    function default_avatar()
    {
        return AdminProfile::DEFAULT_AVATAR_PATH;
    }
}

if (! function_exists('generate_filters')) {
    function generate_filters($filters = [])
    {
        return view('admin.partials.filter', compact('filters'))->render();
    }
}
if (! function_exists('generate_table')) {
    function generate_table($data, $fields, $resource, $cols)
    {
        $update_permission_exists = $permission_exist = Permission::where(['name' => "$resource update"])->exists();
        $access_to_update = (current_admin_role() == Admin::ROLE_SUPER_ADMIN || current_admin()->can("$resource update")) && $update_permission_exists;

        $delete_permission_exists = $permission_exist = Permission::where(['name' => "$resource delete"])->exists();
        $access_to_delete = (current_admin_role() == Admin::ROLE_SUPER_ADMIN || current_admin()->can("$resource delete")) && $delete_permission_exists;

        $disallowed_edit_routes = [
            route('roles.edit', Admin::ROLE_SUPER_ADMIN),
        ];

        $disallowed_delete_routes = [
            route('roles.destroy', Admin::ROLE_SUPER_ADMIN),
            route('admins.destroy', Admin::ROLE_SUPER_ADMIN),
        ];

        return view('admin.partials.table',
            compact(
                'data',
                'fields',
                'resource',
                'cols',
                'access_to_update',
                'access_to_delete',
                'disallowed_edit_routes',
                'disallowed_delete_routes',
            )
        )->render();
    }
}


if (! function_exists('admin_is_logged_in')) {
    function admin_is_logged_in(): bool
    {
        return auth()->guard('admin')->check();
    }
}

if (! function_exists('current_admin')) {
    function current_admin()
    {
        return admin_is_logged_in()
            ? Admin::find(auth()->guard('admin')->user()->id)->load(['profile', 'roles', 'permissions'])
            : null;
    }
}

if (! function_exists('current_admin_role')) {
    function current_admin_role()
    {
        return current_admin() ? current_admin()->roles()->first()->id : null;
    }
}


if (! function_exists('is_super_admin')) {
    function is_super_admin()
    {
        return current_admin_role() == Admin::ROLE_SUPER_ADMIN;
    }
}


if (! function_exists('translations')) {
    function translations()
    {
        $langPath = resource_path('lang/' . app()->getLocale());
        return collect(File::allFiles($langPath))->flatMap(function ($file) {
            return [
                ($translations = $file->getBasename('.php')) => trans($translations),
            ];
        });
    }
}


//if (! function_exists('generateAnnouncementNumber')) {
//    function generateAnnouncementNumber()
//    {
//        do {
//            $number = rand(10000, 9999999);
//        } while (Announcement::where("number", $number)->first());
//
//        return $number;
//    }
//}

