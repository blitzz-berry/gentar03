<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Galeri;

class GalleryGrid extends Component
{
    public $perPage = 6;

    public function loadMore()
    {
        $this->perPage += 6;
    }

    public function render()
    {
        $items = Galeri::where('aktif', true)
            ->orderBy('created_at', 'desc')
            ->take($this->perPage)
            ->get();

        return view('livewire.gallery-grid', ['items' => $items]);
    }
}
