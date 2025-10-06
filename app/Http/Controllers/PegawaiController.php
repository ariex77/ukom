<?php

namespace App\Http\Controllers;

use App\Models\Pegawai;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Exports\PegawaiExport;
use Maatwebsite\Excel\Facades\Excel;
use PDF;

class PegawaiController extends Controller
{
    public function index(Request $request)
    {
        $query = Pegawai::sorted();

        if ($request->filled('q')) {
            $q = $request->q;
            $query->where(function ($sub) use ($q) {
                $sub->where('nama', 'like', "%$q%")
                    ->orWhere('nip', 'like', "%$q%")
                    ->orWhere('jabatan', 'like', "%$q%");
            });
        }

        if ($request->filled('golongan')) {
            $query->where('golongan', $request->golongan);
        }

        if ($request->filled('pendidikan')) {
            $query->where('tingkat_pendidikan', $request->pendidikan);
        }

        if ($request->filled('tugas')) {
            $query->where('tempat_tugas', $request->tugas);
        }

        $pegawais = $query->orderBy('nama')->paginate(20)->withQueryString();
        $tempatTugasList = Pegawai::select('tempat_tugas')->distinct()->orderBy('tempat_tugas')->pluck('tempat_tugas');

        return view('pegawai.index', compact('pegawais', 'tempatTugasList'));
    }

    public function create()
    {
        return view('pegawai.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama' => 'required|string|max:255',
            'tempat_lahir' => 'required|string|max:255',
            'tanggal_lahir' => 'required|date',
            'nip' => 'required|digits:18|unique:pegawais,nip',
            'pangkat' => 'required|string|max:255',
            'golongan' => 'required|string|max:255',
            'jabatan' => 'required|string|max:255',
            'masa_kerja_tahun' => 'required|integer|min:0',
            'masa_kerja_bulan' => 'required|integer|min:0|max:11',
            'status_kepegawaian' => 'required|string',
            'nama_sekolah' => 'required|string|max:255',
            'tahun_lulus' => 'required|integer|min:1900|max:' . now()->year,
            'tingkat_pendidikan' => 'required|string',
            'jenis_kelamin' => 'required|string',
            'usia' => 'required|integer|min:0',
            'tempat_tugas' => 'required|string|max:255',
            'nomor_seri_karpeg' => 'required|string|max:255',
            'sertifikat_ukom' => 'required|file|mimes:pdf,jpg,jpeg,png|max:2048',
            'sk_pangkat_terakhir' => 'required|file|mimes:pdf,jpg,jpeg,png|max:2048',
        ]);

        if ($request->hasFile('sertifikat_ukom')) {
            $validated['sertifikat_ukom'] = $request->file('sertifikat_ukom')->store('sertifikat_ukom', 'public');
        }

        if ($request->hasFile('sk_pangkat_terakhir')) {
            $validated['sk_pangkat_terakhir'] = $request->file('sk_pangkat_terakhir')->store('sk_pangkat', 'public');
        }

        $validated['user_id'] = Auth::id();
        Pegawai::create($validated);

        return redirect()->route('pegawais.index')->with('success', 'Data pegawai berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $pegawai = Pegawai::findOrFail($id);
        return view('pegawai.edit', compact('pegawai'));
    }

    public function update(Request $request, $id)
    {
        $pegawai = Pegawai::findOrFail($id);

        $validated = $request->validate([
            'nama' => 'required|string|max:255',
            'tempat_lahir' => 'required|string|max:255',
            'tanggal_lahir' => 'required|date',
            'nip' => 'required|digits:18|unique:pegawais,nip,' . $pegawai->id,
            'pangkat' => 'required|string|max:255',
            'golongan' => 'required|string|max:255',
            'jabatan' => 'required|string|max:255',
            'masa_kerja_tahun' => 'required|integer|min:0',
            'masa_kerja_bulan' => 'required|integer|min:0|max:11',
            'status_kepegawaian' => 'required|string',
            'nama_sekolah' => 'required|string|max:255',
            'tahun_lulus' => 'required|integer|min:1900|max:' . now()->year,
            'tingkat_pendidikan' => 'required|string',
            'jenis_kelamin' => 'required|string',
            'usia' => 'required|integer|min:0',
            'tempat_tugas' => 'required|string|max:255',
            'nomor_seri_karpeg' => 'required|string|max:255',
            'sertifikat_ukom' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:2048',
            'sk_pangkat_terakhir' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:2048',
        ]);

        if ($request->hasFile('sertifikat_ukom')) {
            if ($pegawai->sertifikat_ukom) {
                Storage::disk('public')->delete($pegawai->sertifikat_ukom);
            }
            $validated['sertifikat_ukom'] = $request->file('sertifikat_ukom')->store('sertifikat_ukom', 'public');
        }

        if ($request->hasFile('sk_pangkat_terakhir')) {
            if ($pegawai->sk_pangkat_terakhir) {
                Storage::disk('public')->delete($pegawai->sk_pangkat_terakhir);
            }
            $validated['sk_pangkat_terakhir'] = $request->file('sk_pangkat_terakhir')->store('sk_pangkat', 'public');
        }

        $validated['user_id'] = $pegawai->user_id ?? Auth::id();
        $pegawai->update($validated);

        return redirect()->route('pegawais.index')->with('success', 'Data pegawai berhasil diupdate.');
    }

    public function destroy($id)
    {
        $pegawai = Pegawai::findOrFail($id);

        if ($pegawai->sertifikat_ukom) {
            Storage::disk('public')->delete($pegawai->sertifikat_ukom);
        }

        if ($pegawai->sk_pangkat_terakhir) {
            Storage::disk('public')->delete($pegawai->sk_pangkat_terakhir);
        }

        $pegawai->delete();
        return redirect()->route('pegawais.index')->with('success', 'Data pegawai berhasil dihapus.');
    }

    public function exportExcel()
    {
        return Excel::download(new PegawaiExport, 'pegawais.xlsx');
    }

    public function exportPdf()
    {
        $pegawais = Pegawai::sorted()->get();

        $pdf = PDF::loadView('pegawai.pdf', compact('pegawais'))
                  ->setPaper('A4', 'landscape');

        return $pdf->download('pegawais.pdf');
    }

    public function show($id)
    {
        $pegawai = Pegawai::findOrFail($id);
        return view('pegawai.show', compact('pegawai'));
    }
}
