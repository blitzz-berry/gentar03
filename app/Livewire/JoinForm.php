<?php

namespace App\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Log;
use App\Models\PesanKontak;

class JoinForm extends Component
{
    public $name;
    public $email;
    public $phone;
    public $message;
    public $successMessage = '';
    public $errorMessage = '';
    public $isLoading = false;

    protected $rules = [
        'name' => 'required|string|max:255',
        'email' => 'required|email|max:255',
        'phone' => 'nullable|string|max:20',
        'message' => 'required|string|max:1000',
    ];

    public function submit()
    {
        $this->validate();

        $this->isLoading = true;

        try {
            $pesan = $this->message;
            if ($this->phone) {
                $pesan .= "\n\nNo. Telepon: {$this->phone}";
            }

            PesanKontak::create([
                'nama' => $this->name,
                'email' => $this->email,
                'subjek' => 'Form Bergabung Website',
                'pesan' => $pesan,
            ]);

            // Reset form
            $this->reset(['name', 'email', 'phone', 'message']);
            $this->successMessage = 'Pesan Anda telah berhasil dikirim!';

            // Clear success message after 5 seconds
            $this->dispatch('notify', message: 'Pesan berhasil dikirim!');
        } catch (\Exception $e) {
            Log::error('Error sending contact form: ' . $e->getMessage());
            $this->errorMessage = 'Terjadi kesalahan saat mengirim pesan. Silakan coba lagi.';
        } finally {
            $this->isLoading = false;
        }
    }

    public function render()
    {
        return view('livewire.join-form');
    }
}
