<?php

namespace App\Http\Controllers;

use App\Models\PesanKontak;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\PesanBalasanMail;
use Throwable;

class PesanKontakController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->except(['createPublic', 'store']);
        $this->authorizeResource(PesanKontak::class, 'pesanKontak', ['except' => ['store']]);
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $pesanKontaks = PesanKontak::orderBy('created_at', 'desc')->paginate(10);
        return view('pesan-kontak.index', compact('pesanKontaks'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('pesan-kontak.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'subjek' => 'required|string|max:255',
            'pesan' => 'required|string',
        ]);

        PesanKontak::create($validated);

        return redirect()->back()->with('success', 'Pesan Anda telah terkirim. Terima kasih telah menghubungi kami.');
    }

    /**
     * Display the specified resource.
     */
    public function show(PesanKontak $pesanKontak)
    {
        // Mark as read when viewing
        if (!$pesanKontak->dibaca) {
            $pesanKontak->dibaca = true;
            $pesanKontak->tanggal_dibaca = now();
            $pesanKontak->save();
        }

        return view('pesan-kontak.show', compact('pesanKontak'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(PesanKontak $pesanKontak)
    {
        return view('pesan-kontak.edit', compact('pesanKontak'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, PesanKontak $pesanKontak)
    {
        $validated = $request->validate([
            'nama' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'subjek' => 'required|string|max:255',
            'pesan' => 'required|string',
            'dibaca' => 'boolean',
            'dibalas' => 'boolean',
        ]);

        $pesanKontak->nama = $validated['nama'];
        $pesanKontak->email = $validated['email'];
        $pesanKontak->subjek = $validated['subjek'];
        $pesanKontak->pesan = $validated['pesan'];

        $dibaca = (bool) ($validated['dibaca'] ?? false);
        $dibalas = (bool) ($validated['dibalas'] ?? false);

        if ($dibaca && !$pesanKontak->dibaca) {
            $pesanKontak->tanggal_dibaca = now();
        } elseif (!$dibaca) {
            $pesanKontak->tanggal_dibaca = null;
        }

        if ($dibalas && !$pesanKontak->dibalas) {
            $pesanKontak->tanggal_dibalas = now();
        } elseif (!$dibalas) {
            $pesanKontak->tanggal_dibalas = null;
        }

        $pesanKontak->dibaca = $dibaca;
        $pesanKontak->dibalas = $dibalas;
        $pesanKontak->save();

        return redirect()->route('pesan-kontak.index')->with('success', 'Pesan berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(PesanKontak $pesanKontak)
    {
        $pesanKontak->delete();

        return redirect()->route('pesan-kontak.index')->with('success', 'Pesan berhasil dihapus.');
    }

    /**
     * Reply to the specified message.
     */
    public function balas(Request $request, PesanKontak $pesanKontak)
    {
        $validated = $request->validate([
            'pesan_balasan' => 'required|string',
        ]);

        try {
            Mail::to($pesanKontak->email)->send(
                new PesanBalasanMail($pesanKontak, $validated['pesan_balasan'])
            );
        } catch (Throwable $exception) {
            report($exception);

            return redirect()
                ->back()
                ->withInput()
                ->with('error', 'Balasan gagal dikirim. Cek konfigurasi email lalu coba lagi.');
        }

        $pesanKontak->dibalas = true;
        $pesanKontak->tanggal_dibalas = now();
        $pesanKontak->save();

        return redirect()->route('pesan-kontak.index')->with('success', 'Pesan balasan telah dikirim ke ' . $pesanKontak->email);
    }

    /**
     * Show the form for creating a new resource for public.
     */
    public function createPublic()
    {
        return view('pesan-kontak.create');
    }
}
