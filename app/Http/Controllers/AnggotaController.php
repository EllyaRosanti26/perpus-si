<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Profile;
use App\Models\Peminjaman;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use RealRashid\SweetAlert\Facades\Alert;
use Symfony\Component\HttpFoundation\File\File;

class AnggotaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $iduser  = Auth::id();
        $user    = User::all()->where('isAdmin', '0');
        $profile = Profile::where('users_id', $iduser)->first();
        // dd($user[1]->profile);
        return view('anggota.tampil', ['anggota' => $user, 'profile' => $profile]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $iduser  = Auth::id();
        $user    = User::all()->where('isAdmin', '0');
        $profile = Profile::where('users_id', $iduser)->first();
        return view('anggota.tambah', ['user' => $user, 'profile' => $profile]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate(
            [
                'name' => 'required',
                'nisn' => 'required|unique:profile',
                'no_anggota' => 'required',
                'alamat' => 'required',
                'no_telp' => 'required',
                'username' => 'required|unique:users',
                'password' => 'required|min:8',
            ],
            [
                'name.required' => "Nama tidak boleh kosong",
                'nisn.required' => "Nomor Induk tidak boleh kosong",
                'nisn.unique' => "nisn Telah Digunakan",
                'no_anggota.required' => "no_anggota tidak boleh kosong",
                'alamat.required' => "Alamat tidak boleh kosong",
                'no_telp.required' => "Nomor Telepon tidak boleh kosong",
                'username.required' => "username tidak boleh kosong",
                'username.unique' => "usernmae Telah Digunakan",
                'password.required' => "Password Tidak boleh kosong",
                'password.min' => "Password tidak boleh kurang dari 8 karakter"
            ]
        );

        $user = User::create([
            'name' => $request['name'],
            'username' => $request['username'],
            'password' => Hash::make($request['password']),
        ]);

        Profile::create([
            'nisn' => $request['nisn'],
            'no_anggota' => $request['no_anggota'],
            'alamat' => $request['alamat'],
            'no_telp' => $request['no_telp'],
            'users_id' => $user->id,
        ]);

        Alert::success('Success', 'Berhasil Menambah Anggota');
        return redirect('/anggota');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user         = User::find($id);
        $profile      = Profile::where('users_id', $id)->first();
        $pinjamanUser = Peminjaman::where('users_id', $user->id)->get();
        return view('anggota.detail', ['user' => $user, 'profile' => $profile, 'pinjamanUser' => $pinjamanUser]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user    = User::find($id);
        $profile = Profile::where('users_id', $id)->first();
        return view('anggota.edit', ['user' => $user, 'profile' => $profile]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate(
            [
                'name' => 'required',
                'nisn' => 'required',
                'no_anggota' => 'required',
                'alamat' => 'required',
                'no_telp' => 'required',
                'photoProfile' => 'nullable|mimes:jpg,jpeg,png|max:2048'
            ],
            [
                'name.required' => "Nama tidak boleh kosong",
                'nisn.required' => "Nomor Induk tidak boleh kosong",
                'no_anggota.required' => "no_anggota tidak boleh kosong",
                'alamat.required' => "Alamat tidak boleh kosong",
                'no_telp.required' => "Nomor Telepon tidak boleh kosong",
                'photoProfile.mimes' => "Foto Profile Harus Berupa jpg,jpeg,atau png",
                'photoProfile.max' => "ukuran gambar tidak boleh lebih dari 2048 MB"
            ]
        );
        $user    = User::find($id);
        $profile = Profile::find($id);

        if ($request->has('photoProfile')) {
            $path = 'images/photoProifle';

            if (isset($profile->photoProfile)) {
                File::delete($path . $profile->photoProfile);
            }
            $namaGambar = time() . '.' . $request->photoProfile->extension();

            $request->photoProfile->move(public_path('images/photoProfile'), $namaGambar);

            $profile->photoProfile = $namaGambar;

            $profile->save();
        }
        $user->name          = $request->name;
        $profile->nisn       = $request->nisn;
        $profile->no_anggota = $request->no_anggota;
        $profile->alamat     = $request->alamat;
        $profile->no_telp    = $request->no_telp;

        if ($request->password != null) {
            $user->password = Hash::make($request->password);
        }
        if ($request->username != null) {
            $user->username = $request->username;
        }
        $profile->save();
        $user->save();

        Alert::success('Success', 'Berhasil Mengubah Profile');
        return redirect('/anggota');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::find($id);

        $user->delete();

        Alert::success('Berhasil', 'Berhasil Mengapus Anggota');
        return redirect('anggota');
    }
}