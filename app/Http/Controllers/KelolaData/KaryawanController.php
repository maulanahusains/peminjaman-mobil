<?php

namespace App\Http\Controllers\KelolaData;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;
use Yajra\DataTables\DataTables;

class KaryawanController extends Controller
{
  /**
   * Display a listing of the resource.
   */
  public function index()
  {
    return view('superadmin.kelola-data.kelola-karyawan.index');
  }

  public function indexJSON()
  {
    $users = User::all();
    return DataTables::of($users)
      ->addIndexColumn()
      ->addColumn('edit', function ($row) {
        return '<button class="btn btn-sm btn-warning btn-edit" data-route="' . route('kelola-data.karyawan.edit', $row->id) . '" type="button"><i
          class="ti ti-edit"></i></button>';
      })
      ->addColumn('delete', function ($row) {
        return '<form action="' . route('kelola-data.karyawan.delete', $row->id) . '" method="POST">
          ' . csrf_field() . '
              <input type="hidden" name="_method" value="DELETE" />
              <button class="btn btn-sm btn-danger btn-delete" type="submit"><i
                      class="ti ti-trash"></i></button>
          </form>';
      })
      ->rawColumns(['edit', 'delete'])
      ->toJson();
  }

  /**
   * Show the form for creating a new resource.
   */
  public function create()
  {
    //
  }

  /**
   * Store a newly created resource in storage.
   */
  public function store(Request $request)
  {
    $request->validate([
      'name' => ['required'],
      'username' => ['required', 'unique:users,username'],
      'nik' => ['required'],
      'email' => ['required', 'email'],
      'password' => ['required', 'min:8']
    ]);

    DB::beginTransaction();
    try {
      $karyawan = new User;
      $karyawan->name = $request->name;
      $karyawan->username = $request->username;
      $karyawan->nik = $request->nik;
      $karyawan->email = $request->email;
      $karyawan->password = bcrypt($request->password);
      $karyawan->isAdmin = $request->isAdmin;
      $karyawan->save();

      DB::commit();
      return redirect()
        ->route('kelola-data.karyawan.index')
        ->with('success', 'Sukses menambahkan Data');
    } catch (\Throwable $th) {
      DB::rollBack();
      return redirect()
        ->route('kelola-data.karyawan.index')
        ->with('error', 'Gagal menambahkan Data');
    }
  }

  /**
   * Display the specified resource.
   */
  public function show(string $id)
  {
    //
  }

  /**
   * Show the form for editing the specified resource.
   */
  public function edit(string $id)
  {
    $karyawan = User::where('id', $id)->first();
    return view('superadmin.kelola-data.kelola-karyawan.edit', compact('karyawan'));
  }

  /**
   * Update the specified resource in storage.
   */
  public function update(Request $request, string $id)
  {
    $request->validate([
      'name' => ['required'],
      'username' => ['required', Rule::unique('users', 'username')->ignore($id),],
      'nik' => ['required'],
      'email' => ['required', 'email'],
    ]);

    $karyawan = User::where('id', $id)->first();
    $password = ($request->password) ? bcrypt($request->password) : $karyawan->password;

    DB::beginTransaction();
    try {
      $karyawan->name = $request->name;
      $karyawan->username = $request->username;
      $karyawan->nik = $request->nik;
      $karyawan->email = $request->email;
      $karyawan->password = $password;
      $karyawan->isAdmin = $request->isAdmin;
      $karyawan->save();

      DB::commit();
      return redirect()
        ->route('kelola-data.karyawan.index')
        ->with('success', 'Sukses Mengubah Data');
    } catch (\Throwable $th) {
      DB::rollBack();
      return redirect()
        ->route('kelola-data.karyawan.index')
        ->with('error', 'Gagal Mengubah Data');
    }
  }

  /**
   * Remove the specified resource from storage.
   */
  public function destroy(string $id)
  {
    $karyawan = User::where('id', $id)->first();
    DB::beginTransaction();
    try {
      $karyawan->delete();
      DB::commit();
      return redirect()
        ->route('kelola-data.karyawan.index')
        ->with('success', 'Sukses Menghapus Data');
    } catch (\Throwable $th) {
      DB::rollBack();
      return redirect()
        ->route('kelola-data.karyawan.index')
        ->with('error', 'Gagal Mengubah Data');
    }
  }
}
