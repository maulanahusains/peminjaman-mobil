<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Kendaraan;
use App\Models\Peminjaman;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\DataTables;

class PinjamanKendaraan extends Controller
{
  public function list_persetujuan()
  {
    return view('superadmin.peminjaman-kendaraan.list-persetujuan');
  }

  public function datatable_persetujuan()
  {
    $peminjaman = Peminjaman::with('Kendaraan', 'PenanggungJawab')
      ->where('status', 'Diajukan')
      ->get();
    return DataTables::of($peminjaman)
      ->addIndexColumn()
      ->addColumn('detail', function ($row) {
        return '<button class="btn btn-sm btn-primary btn-detail" data-route="' . route('superadmin.peminjaman-kendaraan.detail-persetujuan', $row->id) . '" type="button"><i
          class="ti ti-chevron-right"></i></button>';
      })
      ->rawColumns(['detail'])
      ->toJson();
  }

  public function detail_persetujuan($id)
  {
    $peminjaman = Peminjaman::where('id', $id)->first();
    return view('superadmin.peminjaman-kendaraan.detail-peminjaman', compact('peminjaman'));
  }

  public function setuju($id)
  {
    $peminjaman = Peminjaman::where('id', $id)->first();

    DB::beginTransaction();
    try {
      $peminjaman->status = 'Berjalan';
      $peminjaman->save();
      DB::commit();

      return response()->json([
        'message' => 'Success!'
      ], 200);
    } catch (\Throwable $th) {
      DB::rollBack();
      return response()->json([
        'message' => 'Error!'
      ], 500);
    }
  }

  public function tolak(Request $request, $id)
  {
    $peminjaman = Peminjaman::where('id', $id)->first();
    $kendaraan = Kendaraan::where('id', $peminjaman->id_kendaraan)->first();

    DB::beginTransaction();
    try {
      $kendaraan->isLending = 0;
      if ($kendaraan->save()) {
        $peminjaman->status = 'Ditolak';
        $peminjaman->alasan_ditolak = $request->alasan;
        $peminjaman->save();
      }
      DB::commit();

      return response()->json([
        'message' => 'Success!'
      ], 200);
    } catch (\Throwable $th) {
      DB::rollBack();
      return response()->json([
        'message' => 'Error!'
      ], 500);
    }
  }

  public function list_berjalan()
  {
    return view('superadmin.peminjaman-kendaraan.list-berjalan');
  }

  public function datatable_berjalan()
  {
    $peminjaman = Peminjaman::with('Kendaraan', 'PenanggungJawab')
      ->where('status', 'Diajukan')
      ->get();
    return DataTables::of($peminjaman)
      ->addIndexColumn()
      ->addColumn('detail', function ($row) {
        return '<button class="btn btn-sm btn-primary btn-detail" data-route="' . route('superadmin.peminjaman-kendaraan.detail-berjalan', $row->id) . '" type="button"><i
          class="ti ti-chevron-right"></i></button>';
      })
      ->rawColumns(['detail'])
      ->toJson();
  }

  public function detail_berjalan($id)
  {
    $peminjaman = Peminjaman::where('id', $id)->first();
    return view('superadmin.peminjaman-kendaraan.detail-berjalan', compact('peminjaman'));
  }

  public function selesai($id)
  {
    $peminjaman = Peminjaman::where('id', $id)->first();
    $kendaraan = Kendaraan::where('id', $peminjaman->id_kendaraan)->first();

    DB::beginTransaction();
    try {
      $kendaraan->isLending = 0;
      if ($kendaraan->save()) {
        $peminjaman->status = 'Selesai';
        $peminjaman->save();
      }
      DB::commit();
      return response()
        ->json([
          'Message' => 'Success'
        ], 200);
    } catch (\Throwable $th) {
      DB::rollBack();
      return response()
        ->json([
          'Message' => 'error'
        ], 500);
    }
  }
}
