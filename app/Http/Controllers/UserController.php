<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRequest;
use App\Models\User;
use Hash;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        $users = User::orderBy('user_id', 'asc')->paginate(8);
        return view('pages.admin-users', compact('users'));
    }

    public function search(Request $request)
    {
        $keyword = $request->input('keyword');

        if(strtolower($keyword) == "aktif"){
            $users = User::where('data_status', 'like', TRUE)
                        ->orderBy('user_id', 'asc')
                        ->paginate(8);
        } else if (strtolower($keyword) == "tidak aktif"){
            $users = User::where('data_status', 'like', FALSE)
                        ->orderBy('user_id', 'asc')
                        ->paginate(8);
        } else {
            $users = User::where('user_code', 'like', '%' . $keyword . '%')
                        ->orWhere('user_fullname', 'like', '%' . $keyword . '%')
                        ->orWhere('departement', 'like', '%' . $keyword . '%')
                        ->orWhere('user_fullname', 'like', '%' . $keyword . '%')
                        ->orWhere('data_status', 'like', '%' . $keyword . '%')
                        ->orderBy('user_id', 'asc')
                        ->paginate(8);
        }


        return view('pages.admin-users', compact('users'));
    }

    public function create()
    {
        return view('pages.admin-users-create');
    }

    public function store(UserRequest $request)
    {
        $users = User::create([
            'user_code' => $request->user_code,
            'user_fullname' => $request->user_fullname,
            'departement' => $request->departement,
            'user_password' => Hash::make($request->user_password),
            'data_status' => $request->data_status,
        ]);
        toastr()->success('Data Pengguna baru berhasil disimpan!');

        // Redirect with success message or return a response
        return redirect()->route('admin.users-read');
    }

    public function edit($id)
    {
        $users = User::findOrFail($id);

        return view('pages.admin-users-edit', compact('users'));
    }

    public function update(UserRequest $request, $id)
    {
        $users = User::findOrFail($id);

        $data = $users;

        $users->user_code = $request->user_code;
        $users->user_fullname = $request->user_fullname;
        $users->departement = $request->departement;
        if($request->user_password != null){
            $users->user_password = $request->user_password;
        }
        $users->data_status = $request->data_status;

        $users->save();

        toastr()->success('Data Pengguna ' . $data->user_fullname . ' baru berhasil diubah!');

        // Redirect with success message or return a response
        return redirect()->route('admin.users-read');
    }

    public function destroy($id)
    {
        $maps = User::findOrFail($id);;

        $data = $maps;

        // Hapus data
        $maps->delete();
        toastr()->success('Akun pengguna dengan nama ' . $data->user_fullname . ' berhasil dihapus!');

        return redirect()->route('admin.users-read');
    }
}
