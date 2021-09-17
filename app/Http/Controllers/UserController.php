<?php

namespace App\Http\Controllers;

use App\Traits\FotoStorage;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;


class UserController extends Controller
{
    use FotoStorage;

    /**
     * Construct
     * @return void
     */
    public function __construct()
    {
        $this->middleware(['auth', 'level']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $keyword = $request->keyword;
        $pagination = 5;
        $user = User::where("nama","LIKE","%$keyword%")
                ->orWhere("level","LIKE","%$keyword%")
                ->paginate($pagination);
                $user->withPath('user');
                $user->appends($request->all);
                return view('pages.user.index', compact('user', 'keyword'));
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pages.user.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
            $validasi = $request->validate([
            'nama' => 'required',
            'alamat' => 'required',
            'email' => 'required|unique:users|email',
            'password' => 'required|max:10|min:5',
            'level' => 'required',
            'telepon' => 'required',
            // 'foto' => 'required',
        ],
        [
            'nama.required' => 'Masukan Nama',
            'alamat.required' => 'Alamat Tidak Boleh Kosong',
            'email.required' => 'Masukan Email',
            'password.required' => 'Masukan Password',
            'password.min' => 'Masukan Password Minimal 5 digit',
            'password.max' => 'Masukan Password Maximal 10 digit',
            'level.required' => 'Pilih Jabatan terlebih dahulu ',
            'telepon.required' => 'Masukan Nomor Telepon',
            // 'foto.required' => 'Masukan Foto',
        ]
    );

        // dd($request->all());
        $foto = $request->file('image');

        if ($foto) {

            $request['foto'] = $this->uploadFoto($foto, $request->nama, 'profile');
        }

        $request['password'] = Hash::make($request->password);

        User::create($request->all());
        return redirect()->route('user.index')->with('message','data berhasil di simpan');
    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = User::findOrFail($id);
        return view('pages.user.show', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::findOrFail($id);
        return view('pages.user.edit', compact('user'));
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
        $validasi = $request->validate([
            'nama' => 'required',
            'alamat' => 'required',
            'email' => 'required',
            'password' => 'required|max:10|min:5',
            'level' => 'required',
            'telepon' => 'required',
            // 'foto' => 'required'
        ], [
            'nama.required' => 'Masukan Nama',
            'alamat.required' => 'Alamat Tidak Boleh Kosong',
            'email.required' => 'Masukan email',
            'password.required' => 'Masukan Password',
            'password.min' => 'Masukan Password Minimal 5 digit',
            'password.max' => 'Masukan Password Maximal 10 digit',
            'level.required' => 'Pilih Jabatan terlebih dahulu ',
            'telepon.required' => 'Masukan Nomor Telepon',
            // 'foto.required' => 'Masukan Foto',
        ]);

        $user = User::findOrFail($id);
        $foto = $request->file('image');

        if ($foto) {
            $request['foto'] = $this->uploadFoto($foto, $request->nama, 'profile', true, $user->foto);
        }

        if ($request->password) {
            $request['password'] = Hash::make($request->password);
        } else {
            $request['password'] = $user->password;
        }

        $user->update($request->all());

        return redirect()->route('user.index')->with('message','data berhasil di ubah');
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

        if ($user->foto) {
            $this->deleteFoto($user->foto, 'profile');
        }
        User::destroy($user->id);
        return redirect()->route('user.index')->with('message','data berhasil di hapus');
    }
}