<?php

namespace App\Http\Controllers;

use App\Models\Kegiatan;
use App\Models\Galeri;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Laravel\Facades\Image;

class KegiatanController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->except(['indexPublic', 'showPublic']);
        // $this->authorizeResource(Kegiatan::class, 'kegiatan');
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $kegiatans = Kegiatan::orderBy('tanggal', 'desc')->paginate(10);
        return view('kegiatan.index', compact('kegiatans'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('kegiatan.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'judul' => 'required|string|max:255',
            'deskripsi' => 'required|string',
            'tanggal' => 'required|date',
            'lokasi' => 'required|string|max:255',
            'kategori' => 'required|string|max:50',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:8192',
            'aktif' => 'boolean',
        ]);

        $data = $request->except('foto');
        $data['aktif'] = $request->has('aktif');

        if ($request->hasFile('foto')) {
            $image = $request->file('foto');
            $filename = time() . '_' . $image->getClientOriginalName();
            $path = 'kegiatan/' . $filename;
            $fullPath = storage_path('app/public/' . $path);
            $extension = strtolower($image->getClientOriginalExtension());

            Storage::disk('public')->makeDirectory('kegiatan');
            $img = Image::read($image->getRealPath())
                ->orient()
                ->scaleDown(1920);

            if (in_array($extension, ['jpg', 'jpeg'], true)) {
                $img->toJpeg(90, progressive: true)->save($fullPath);
            } elseif ($extension === 'webp') {
                $img->toWebp(90)->save($fullPath);
            } else {
                $img->save($fullPath);
            }

            $data['foto'] = $path;
        }

        Kegiatan::create($data);

        return redirect()->route('admin.kegiatan.index')->with('success', 'Kegiatan berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Kegiatan $kegiatan)
    {
        return view('kegiatan.show', compact('kegiatan'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Kegiatan $kegiatan)
    {
        return view('kegiatan.edit', compact('kegiatan'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Kegiatan $kegiatan)
    {
        $request->validate([
            'judul' => 'required|string|max:255',
            'deskripsi' => 'required|string',
            'tanggal' => 'required|date',
            'lokasi' => 'required|string|max:255',
            'kategori' => 'required|string|max:50',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:8192',
            'aktif' => 'boolean',
        ]);

        $data = $request->except('foto');
        $data['aktif'] = $request->has('aktif');

        if ($request->hasFile('foto')) {
            // Delete old image if exists
            if ($kegiatan->foto) {
                Storage::disk('public')->delete($kegiatan->foto);
            }

            $image = $request->file('foto');
            $filename = time() . '_' . $image->getClientOriginalName();
            $path = 'kegiatan/' . $filename;
            $fullPath = storage_path('app/public/' . $path);
            $extension = strtolower($image->getClientOriginalExtension());

            Storage::disk('public')->makeDirectory('kegiatan');
            $img = Image::read($image->getRealPath())
                ->orient()
                ->scaleDown(1920);

            if (in_array($extension, ['jpg', 'jpeg'], true)) {
                $img->toJpeg(90, progressive: true)->save($fullPath);
            } elseif ($extension === 'webp') {
                $img->toWebp(90)->save($fullPath);
            } else {
                $img->save($fullPath);
            }

            $data['foto'] = $path;
        }

        $kegiatan->update($data);

        return redirect()->route('admin.kegiatan.index')->with('success', 'Kegiatan berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Kegiatan $kegiatan)
    {
        // Delete image if exists
        if ($kegiatan->foto) {
            Storage::disk('public')->delete($kegiatan->foto);
        }

        $kegiatan->delete();

        return redirect()->route('admin.kegiatan.index')->with('success', 'Kegiatan berhasil dihapus.');
    }

    /**
     * Display a listing of the resource for public.
     */
    public function indexPublic(Request $request)
    {
        $kategoriList = [
            'pelatihan',
            'bakti sosial',
            'olahraga',
            'kebudayaan',
            'lainnya',
        ];

        $selectedKategori = $request->query('kategori');
        if (!in_array($selectedKategori, $kategoriList, true)) {
            $selectedKategori = null;
        }

        $query = Kegiatan::where('aktif', true);
        if ($selectedKategori) {
            $query->where('kategori', $selectedKategori);
        }

        $kegiatans = $query
            ->orderBy('tanggal', 'desc')
            ->paginate(9)
            ->withQueryString();
        return view('kegiatan.index-public', compact('kegiatans', 'selectedKategori', 'kategoriList'));
    }

    /**
     * Display the specified resource for public.
     */
    public function showPublic(Kegiatan $kegiatan)
    {
        if (!$kegiatan->aktif) {
            abort(404);
        }
        $relatedKegiatans = Kegiatan::where('aktif', true)
            ->where('id', '!=', $kegiatan->id)
            ->orderBy('tanggal', 'desc')
            ->take(3)
            ->get();

        $relatedGaleris = Galeri::where('aktif', true)
            ->where('kegiatan_id', $kegiatan->id)
            ->orderBy('created_at', 'desc')
            ->take(6)
            ->get();

        return view('kegiatan.show-public', compact('kegiatan', 'relatedKegiatans', 'relatedGaleris'));
    }
}
