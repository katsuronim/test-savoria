<?php

namespace App\Http\Controllers;

use App\Http\Requests\MapAppsUserRequest;
use App\Models\apps;
use App\Models\map_users_apps;
use App\Models\User;
use Illuminate\Http\Request;

class MapUserController extends Controller
{
    public function index(){
        $maps = map_users_apps::join('users', 'map_users_apps.user_id', '=', 'users.user_id')
                                ->join('apps', 'map_users_apps.app_id', '=', 'apps.app_id')
                                ->orderBy('map_users_apps.app_id', 'asc')
                                ->paginate(8);

        return view('pages.admin-mapapps', compact('maps'));
    }
    public function indexUser()
    {
        $apps = apps::paginate(8);
        return view('pages.user-apps', compact('apps'));
    }

    public function create()
    {
        $apps = apps::all();
        $users = User::all();

        return view('pages.admin-mapapps-create', compact('apps','users'));
    }

    public function store(MapAppsUserRequest $request)
    {
        $maps = map_users_apps::create([
            'app_id' => $request->app_id,
            'user_id' => $request->user_id,
            'data_status' => $request->data_status,
        ]);
        toastr()->success('Data hak akses aplikasi baru berhasil disimpan!');

        // Redirect with success message or return a response
        return redirect()->route('admin.map-apps-user');
    }

    public function search(Request $request)
    {
        $keyword = $request->input('keyword');

        $maps = map_users_apps::join('users', 'map_users_apps.user_id', '=', 'users.user_id')
                                ->join('apps', 'map_users_apps.app_id', '=', 'apps.app_id')
                                ->where('apps.app_code', 'like', '%' . $keyword . '%')
                                ->orWhere('apps.app_name', 'like', '%' . $keyword . '%')
                                ->orWhere('users.user_code', 'like', '%' . $keyword . '%')
                                ->orWhere('users.user_fullname', 'like', '%' . $keyword . '%')
                                ->orWhere('map_users_apps.data_status', 'like', '%' . $keyword . '%')
                                ->orderBy('map_users_apps.app_id', 'asc')
                                ->paginate(8);

        return view('pages.admin-mapapps', compact('maps'));
    }

    public function edit($id)
    {
        $maps = map_users_apps::findOrFail($id);
        $users = User::all();
        $apps = apps::all();

        return view('pages.admin-mapapps-edit', compact('maps', 'users', 'apps'));
    }

    public function update(MapAppsUserRequest $request, $id)
    {
        $maps = map_users_apps::findOrFail($id);

        $data = map_users_apps::join('users', 'map_users_apps.user_id', '=', 'users.user_id')
                                ->join('apps', 'map_users_apps.app_id', '=', 'apps.app_id')
                                ->findOrFail($id);;

        $maps->app_id = $request->app_id;
        $maps->user_id = $request->user_id;
        $maps->data_status = $request->data_status;

        $maps->save();

        toastr()->success('Data hak akses aplikasi ' . $data->app_name . ' untuk pengguna ' . $data->user_fullname . ' berhasil disimpan!');

        // Redirect with success message or return a response
        return redirect()->route('admin.map-apps-user');
    }

    public function destroy($id)
    {
        // Dapatkan data yang ingin dihapus
        $data = map_users_apps::join('users', 'map_users_apps.user_id', '=', 'users.user_id')
                                ->join('apps', 'map_users_apps.app_id', '=', 'apps.app_id')
                                ->findOrFail($id);

        $maps = map_users_apps::findOrFail($id);;

        // Hapus data
        $maps->delete();
        toastr()->success('Hak akses aplikasi ' . $data->app_name . ' untuk pengguna ' . $data->user_fullname . ' berhasil dihapus!');

        return redirect()->route('admin.map-apps-user');
    }
}
