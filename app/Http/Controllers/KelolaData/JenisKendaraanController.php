<?php

namespace App\Http\Controllers\KelolaData;

use App\Http\Controllers\Controller;
use App\Models\JenisKendaraan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Yajra\DataTables\DataTables;

class JenisKendaraanController extends Controller
{
  public function index()
  {
    return view('superadmin.kelola-data.kelola-jenis.index');
  }

  /**
   * Display a listing of the resource.
   */
  public function indexJSON()
  {
    $jenis = JenisKendaraan::all();

    return DataTables::of($jenis)
      ->addIndexColumn()
      ->addColumn('edit', function ($row) {
        return '<button class="btn btn-sm btn-warning btn-edit" data-route="' . route('kelola-data.jenis-kendaraan.edit', $row->id) . '" type="submit"><i
          class="ti ti-edit"></i></button>';
      })
      ->addColumn('delete', function ($row) {
        return '<form action="' . route('kelola-data.jenis-kendaraan.delete', $row->id) . '" method="POST">
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
    $validator = Validator::make($request->all(), [
      'jenis' => 'required|unique:jenis_kendaraan,nama_jenis',
    ]);

    if ($validator->fails()) {
      return redirect()
        ->back()
        ->withErrors($validator)
        ->withInput()
        ->with('error', 'Gagal Memasukan Data! Silahkan Masukan Kembali');
    }

    DB::beginTransaction();
    try {
      $jenis = new JenisKendaraan;
      $jenis->nama_jenis = $request->jenis;
      $jenis->save();

      DB::commit();

      return redirect()
        ->route('kelola-data.jenis-kendaraan.index')
        ->with('success', 'Sukses Menambahkan Data');
    } catch (\Throwable $th) {
      DB::rollBack();

      return redirect()
        ->route('kelola-data.jenis-kendaraan.index')
        ->with('error', 'Gagal Menambahkan Data');
    }
  }

  /**
   * Display the specified resource.
   */
  public function show(string $id)
  {
  }

  /**
   * Show the form for editing the specified resource.
   */
  public function edit(string $id)
  {
    $jenis = JenisKendaraan::where('id', $id)->first();

    return view('superadmin.kelola-data.kelola-jenis.edit', compact('jenis'));
  }

  /**
   * Update the specified resource in storage.
   */
  public function update(Request $request, string $id)
  {
    $jenis = JenisKendaraan::where('id', $id)->first();
    $validator = Validator::make($request->all(), [
      'jenis' => [
        'required',
        Rule::unique('jenis_kendaraan', 'nama_jenis')->ignore($id),
      ],
    ]);

    if ($validator->fails()) {
      $errorMessages = collect($validator->errors()->all());
      $errorMessage = 'Gagal Mengubah Data! Silahkan Masukkan Kembali';

      if ($errorMessages->isNotEmpty()) {
        $errorMessage .= '<br><br>' . implode('<br>', $errorMessages->toArray());
      }

      return redirect()
        ->back()
        ->withErrors($validator)
        ->withInput()
        ->with('error', $errorMessage);
    }

    DB::beginTransaction();
    try {
      $jenis->nama_jenis = $request->jenis;
      $jenis->save();

      DB::commit();

      return redirect()
        ->route('kelola-data.jenis-kendaraan.index')
        ->with('success', 'Sukses Mengubah Data');
    } catch (\Throwable $th) {
      DB::rollBack();

      return redirect()
        ->route('kelola-data.jenis-kendaraan.index')
        ->with('error', 'Gagal Mengubah Data');
    }
  }

  /**
   * Remove the specified resource from storage.
   */
  public function destroy(string $id)
  {
    $jenis = JenisKendaraan::where('id', $id)->first();
    DB::beginTransaction();
    try {
      $jenis->delete();
      DB::commit();

      return redirect()
        ->route('kelola-data.jenis-kendaraan.index')
        ->with('success', 'Sukses menghapus Data!');
    } catch (\Throwable $th) {
      DB::rollBack();

      return redirect()
        ->route('kelola-data.jenis-kendaraan.index')
        ->with('error', 'Gagal menghapus Data!');
    }
  }
}
