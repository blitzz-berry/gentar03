<?php

namespace App\Http\Controllers;

use App\Models\Artikel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Laravel\Facades\Image;

class ArtikelController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->except(['indexPublic', 'showPublic']);
        // $this->authorizeResource(Artikel::class, 'artikel');
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $artikels = Artikel::orderBy('tanggal_publikasi', 'desc')->paginate(10);
        return view('artikel.index', compact('artikels'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('artikel.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'judul' => 'required|string|max:255',
            'konten' => 'required|string',
            'kategori' => 'required|string|max:50',
            'thumbnail' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:8192',
            'video_url' => 'nullable|url|max:255',
            'video_file' => 'nullable|file|mimes:mp4,webm,mov|max:102400',
            'aktif' => 'boolean',
            'tanggal_publikasi' => 'nullable|date',
        ]);

        $data = $request->except(['thumbnail', 'video_file']);
        $data['konten'] = Artikel::sanitizeContent($request->konten);
        $data['aktif'] = $request->has('aktif');
        $data['video_url'] = $request->filled('video_url') ? $request->video_url : null;
        $data['tanggal_publikasi'] = $request->tanggal_publikasi ?: now();

        if ($request->hasFile('thumbnail')) {
            $image = $request->file('thumbnail');
            $filename = time() . '_' . $image->getClientOriginalName();
            $path = 'artikel/' . $filename;
            $fullPath = storage_path('app/public/' . $path);
            $extension = strtolower($image->getClientOriginalExtension());

            Storage::disk('public')->makeDirectory('artikel');
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

            $data['thumbnail'] = $path;
        }

        if ($request->hasFile('video_file')) {
            $video = $request->file('video_file');
            $videoFilename = time() . '_' . $video->getClientOriginalName();
            $videoPath = 'artikel/' . $videoFilename;

            $video->storeAs('artikel', $videoFilename, 'public');
            $data['video_file'] = $videoPath;
        }

        Artikel::create($data);

        return redirect()->route('admin.artikel.index')->with('success', 'Artikel berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Artikel $artikel)
    {
        return view('artikel.show', compact('artikel'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Artikel $artikel)
    {
        return view('artikel.edit', compact('artikel'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Artikel $artikel)
    {
        $request->validate([
            'judul' => 'required|string|max:255',
            'konten' => 'required|string',
            'kategori' => 'required|string|max:50',
            'thumbnail' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:8192',
            'video_url' => 'nullable|url|max:255',
            'video_file' => 'nullable|file|mimes:mp4,webm,mov|max:102400',
            'aktif' => 'boolean',
            'tanggal_publikasi' => 'nullable|date',
        ]);

        $data = $request->except(['thumbnail', 'video_file']);
        $data['konten'] = Artikel::sanitizeContent($request->konten);
        $data['aktif'] = $request->has('aktif');
        $data['tanggal_publikasi'] = $request->tanggal_publikasi ?: now();

        if ($request->hasFile('thumbnail')) {
            // Delete old thumbnail if exists
            if ($artikel->thumbnail) {
                Storage::disk('public')->delete($artikel->thumbnail);
            }

            $image = $request->file('thumbnail');
            $filename = time() . '_' . $image->getClientOriginalName();
            $path = 'artikel/' . $filename;
            $fullPath = storage_path('app/public/' . $path);
            $extension = strtolower($image->getClientOriginalExtension());

            Storage::disk('public')->makeDirectory('artikel');
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

            $data['thumbnail'] = $path;
        }

        if ($request->hasFile('video_file')) {
            if ($artikel->video_file) {
                Storage::disk('public')->delete($artikel->video_file);
            }

            $video = $request->file('video_file');
            $videoFilename = time() . '_' . $video->getClientOriginalName();
            $videoPath = 'artikel/' . $videoFilename;

            $video->storeAs('artikel', $videoFilename, 'public');
            $data['video_file'] = $videoPath;
        }

        if ($request->has('video_url')) {
            $data['video_url'] = $request->filled('video_url') ? $request->video_url : null;
        }

        $artikel->update($data);

        return redirect()->route('admin.artikel.index')->with('success', 'Artikel berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Artikel $artikel)
    {
        // Delete thumbnail if exists
        if ($artikel->thumbnail) {
            Storage::disk('public')->delete($artikel->thumbnail);
        }
        if ($artikel->video_file) {
            Storage::disk('public')->delete($artikel->video_file);
        }

        $artikel->delete();

        return redirect()->route('admin.artikel.index')->with('success', 'Artikel berhasil dihapus.');
    }

    /**
     * Display a listing of the resource for public.
     */
    public function indexPublic(Request $request)
    {
        $kategoriList = Artikel::where('aktif', true)
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

        $baseQuery = Artikel::where('aktif', true)
            ->when($selectedKategori, fn ($builder) => $builder->where('kategori', $selectedKategori));

        $featured = (clone $baseQuery)
            ->orderBy('tanggal_publikasi', 'desc')
            ->first();

        $artikels = (clone $baseQuery)
            ->when($featured, fn ($builder) => $builder->where('id', '!=', $featured->id))
            ->orderBy('tanggal_publikasi', 'desc')
            ->paginate(9)
            ->withQueryString();

        return view('artikel.index-public', compact('artikels', 'featured', 'selectedKategori', 'kategoriList'));
    }

    /**
     * Display the specified resource for public.
     */
    public function showPublic(Artikel $artikel)
    {
        if (!$artikel->aktif) {
            abort(404);
        }
        $relatedArtikels = Artikel::where('aktif', true)
            ->where('id', '!=', $artikel->id)
            ->orderBy('tanggal_publikasi', 'desc')
            ->take(3)
            ->get();

        return view('artikel.show-public', compact('artikel', 'relatedArtikels'));
    }
}
