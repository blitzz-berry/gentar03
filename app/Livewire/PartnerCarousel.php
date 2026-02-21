<?php

namespace App\Livewire;

use Livewire\Component;

class PartnerCarousel extends Component
{
    public array $partners = [];
    public int $activeIndex = 0;

    public function mount(): void
    {
        $this->partners = [
            ['name' => 'Campina', 'logo' => '/media/site/partner-campina.png', 'url' => '#'],
            ['name' => 'Smartkidz', 'logo' => '/media/site/partner-smartkidz.png', 'url' => '#'],
        ];
    }

    public function next(): void
    {
        $count = count($this->partners);
        if ($count === 0) {
            return;
        }

        $this->activeIndex = ($this->activeIndex + 1) % $count;
    }

    public function goTo(int $index): void
    {
        $count = count($this->partners);
        if ($count === 0) {
            return;
        }

        $this->activeIndex = ($index % $count + $count) % $count;
    }

    public function render()
    {
        return view('livewire.partner-carousel');
    }
}
