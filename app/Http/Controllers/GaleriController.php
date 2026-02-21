<?php

namespace App\Http\Controllers;

use App\Models\Galeri;
use App\Models\Kegiatan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Laravel\Facades\Image;

class GaleriController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->except(['indexPublic', 'showPublic']);
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $galeris = Galeri::orderBy('created_at', 'desc')->paginate(12);
        return view('galeri.index', compact('galeris'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $kegiatans = Kegiatan::orderBy('tanggal', 'desc')->get();
        return view('galeri.create', compact('kegiatans'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'kegiatan_id' => 'nullable|exists:kegiatans,id',
            'judul' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
            'kategori' => 'nullable|string|max:50',
            'file' => 'required|file|mimes:jpeg,png,jpg,gif,webp,mp4,mov,avi|max:102400', // 100MB max
            'aktif' => 'boolean',
        ]);

        $data = $request->except('file');
        $data['aktif'] = $request->has('aktif');

        if ($request->hasFile('file')) {
            $file = $request->file('file');
            $filename = time() . '_' . $file->getClientOriginalName();
            $path = 'galeri/' . $filename;

            // Determine file type
            $extension = $file->getClientOriginalExtension();
            $imageExtensions = ['jpeg', 'jpg', 'png', 'gif', 'webp'];

            if (in_array(strtolower($extension), $imageExtensions)) {
                $data['tipe'] = 'image';
                Storage::disk('public')->makeDirectory('galeri');
                $img = Image::read($file->getRealPath())
                    ->orient()
                    ->scaleDown(1920);

                $fullPath = storage_path('app/public/' . $path);
                if (in_array(strtolower($extension), ['jpg', 'jpeg'], true)) {
                    $img->toJpeg(90, progressive: true)->save($fullPath);
                } elseif (strtolower($extension) === 'webp') {
                    $img->toWebp(90)->save($fullPath);
                } else {
                    $img->save($fullPath);
                }
            } else {
                $data['tipe'] = 'video';
                $file->storeAs('galeri', $filename, 'public');
            }

            $data['path_file'] = $path;
        }

        Galeri::create($data);

        return redirect()->route('admin.galeri.index')->with('success', 'Galeri berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Galeri $galeri)
    {
        return view('galeri.show', compact('galeri'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Galeri $galeri)
    {
        $kegiatans = Kegiatan::orderBy('tanggal', 'desc')->get();
        return view('galeri.edit', compact('galeri', 'kegiatans'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Galeri $galeri)
    {
        $request->validate([
            'kegiatan_id' => 'nullable|exists:kegiatans,id',
            'judul' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
            'kategori' => 'nullable|string|max:50',
            'file' => 'nullable|file|mimes:jpeg,png,jpg,gif,webp,mp4,mov,avi|max:102400', // 100MB max
            'aktif' => 'boolean',
        ]);

        $data = $request->except('file');
        $data['aktif'] = $request->has('aktif');

        if ($request->hasFile('file')) {
            // Delete old file if exists
            if ($galeri->path_file) {
                Storage::disk('public')->delete($galeri->path_file);
            }

            $file = $request->file('file');
            $filename = time() . '_' . $file->getClientOriginalName();
            $path = 'galeri/' . $filename;

            // Determine file type
            $extension = $file->getClientOriginalExtension();
            $imageExtensions = ['jpeg', 'jpg', 'png', 'gif', 'webp'];

            if (in_array(strtolower($extension), $imageExtensions)) {
                $data['tipe'] = 'image';
                Storage::disk('public')->makeDirectory('galeri');
                $img = Image::read($file->getRealPath())
                    ->orient()
                    ->scaleDown(1920);

                $fullPath = storage_path('app/public/' . $path);
                if (in_array(strtolower($extension), ['jpg', 'jpeg'], true)) {
                    $img->toJpeg(90, progressive: true)->save($fullPath);
                } elseif (strtolower($extension) === 'webp') {
                    $img->toWebp(90)->save($fullPath);
                } else {
                    $img->save($fullPath);
                }
            } else {
                $data['tipe'] = 'video';
                $file->storeAs('galeri', $filename, 'public');
            }

            $data['path_file'] = $path;
        }

        $galeri->update($data);

        return redirect()->route('admin.galeri.index')->with('success', 'Galeri berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Galeri $galeri)
    {
        // Delete file if exists
        if ($galeri->path_file) {
            Storage::disk('public')->delete($galeri->path_file);
        }

        $galeri->delete();

        return redirect()->route('admin.galeri.index')->with('success', 'Galeri berhasil dihapus.');
    }

    /**
     * Display a listing of the resource for public.
     */
    public function indexPublic(Request $request)
    {
        $kategoriList = Galeri::where('aktif', true)
            ->whereNotNull('kategori')
            ->where('kategori', '!=', '')
            ->select('kategori')
            ->distinct()
            ->orderBy('kategori')
            ->pluck('kategori');

        $selectedKategori = $request->query('kategori');
        if ($selectedKategori && !$kategoriList->contains($selectedKategori)) {
            $selectedKategori = null;
        }

        $query = Galeri::where('aktif', true);
        if ($selectedKategori) {
            $query->where('kategori', $selectedKategori);
        }

        $galeris = $query
            ->orderBy('created_at', 'desc')
            ->paginate(12)
            ->withQueryString();

        return view('galeri.index-public', compact('galeris', 'selectedKategori', 'kategoriList'));
    }

    /**
     * Display the specified resource for public.
     */
    public function showPublic(Galeri $galeri)
    {
        if (!$galeri->aktif) {
            abort(404);
        }
        $relatedGaleris = Galeri::where('aktif', true)
            ->where('id', '!=', $galeri->id)
            ->orderBy('created_at', 'desc')
            ->take(6)
            ->get();

        return view('galeri.show-public', compact('galeri', 'relatedGaleris'));
    }
}
