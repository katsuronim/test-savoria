<?php

namespace App\Http\Controllers;

use App\Http\Requests\AppsRequest;
use App\Models\apps;
use Illuminate\Http\Request;

class AppsController extends Controller
{
    public function index()
    {
        $apps = apps::paginate(8);
        return view('pages.admin-apps', compact('apps'));
    }

public function search(Request $request)
{
    $keyword = $request->input('keyword');

    if(strtolower($keyword) == "aktif"){
        $apps = apps::where('data_status', 'like', TRUE)
                            ->paginate(8);
    } else if (strtolower($keyword) == "tidak aktif"){
        $apps = apps::where('data_status', 'like', FALSE)
                            ->paginate(8);
    } else {
        $apps = apps::where('app_code', 'like', '%' . $keyword . '%')
        ->orWhere('app_name', 'like', '%' . $keyword . '%')
        ->orWhere('app_group', 'like', '%' . $keyword . '%')
        ->orWhere('app_url', 'like', '%' . $keyword . '%')
        ->orWhere('data_status', 'like', '%' . $keyword . '%')
        ->paginate(8);
    }

    return view('pages.admin-apps', compact('apps',));
}

    public function create()
    {
        return view('pages.admin-apps-create');
    }

    public function store(AppsRequest $request)
    {
        $apps = apps::create([
            'app_code' => $request->app_code,
            'app_name' => $request->app_name,
            'app_group' => $request->app_group,
            'app_url' => $request->app_url,
            'data_status' => $request->data_status,
        ]);
        toastr()->success('Data Aplikasi baru berhasil disimpan!');

        // Redirect with success message or return a response
        return redirect()->route('admin.apps-read');
    }

    public function edit($id)
    {
        $apps = apps::findOrFail($id);

        return view('pages.admin-apps-edit', compact('apps'));
    }

    public function update(AppsRequest $request, $id)
    {
        $apps = apps::findOrFail($id);

        $data = $apps;

        $apps->app_code = $request->app_code;
        $apps->app_name = $request->app_name;
        $apps->app_group = $request->app_group;
        $apps->app_url = $request->app_url;
        $apps->data_status = $request->data_status;

        $apps->save();

        toastr()->success('Data Aplikasi ' . $data->app_name . ' baru berhasil diubah!');

        // Redirect with success message or return a response
        return redirect()->route('admin.apps-read');
    }


    public function destroy($id)
    {
        // Dapatkan data yang ingin dihapus
        $apps = apps::findOrFail($id);

        $data = $apps;

        // Hapus data
        $apps->delete();
        toastr()->success('Data Aplikasi ' . $data->app_name . ' berhasil berhasil dihapus!');

        return redirect()->route('admin.apps-read');
    }
}
