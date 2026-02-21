<?php

namespace App\Livewire;

use Livewire\Component;

class HeroCarousel extends Component
{
    public function render()
    {
        $images = [
            asset('media/site/hero-1.jpg'),
            asset('media/site/hero-2.jpg'),
            asset('media/site/hero-3.jpg'),
        ];

        return view('livewire.hero-carousel', [
            'images' => $images,
        ]);
    }
}
