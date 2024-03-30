<?php

namespace App\Http\Controllers\KelolaData;

use App\Http\Controllers\Controller;
use App\Models\JenisKendaraan;
use App\Models\Kendaraan;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\DataTables;

class KendaraanController extends Controller
{
  public function splitString($str)
  {
    if (preg_match('/^([a-zA-Z]+)([0-9]+)([a-zA-Z]+)$/', $str, $matches)) {
      return [$matches[1], $matches[2], $matches[3]];
    } else {
      return null;
    }
  }
  /**
   * Display a listing of the resource.
   */
  public function index()
  {
    $jenis = JenisKendaraan::all();
    $users = User::all();
    return view('superadmin.kelola-data.kelola-kendaraan.index', compact('jenis', 'users'));
  }

  public function indexJSON()
  {
    $kendaraan = Kendaraan::select('*')->with(['pemilik', 'jenis']);

    return DataTables::of($kendaraan)
      ->addIndexColumn()
      ->addColumn('edit', function ($row) {
        return '<button class="btn btn-sm btn-warning btn-edit" data-route="' . route('kelola-data.kendaraan.edit', $row->id) . '" type="button"><i
          class="ti ti-edit"></i></button>';
      })
      ->addColumn('delete', function ($row) {
        return '<form action="' . route('kelola-data.kendaraan.delete', $row->id) . '" method="POST">
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
      'jenis' => ['required'],
      'pemilik' => ['required'],
      'nama' => ['required', 'max:255'],
      'tipe' => ['required'],
      'plat_nomor' => ['required']
    ]);

    $jenis_plat = $this->splitString($request->plat_nomor);
    $jenis_plat = substr($jenis_plat[1], -1);
    $jenis_plat = ((int) $jenis_plat % 2 == 0) ? 'Genap' : 'Ganjil';

    DB::beginTransaction();
    try {
      $kendaraan = new Kendaraan;
      $kendaraan->id_jenis = $request->jenis;
      $kendaraan->id_user = $request->pemilik;
      $kendaraan->nama = $request->nama;
      $kendaraan->tipe = $request->tipe;
      $kendaraan->plat_nomor = $request->plat_nomor;
      $kendaraan->jenis_plat = $jenis_plat;
      $kendaraan->save();

      DB::commit();

      return redirect()
        ->route('kelola-data.kendaraan.index')
        ->with('success', 'Sukses menambahkan Data');
    } catch (\Throwable $th) {
      DB::rollBack();
      return redirect()
        ->route('kelola-data.kendaraan.index')
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
    $kendaraan = Kendaraan::where('id', $id)->first();
    $jenis = JenisKendaraan::all();
    $users = User::all();
    return view('superadmin.kelola-data.kelola-kendaraan.edit', compact('kendaraan', 'jenis', 'users'));
  }

  /**
   * Update the specified resource in storage.
   */
  public function update(Request $request, string $id)
  {
    $request->validate([
      'jenis' => ['required'],
      'pemilik' => ['required'],
      'nama' => ['required', 'max:255'],
      'tipe' => ['required'],
      'plat_nomor' => ['required']
    ]);

    $jenis_plat = $this->splitString($request->plat_nomor);
    $jenis_plat = substr($jenis_plat[1], -1);
    $jenis_plat = ((int) $jenis_plat % 2 == 0) ? 'Genap' : 'Ganjil';

    DB::beginTransaction();
    try {
      $kendaraan = Kendaraan::where('id', $id)->first();
      $kendaraan->id_jenis = $request->jenis;
      $kendaraan->id_user = $request->pemilik;
      $kendaraan->nama = $request->nama;
      $kendaraan->tipe = $request->tipe;
      $kendaraan->plat_nomor = $request->plat_nomor;
      $kendaraan->jenis_plat = $jenis_plat;
      $kendaraan->save();

      DB::commit();

      return redirect()
        ->route('kelola-data.kendaraan.index')
        ->with('success', 'Sukses Mengubah Data');
    } catch (\Throwable $th) {
      dd($th);
      DB::rollBack();
      return redirect()
        ->route('kelola-data.kendaraan.index')
        ->with('error', 'Gagal Mengubah Data');
    }
  }

  /**
   * Remove the specified resource from storage.
   */
  public function destroy(string $id)
  {
    DB::beginTransaction();
    try {
      $kendaraan = Kendaraan::where('id', $id)->first();
      $kendaraan->delete();

      DB::commit();
      return redirect()
        ->route('kelola-data.kendaraan.index')
        ->with('success', 'Sukses Menghapus Data');
    } catch (\Throwable $th) {

      DB::rollBack();
      return redirect()
        ->route('kelola-data.kendaraan.index')
        ->with('error', 'Gagal Menghapus Data');
    }
  }
}
