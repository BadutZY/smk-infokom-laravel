<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PesanKontak;
use Illuminate\Http\Request;

class PesanController extends Controller
{
    public function index(Request $request)
    {
        $query = PesanKontak::orderByDesc('created_at');

        if ($filter = $request->query('filter')) {
            if (in_array($filter, ['belum_dibaca', 'dibaca'], true)) {
                $query->where('status', $filter);
            }
        }

        if ($search = $request->query('search')) {
            $term = '%'.$search.'%';
            $query->where(function ($q) use ($term) {
                $q->where('subjek', 'like', $term)
                    ->orWhere('nama', 'like', $term)
                    ->orWhere('email', 'like', $term);
            });
        }

        $data = $query->get();
        $unreadCount = PesanKontak::where('status', 'belum_dibaca')->count();

        return view('admin.pesan.index', [
            'site' => \App\Support\SiteData::all(),
            'data' => $data,
            'unreadCount' => $unreadCount,
            'search' => $search,
            'filter' => $request->query('filter', 'semua'),
        ]);
    }

    public function show(PesanKontak $pesan)
    {
        if ($pesan->status === 'belum_dibaca') {
            $pesan->update(['status' => 'dibaca']);
        }

        return redirect()->route('admin.pesan.index')->with('detail', $pesan->id);
    }

    public function destroy(PesanKontak $pesan)
    {
        $pesan->delete();

        return redirect()->route('admin.pesan.index')->with('success', 'Pesan berhasil dihapus');
    }
}
