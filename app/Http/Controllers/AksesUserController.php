<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AksesUserController extends Controller
{
    public function index()
    {
        $user_admin = User::where('isAdmin', 1)->get();
        $users = User::where('isAdmin', 0)->get();

        return view('superadmin.akses.index', compact(
            'user_admin',
            'users'
        ));
    }

    public function manipulate_admin(Request $request)
    {
        $user = User::where('id', $request->user)->first();

        DB::beginTransaction();

        try {
            $user->isAdmin = ($user->isAdmin == 1) ? 0 : 1;
            $user->save();

            DB::commit();

            return redirect()
                ->route('manajemen-akses.index')
                ->with('success', 'Sukses Mengubah Akses!');
        } catch (\Throwable $th) {
            DB::rollBack();

            return redirect()
                ->route('manajemen-akses.index')
                ->with('error', 'Gagal Mengubah Akses!');
        }
    }
}
