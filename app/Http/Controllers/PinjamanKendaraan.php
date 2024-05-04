<?php

namespace App\Http\Controllers;

use App\Models\JenisKendaraan;
use App\Models\Kendaraan;
use App\Models\Peminjaman;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\DataTables;

class PinjamanKendaraan extends Controller
{
  public function index()
  {
    $jenis = JenisKendaraan::all();
    return view('content.pages.pinjaman-kendaraan.index', compact('jenis'));
  }

  public function riwayat()
  {
    return view('content.pages.pinjaman-kendaraan.riwayat');
  }

  public function indexJSON()
  {
    $pinjaman = Peminjaman::where('status', 'Diajukan')
      ->with(['PenanggungJawab', 'Kendaraan'])
      ->get();

    return DataTables::of($pinjaman)
      ->addIndexColumn()
      ->addColumn('detail', function ($row) {
        return '<button class="btn btn-sm btn-primary btn-detail" data-route="' . route('peminjaman-kendaraan.detail-peminjaman', $row->id) . '" type="button"><i
          class="ti ti-chevron-right"></i></button>';
      })
      ->addColumn('delete', function ($row) {
        return '<form action="' . route('peminjaman-kendaraan.hapus-pengajuan', $row->id) . '" method="POST">
          ' . csrf_field() . '
              <input type="hidden" name="_method" value="DELETE" />
              <button class="btn btn-sm btn-danger btn-delete" type="submit"><i
                      class="ti ti-trash"></i></button>
          </form>';
      })
      ->rawColumns(['detail', 'delete'])
      ->toJson();
  }

  public function berjalanJSON()
  {
    $pinjaman = Peminjaman::whereNotIn('status', ['Diajukan', 'Selesai', 'Ditolak'])
      ->with(['PenanggungJawab', 'Kendaraan'])
      ->get();

    return DataTables::of($pinjaman)
      ->addIndexColumn()
      ->addColumn('detail', function ($row) {
        return '<button class="btn btn-sm btn-primary btn-detail" data-route="' . route('peminjaman-kendaraan.detail-peminjaman', $row->id) . '" type="button"><i
          class="ti ti-chevron-right"></i></button>';
      })
      ->rawColumns(['detail'])
      ->toJson();
  }

  public function riwayatJSON()
  {
    $pinjaman = Peminjaman::whereIn('status', ['Selesai', 'Ditolak'])
      ->with(['PenanggungJawab', 'Kendaraan'])
      ->get();

    return DataTables::of($pinjaman)
      ->addIndexColumn()
      ->addColumn('detail', function ($row) {
        return '<button class="btn btn-sm btn-primary btn-detail" data-route="' . route('peminjaman-kendaraan.detail-peminjaman', $row->id) . '" type="button"><i
          class="ti ti-chevron-right"></i></button>';
      })
      ->rawColumns(['detail'])
      ->toJson();
  }

  public function detail($id)
  {
    $peminjaman = Peminjaman::where('id', $id)->first();
    return view('content.pages.pinjaman-kendaraan.detail', compact('peminjaman'));
  }

  public function store(Request $request)
  {
    $validator = Validator::make($request->all(), [
      'penanggung_jawab' => ['required'],
      'kebutuhan' => ['required'],
      'tanggal' => ['required'],
      'agenda' => ['required'],
      'jenis_plat' => ['required']
    ]);

    if ($validator->fails()) {
      return redirect()
        ->back()
        ->withErrors($validator)
        ->withInput()
        ->with('error', 'Gagal Mengajukan Pinjaman, Silahkan input ulang');
    }

    $kendaraan = Kendaraan::where('isLending', 0)
      ->when($request->jenis != 'Apapun', function ($q) use ($request) {
        $q->where('id_jenis', $request->jenis);
      })
      ->when($request->jenis_plat != 'Apapun', function ($q) use ($request) {
        $q->where('jenis_plat', $request->jenis_plat);
      })
      ->first();

    if (!$kendaraan) {
      return redirect()
        ->route('peminjaman-kendaraan.list-pengajuan')
        ->with('error', 'Kendaraan dengan plat ' . $request->jenis_plat . ' Tidak tersedia. Silahkan pilih jenis plat lain');
    }

    $tanggal = explode(' ', $request->tanggal);

    $tanggalMulai = $tanggal[0];
    $tanggalKembali = $tanggal[2];

    DB::beginTransaction();
    try {
      $kendaraan->isLending = 1;
      if ($kendaraan->save()) {
        $pinjaman = new Peminjaman;
        $pinjaman->id_kendaraan = $kendaraan->id;
        $pinjaman->penanggung_jawab = $request->penanggung_jawab;
        $pinjaman->tanggal_pinjam = $tanggalMulai;
        $pinjaman->tanggal_kembali = $tanggalKembali;
        $pinjaman->kebutuhan = $request->kebutuhan;
        $pinjaman->agenda = $request->agenda;
        $pinjaman->status = 'Diajukan';
        $pinjaman->save();
      }

      DB::commit();
      return redirect()
        ->route('peminjaman-kendaraan.list-pengajuan')
        ->with('success', 'Sukses meminjam kendaraan');
    } catch (\Throwable $th) {
      dd($th);
      DB::rollBack();
      return redirect()
        ->route('peminjaman-kendaraan.list-pengajuan')
        ->with('error', 'Gagal meminjam kendaraan');
    }
  }

  public function destroy($id)
  {
    $pinjaman = Peminjaman::where('id', $id)->first();
    $kendaraan = Kendaraan::where('id', $pinjaman->id_kendaraan)->first();
    DB::beginTransaction();
    try {
      $kendaraan->isLending = 0;
      if ($kendaraan->save()) {
        $pinjaman->delete();
      }
      DB::commit();
      return redirect()
        ->route('peminjaman-kendaraan.list-pengajuan')
        ->with('success', 'Sukses Menghapus kendaraan');
    } catch (\Throwable $th) {
      DB::rollBack();
      return redirect()
        ->route('peminjaman-kendaraan.list-pengajuan')
        ->with('error', 'Gagal Menghapus kendaraan');
    }
  }
}
