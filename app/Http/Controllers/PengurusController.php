<?php

namespace App\Http\Controllers;

use App\Models\Pengurus;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Laravel\Facades\Image;

class PengurusController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->authorizeResource(Pengurus::class, 'pengurus');
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $penguruses = Pengurus::orderBy('created_at', 'desc')->paginate(10);
        return view('pengurus.index', compact('penguruses'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('pengurus.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'jabatan' => 'required|string|max:255',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:8192',
            'masa_jabatan' => 'required|string|max:20',
            'deskripsi' => 'nullable|string',
        ]);

        $data = $request->except('foto');

        if ($request->hasFile('foto')) {
            $image = $request->file('foto');
            $filename = time() . '_' . $image->getClientOriginalName();
            $path = 'pengurus/' . $filename;
            $fullPath = storage_path('app/public/' . $path);
            $extension = strtolower($image->getClientOriginalExtension());

            Storage::disk('public')->makeDirectory('pengurus');
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

        Pengurus::create($data);

        return redirect()->route('pengurus.index')->with('success', 'Pengurus berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Pengurus $pengurus)
    {
        return view('pengurus.show', compact('pengurus'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Pengurus $pengurus)
    {
        return view('pengurus.edit', compact('pengurus'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Pengurus $pengurus)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'jabatan' => 'required|string|max:255',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:8192',
            'masa_jabatan' => 'required|string|max:20',
            'deskripsi' => 'nullable|string',
        ]);

        $data = $request->except('foto');

        if ($request->hasFile('foto')) {
            // Delete old image if exists
            if ($pengurus->foto) {
                Storage::disk('public')->delete($pengurus->foto);
            }

            $image = $request->file('foto');
            $filename = time() . '_' . $image->getClientOriginalName();
            $path = 'pengurus/' . $filename;
            $fullPath = storage_path('app/public/' . $path);
            $extension = strtolower($image->getClientOriginalExtension());

            Storage::disk('public')->makeDirectory('pengurus');
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

        $pengurus->update($data);

        return redirect()->route('pengurus.index')->with('success', 'Pengurus berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Pengurus $pengurus)
    {
        // Delete image if exists
        if ($pengurus->foto) {
            Storage::disk('public')->delete($pengurus->foto);
        }

        $pengurus->delete();

        return redirect()->route('pengurus.index')->with('success', 'Pengurus berhasil dihapus.');
    }
}
