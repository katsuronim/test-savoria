<?php

namespace App\Http\Controllers;

use App\Http\Requests\MapAppsUserRequest;
use App\Models\apps;
use App\Models\map_users_apps;
use App\Models\User;
use Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MapUserController extends Controller
{
    public function index(){
        $maps = map_users_apps::join('users', 'map_users_apps.user_id', '=', 'users.user_id')
                                ->join('apps', 'map_users_apps.app_id', '=', 'apps.app_id')
                                ->select('map_users_apps.id', 'apps.app_code', 'apps.app_name', 'map_users_apps.user_id', 'users.user_code', 'users.user_fullname', 'map_users_apps.data_status')
                                ->orderBy('map_users_apps.user_id', 'asc')
                                ->paginate(8);


        return view('pages.admin-mapapps', compact('maps'));
    }

    public function getUserAppView()
    {
        $data = DB::table('user_apps_view')->orderBy('user_id')->paginate(8);

        return view('pages.admin-mapapps-view', compact('data'));
    }

    public function indexUser()
    {
        $user = Auth::user();
        $maps = map_users_apps::join('apps', 'map_users_apps.app_id', '=', 'apps.app_id')
                                ->where('user_id', $user->user_id)
                                ->where('map_users_apps.data_status', TRUE)
                                ->paginate(8);
        return view('pages.user-apps', compact('maps'));
    }

    public function create()
    {
        $apps = apps::where('data_status', TRUE)->get();
        $users = User::where('data_status', TRUE)->get();

        return view('pages.admin-mapapps-create', compact('apps','users'));
    }

    public function store(MapAppsUserRequest $request)
    {
        $user_id = $request->user_id;
        $data_status = $request->data_status;

        foreach ($request->app_ids as $app_id) {
            map_users_apps::create([
                'app_id' => $app_id,
                'user_id' => $user_id,
                'data_status' => $data_status,
            ]);
        }

        toastr()->success('Data hak akses aplikasi baru berhasil disimpan!');

        // Redirect with success message or return a response
        return redirect()->route('admin.map-apps-user');
    }


    public function search(Request $request)
    {
        $keyword = $request->input('keyword');

        if(strtolower($keyword) == "aktif"){
            $maps = map_users_apps::join('users', 'map_users_apps.user_id', '=', 'users.user_id')
                                ->join('apps', 'map_users_apps.app_id', '=', 'apps.app_id')
                                ->select('map_users_apps.id', 'apps.app_code', 'apps.app_name', 'map_users_apps.user_id', 'users.user_code', 'users.user_fullname', 'map_users_apps.data_status')
                                ->where('map_users_apps.data_status', TRUE)
                                ->orderBy('map_users_apps.user_id', 'asc')
                                ->paginate(8);
        } else if (strtolower($keyword) == "tidak aktif"){
            $maps = map_users_apps::join('users', 'map_users_apps.user_id', '=', 'users.user_id')
                                ->join('apps', 'map_users_apps.app_id', '=', 'apps.app_id')
                                ->select('map_users_apps.id', 'apps.app_code', 'apps.app_name', 'map_users_apps.user_id', 'users.user_code', 'users.user_fullname', 'map_users_apps.data_status')
                                ->where('map_users_apps.data_status', FALSE)
                                ->orderBy('map_users_apps.user_id', 'asc')
                                ->paginate(8);
        } else {
            $maps = map_users_apps::join('users', 'map_users_apps.user_id', '=', 'users.user_id')
                                    ->join('apps', 'map_users_apps.app_id', '=', 'apps.app_id')
                                    ->select('map_users_apps.id', 'apps.app_code', 'apps.app_name', 'map_users_apps.user_id', 'users.user_code', 'users.user_fullname', 'map_users_apps.data_status')
                                    ->where('apps.app_code', 'like', '%' . $keyword . '%')
                                    ->orWhere('apps.app_name', 'like', '%' . $keyword . '%')
                                    ->orWhere('users.user_code', 'like', '%' . $keyword . '%')
                                    ->orWhere('users.user_fullname', 'like', '%' . $keyword . '%')
                                    ->orderBy('map_users_apps.app_id', 'asc')
                                    ->paginate(8);
        }

        return view('pages.admin-mapapps', compact('maps'));
    }

    public function edit($id)
    {
        $maps = map_users_apps::findOrFail($id);
        $users = User::all();
        $apps = apps::all();

        return view('pages.admin-mapapps-edit', compact('maps', 'users', 'apps'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'app_id' => 'required',
            'user_id' => 'required',
            'data_status' => 'required',
        ], [
            'app_id.required' => 'Aplikasi harus dipilih.',
            'user_id.required' => 'Pengguna harus dipilih.',
            'data_status.required' => 'Status data harus diisi.',
        ]);

        $existingEntry = map_users_apps::where('app_id', $request->app_id)
                                        ->where('user_id', $request->user_id)
                                        ->where('id', '!=', $id)
                                        ->first();

        if ($existingEntry) {
            return redirect()->back()->withErrors(['app_id' => 'Kombinasi aplikasi dan pengguna ini sudah ada.']);
        }

        // Cari data berdasarkan ID, jika tidak ditemukan akan menampilkan error 404
        $maps = map_users_apps::findOrFail($id);

        // Ambil informasi tambahan untuk pesan sukses
        $data = map_users_apps::join('users', 'map_users_apps.user_id', '=', 'users.user_id')
                              ->join('apps', 'map_users_apps.app_id', '=', 'apps.app_id')
                              ->findOrFail($id);

        // Update data
        $maps->app_id = $request->app_id;
        $maps->user_id = $request->user_id;
        $maps->data_status = $request->data_status;

        $maps->save();

        // Pesan sukses
        toastr()->success('Data hak akses aplikasi ' . $data->app_name . ' untuk pengguna ' . $data->user_fullname . ' berhasil disimpan!');

        // Redirect ke halaman map apps user
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
