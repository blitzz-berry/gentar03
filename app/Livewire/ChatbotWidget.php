<?php

namespace App\Livewire;

use Illuminate\Support\Str;
use Livewire\Component;

class ChatbotWidget extends Component
{
    public bool $isOpen = false;

    public bool $isMinimized = false;

    public bool $showTooltip = true;

    public bool $showWelcomeCard = true;

    public bool $showTimestamp = false;

    public string $newMessage = '';

    public array $messages = [];

    public string $chatState = 'idle';

    public ?int $participantAge = null;

    public ?string $selectedLombaCode = null;

    public array $filteredLombaCodes = [];

    public array $registrationForm = [
        'nama_anak' => '',
        'nama_ortu' => '',
        'no_hp' => '',
    ];

    public array $lombas = [];

    public int $styleCursor = 0;

    public function mount(): void
    {
        $this->seedLombas();
        $this->seedInitialMessages();
    }

    public function openPanel(): void
    {
        $this->isOpen = true;
        $this->isMinimized = false;
        $this->showTooltip = false;
        $this->dispatch('chatbot-scroll');
    }

    public function closePanel(): void
    {
        $this->isOpen = false;
        $this->isMinimized = false;
    }

    public function minimizePanel(): void
    {
        $this->isMinimized = true;
    }

    public function restorePanel(): void
    {
        $this->isOpen = true;
        $this->isMinimized = false;
        $this->dispatch('chatbot-scroll');
    }

    public function dismissTooltip(): void
    {
        $this->showTooltip = false;
    }

    public function useQuickReply(string $label): void
    {
        $this->handleUserMessage($label);
    }

    public function sendMessage(): void
    {
        $message = trim($this->newMessage);

        if ($message === '') {
            return;
        }

        $this->newMessage = '';
        $this->handleUserMessage($message);
    }

    public function handleWelcomeCta(string $cta): void
    {
        $this->handleUserMessage($cta);
    }

    protected function handleUserMessage(string $message): void
    {
        $this->showWelcomeCard = false;
        $this->appendMessage('user', $message);

        usleep(350000);

        $reply = $this->buildBotReply($message);
        $this->appendMessage('bot', $reply['text'], $reply['quick_replies']);
        $this->dispatch('chatbot-scroll');
    }

    protected function seedInitialMessages(): void
    {
        $this->messages = [];
        $this->chatState = 'idle';
        $this->participantAge = null;
        $this->selectedLombaCode = null;
        $this->filteredLombaCodes = [];
        $this->resetRegistrationForm();

        $this->appendMessage(
            'bot',
            "Halo, aku Si Panitia Santuy.\nMau cari info lomba, jadwal, atau daftar peserta?\nSantai, kita atur bareng.",
            $this->defaultQuickReplies()
        );
    }

    protected function appendMessage(string $sender, string $text, array $quickReplies = []): void
    {
        $normalizedText = $sender === 'bot'
            ? $this->formatBotMessageText($text)
            : trim($text);

        $this->messages[] = [
            'id' => (string) Str::uuid(),
            'sender' => $sender,
            'text' => $normalizedText,
            'time' => now()->format('H:i'),
            'quick_replies' => $sender === 'bot' ? $quickReplies : [],
        ];
    }

    protected function buildBotReply(string $input): array
    {
        $normalized = strtolower(trim($input));

        return match ($this->chatState) {
            'ask_age' => $this->handleAskAgeState($normalized),
            'ask_pick_lomba' => $this->handleAskPickLombaState($normalized),
            'collect_form' => $this->handleCollectFormState($input),
            'confirm_form' => $this->handleConfirmFormState($normalized),
            'success_done' => $this->handleSuccessState($normalized),
            default => $this->handleGeneralState($normalized),
        };
    }

    protected function handleGeneralState(string $normalized): array
    {
        if ($this->containsAny($normalized, ['daftar lomba', 'lomba', 'daftar sekarang', 'tentang lomba'])) {
            return $this->showLombaListAndAskAge();
        }

        if ($this->containsAny($normalized, ['jadwal'])) {
            return [
                'text' => $this->openWithStyle()."\nJadwal utamanya begini:\n- 08.00 pembukaan\n- 09.00 lomba anak\n- 19.30 final futsal\nDatang agak awal biar enak pilih spot.",
                'quick_replies' => ['Daftar Lomba', 'Info Lokasi', 'Kontak Panitia'],
            ];
        }

        if ($this->containsAny($normalized, ['lokasi', 'tempat'])) {
            return [
                'text' => $this->openWithStyle()."\nLokasi di lapangan RW 03 Duri Kosambi.\nPatokannya dekat pos RW dan panggung kuning.\nKalau nyasar, tinggal chat lagi.",
                'quick_replies' => ['Lihat Jadwal', 'Daftar Lomba', 'Kontak Panitia'],
            ];
        }

        if ($this->containsAny($normalized, ['kontak', 'panitia'])) {
            return [
                'text' => $this->openWithStyle()."\nKontak panitia aktif: 0812-3456-7890.\nBiasanya cepat dibalas, kecuali pas lomba lagi rame.",
                'quick_replies' => ['Daftar Lomba', 'Lihat Jadwal', 'Info Lokasi'],
            ];
        }

        if ($this->containsAny($normalized, ['aturan'])) {
            return [
                'text' => $this->openWithStyle()."\nAturan intinya simple:\n- Main sportif\n- Daftar ulang sebelum lomba mulai\n- Keputusan juri final\nProtes boleh, asal tetap santuy.",
                'quick_replies' => ['Daftar Lomba', 'Lihat Jadwal', 'Kontak Panitia'],
            ];
        }

        $this->chatState = 'fallback';

        return [
            'text' => $this->openWithStyle()."\nAku bantu biar tidak muter.\nPilih menu cepat di bawah, nanti aku lanjutkan.",
            'quick_replies' => $this->defaultQuickReplies(),
        ];
    }

    protected function handleAskAgeState(string $normalized): array
    {
        $age = $this->extractAge($normalized);

        if ($age === null) {
            return [
                'text' => "Biar aku pilihin yang pas, umur anaknya berapa ya?\nCukup kirim angka umur aja.",
                'quick_replies' => ['Umur 7', 'Umur 12', 'Umur 17', 'Umur 25'],
            ];
        }

        if ($age < 1 || $age > 60) {
            return [
                'text' => "Kayaknya umur itu nggak masuk akal deh.\nCoba tulis angka yang benar ya.",
                'quick_replies' => ['Umur 7', 'Umur 12', 'Umur 17', 'Umur 25'],
            ];
        }

        $this->participantAge = $age;
        $this->filteredLombaCodes = $this->filterLombaCodesByAge($age);
        $this->chatState = 'show_filtered';

        if ($this->filteredLombaCodes === []) {
            $this->chatState = 'ask_age';

            return [
                'text' => "Untuk umur {$age}, belum ada kategori yang cocok.\nCoba kirim umur lain ya, nanti aku sortir lagi.",
                'quick_replies' => ['Umur 7', 'Umur 10', 'Umur 14', 'Umur 18'],
            ];
        }

        $text = $this->openWithStyle()."\nUmur {$age} cocok ke opsi ini:\n".$this->renderLombaLines($this->filteredLombaCodes)."\nPilih salah satu, ketik nama lomba atau nomornya.";

        $this->chatState = 'ask_pick_lomba';

        return [
            'text' => $text,
            'quick_replies' => $this->buildPickQuickReplies(),
        ];
    }

    protected function handleAskPickLombaState(string $normalized): array
    {
        $selectedCode = $this->resolveLombaSelection($normalized);

        if ($selectedCode === null) {
            return [
                'text' => "Aku belum nangkep pilihan lombanya.\nKetik nomor atau nama lomba yang kamu mau ya.",
                'quick_replies' => $this->buildPickQuickReplies(),
            ];
        }

        $selected = $this->findLombaByCode($selectedCode);
        if ($selected === null) {
            return [
                'text' => "Waduh, opsi itu tidak ada di list tadi.\nPilih yang ada di daftar ya.",
                'quick_replies' => $this->buildPickQuickReplies(),
            ];
        }

        if ($this->remainingSlots($selected) === 0) {
            return [
                'text' => "Waduh, yang ini udah full {$selected['registered']}/{$selected['quota']}.\nTapi tenang, masih ada opsi lain kok.",
                'quick_replies' => $this->buildPickQuickReplies(true),
            ];
        }

        $this->selectedLombaCode = $selected['code'];
        $this->chatState = 'collect_form';

        return [
            'text' => $this->openWithStyle()."\nMantap, kamu pilih {$selected['name']}.\nSekarang kirim data ini sekalian:\nNama Anak, Nama Ortu, No HP\nPisahkan pakai koma biar rapi.",
            'quick_replies' => ['Batal'],
        ];
    }

    protected function handleCollectFormState(string $input): array
    {
        $normalized = strtolower(trim($input));
        if ($this->containsAny($normalized, ['batal', 'cancel'])) {
            $this->chatState = 'idle';
            $this->selectedLombaCode = null;
            $this->resetRegistrationForm();

            return [
                'text' => "Sip, pendaftarannya aku batalin dulu.\nKalau mau lanjut lagi, tinggal bilang daftar lomba.",
                'quick_replies' => $this->defaultQuickReplies(),
            ];
        }

        $parsed = $this->parseRegistrationData($input);
        if ($parsed === null) {
            return [
                'text' => "Datanya belum lengkap nih.\nBiar aman, kirim sekalian: Nama Anak, Nama Ortu, No HP ya.",
                'quick_replies' => ['Batal'],
            ];
        }

        if (!$this->isValidPhone($parsed['no_hp'])) {
            return [
                'text' => "Nomornya kayaknya kurang digit nih.\nCoba cek lagi ya.",
                'quick_replies' => ['Batal'],
            ];
        }

        $this->registrationForm = $parsed;
        $this->chatState = 'confirm_form';

        $selected = $this->findLombaByCode($this->selectedLombaCode);
        $lombaName = $selected['name'] ?? 'Lomba Pilihan';

        return [
            'text' => "Aku rekap dulu biar nggak salah panggil nanti.\nLomba: {$lombaName}\nNama Anak: {$parsed['nama_anak']}\nNama Ortu: {$parsed['nama_ortu']}\nNo HP: {$parsed['no_hp']}\nCek lagi ya, siapa tau typo dikit.",
            'quick_replies' => ['Ya, Daftarkan', 'Ubah Data', 'Batal'],
        ];
    }

    protected function handleConfirmFormState(string $normalized): array
    {
        if ($this->containsAny($normalized, ['ubah', 'edit'])) {
            $this->chatState = 'collect_form';

            return [
                'text' => "Oke, kirim ulang datanya ya.\nFormatnya tetap: Nama Anak, Nama Ortu, No HP.",
                'quick_replies' => ['Batal'],
            ];
        }

        if ($this->containsAny($normalized, ['batal', 'cancel'])) {
            $this->chatState = 'idle';
            $this->selectedLombaCode = null;
            $this->resetRegistrationForm();

            return [
                'text' => "Siap, pendaftarannya aku batalin.\nKalau berubah pikiran, tinggal chat lagi.",
                'quick_replies' => $this->defaultQuickReplies(),
            ];
        }

        if ($this->containsAny($normalized, ['ya', 'daftarkan', 'lanjut'])) {
            $this->chatState = 'success_done';
            $this->incrementSelectedLombaParticipant();

            return [
                'text' => "Resmi terdaftar! Calon juara RW nih.\nDatang minimal 5 menit sebelum mulai ya.\nKalau sampai dipanggil 3x nggak ada, panitia terpaksa coret.\nMau sekalian daftar lomba lain?",
                'quick_replies' => ['Daftar Lomba Lain', 'Lihat Jadwal Lengkap', 'Kontak Panitia'],
            ];
        }

        return [
            'text' => "Biar aman, pilih salah satu dulu ya:\nYa, Daftarkan\nUbah Data\nBatal",
            'quick_replies' => ['Ya, Daftarkan', 'Ubah Data', 'Batal'],
        ];
    }

    protected function handleSuccessState(string $normalized): array
    {
        if ($this->containsAny($normalized, ['daftar lomba lain', 'daftar lomba', 'lomba lain'])) {
            return $this->showLombaListAndAskAge();
        }

        if ($this->containsAny($normalized, ['lihat jadwal lengkap', 'lihat jadwal', 'jadwal'])) {
            return [
                'text' => "Jadwal lengkap siap nih:\n- 08.00 pembukaan\n- 09.00 lomba anak\n- 14.00 lomba remaja\n- 19.30 final futsal\nDatang lebih awal biar santai.",
                'quick_replies' => ['Daftar Lomba Lain', 'Info Lokasi', 'Kontak Panitia'],
            ];
        }

        if ($this->containsAny($normalized, ['kontak'])) {
            return [
                'text' => "Kontak panitia: 0812-3456-7890.\nKalau butuh update cepat, chat nomor ini ya.",
                'quick_replies' => ['Daftar Lomba Lain', 'Lihat Jadwal Lengkap', 'Info Lokasi'],
            ];
        }

        if ($this->containsAny($normalized, ['selesai', 'cukup', 'makasih', 'terima kasih'])) {
            $this->chatState = 'idle';
            $this->selectedLombaCode = null;
            $this->participantAge = null;
            $this->filteredLombaCodes = [];
            $this->resetRegistrationForm();

            return [
                'text' => "Sip, kapan pun butuh info lomba tinggal panggil lagi.\nAku standby di sini.",
                'quick_replies' => $this->defaultQuickReplies(),
            ];
        }

        return [
            'text' => "Mau lanjut apa nih?\nKamu bisa daftar lomba lain atau cek jadwal lengkap.",
            'quick_replies' => ['Daftar Lomba Lain', 'Lihat Jadwal Lengkap', 'Kontak Panitia'],
        ];
    }

    protected function showLombaListAndAskAge(): array
    {
        $this->chatState = 'list_lomba';
        $this->participantAge = null;
        $this->selectedLombaCode = null;
        $this->filteredLombaCodes = [];
        $this->resetRegistrationForm();

        $text = $this->openWithStyle()."\nIni daftar lomba yang lagi dibuka:\n".$this->renderLombaLines(array_column($this->lombas, 'code'))."\nKasih tau umur dulu, nanti aku sortir yang cocok.";

        $this->chatState = 'ask_age';

        return [
            'text' => $text,
            'quick_replies' => ['Umur 7', 'Umur 12', 'Umur 17', 'Umur 25'],
        ];
    }

    protected function renderLombaLines(array $codes): string
    {
        $lines = [];
        $index = 1;

        foreach ($codes as $code) {
            $lomba = $this->findLombaByCode($code);
            if ($lomba === null) {
                continue;
            }

            $remaining = $this->remainingSlots($lomba);
            $status = $remaining === 0
                ? "full {$lomba['registered']}/{$lomba['quota']}"
                : "sisa {$remaining} slot";

            $tail = $remaining === 0
                ? 'Waduh, tiketnya habis.'
                : ($remaining <= 3 ? 'Sisa dikit nih, jangan keduluan tetangga sebelah.' : $lomba['fun_note']);

            $lines[] = "{$index}. {$lomba['name']} - {$status}. {$tail}";
            $index++;
        }

        return implode("\n", $lines);
    }

    protected function buildPickQuickReplies(bool $onlyAvailable = false): array
    {
        $replies = [];

        foreach ($this->filteredLombaCodes as $code) {
            $lomba = $this->findLombaByCode($code);
            if ($lomba === null) {
                continue;
            }

            if ($onlyAvailable && $this->remainingSlots($lomba) === 0) {
                continue;
            }

            $replies[] = $lomba['name'];

            if (count($replies) >= 4) {
                break;
            }
        }

        if ($replies === []) {
            return ['Daftar Lomba', 'Lihat Jadwal', 'Info Lokasi'];
        }

        return $replies;
    }

    protected function resolveLombaSelection(string $normalized): ?string
    {
        if (preg_match('/\d+/', $normalized, $matches) === 1) {
            $index = (int) $matches[0] - 1;
            if (isset($this->filteredLombaCodes[$index])) {
                return $this->filteredLombaCodes[$index];
            }
        }

        foreach ($this->filteredLombaCodes as $code) {
            $lomba = $this->findLombaByCode($code);
            if ($lomba && str_contains($normalized, strtolower($lomba['name']))) {
                return $code;
            }
        }

        return null;
    }

    protected function filterLombaCodesByAge(int $age): array
    {
        $codes = [];

        foreach ($this->lombas as $lomba) {
            if ($age >= $lomba['age_min'] && $age <= $lomba['age_max']) {
                $codes[] = $lomba['code'];
            }
        }

        return $codes;
    }

    protected function findLombaByCode(?string $code): ?array
    {
        if ($code === null) {
            return null;
        }

        foreach ($this->lombas as $lomba) {
            if ($lomba['code'] === $code) {
                return $lomba;
            }
        }

        return null;
    }

    protected function incrementSelectedLombaParticipant(): void
    {
        if ($this->selectedLombaCode === null) {
            return;
        }

        foreach ($this->lombas as $index => $lomba) {
            if ($lomba['code'] !== $this->selectedLombaCode) {
                continue;
            }

            if ($lomba['registered'] < $lomba['quota']) {
                $this->lombas[$index]['registered'] = $lomba['registered'] + 1;
            }
            break;
        }
    }

    protected function remainingSlots(array $lomba): int
    {
        $remaining = $lomba['quota'] - $lomba['registered'];

        return $remaining > 0 ? $remaining : 0;
    }

    protected function parseRegistrationData(string $input): ?array
    {
        $parts = array_values(array_filter(array_map('trim', explode(',', $input)), fn ($value) => $value !== ''));

        if (count($parts) < 3) {
            return null;
        }

        return [
            'nama_anak' => $parts[0],
            'nama_ortu' => $parts[1],
            'no_hp' => $parts[2],
        ];
    }

    protected function isValidPhone(string $value): bool
    {
        $digits = preg_replace('/\D/', '', $value) ?? '';

        return strlen($digits) >= 10;
    }

    protected function extractAge(string $input): ?int
    {
        if (preg_match('/\d+/', $input, $matches) !== 1) {
            return null;
        }

        return (int) $matches[0];
    }

    protected function containsAny(string $text, array $keywords): bool
    {
        foreach ($keywords as $keyword) {
            if (str_contains($text, $keyword)) {
                return true;
            }
        }

        return false;
    }

    protected function openWithStyle(): string
    {
        $openers = [
            'Siappp, kita cek ya.',
            'Gas, aku bantu cek dulu.',
            'Oke, aku spill dulu nih.',
            'Wah ini seru sih, lanjut.',
            'Santai, aku bantu pelan-pelan ya.',
        ];

        $opener = $openers[$this->styleCursor % count($openers)];
        $this->styleCursor++;

        return $opener;
    }

    protected function defaultQuickReplies(): array
    {
        return [
            'Daftar Lomba',
            'Lihat Jadwal',
            'Info Lokasi',
            'Kontak Panitia',
            'Aturan Lomba',
        ];
    }

    protected function formatBotMessageText(string $text): string
    {
        $normalized = str_replace(["\r\n", "\r"], "\n", trim($text));
        $lines = explode("\n", $normalized);

        $cleanedLines = array_map(function (string $line): string {
            if ($line === '') {
                return '';
            }

            return preg_replace('/\s+/', ' ', trim($line)) ?? trim($line);
        }, $lines);

        $result = implode("\n", $cleanedLines);

        return preg_replace("/\n{3,}/", "\n\n", $result) ?? $result;
    }

    protected function resetRegistrationForm(): void
    {
        $this->registrationForm = [
            'nama_anak' => '',
            'nama_ortu' => '',
            'no_hp' => '',
        ];
    }

    protected function seedLombas(): void
    {
        $this->lombas = [
            [
                'code' => 'estafet-anak',
                'name' => 'Estafet Ceria Anak',
                'age_min' => 6,
                'age_max' => 12,
                'quota' => 16,
                'registered' => 8,
                'fun_note' => 'Ini favorit bocil tiap tahun.',
            ],
            [
                'code' => 'balap-karung',
                'name' => 'Balap Karung Klasik',
                'age_min' => 8,
                'age_max' => 20,
                'quota' => 20,
                'registered' => 18,
                'fun_note' => 'Yang ini biasanya paling heboh.',
            ],
            [
                'code' => 'futsal-remaja',
                'name' => 'Futsal Remaja',
                'age_min' => 13,
                'age_max' => 25,
                'quota' => 16,
                'registered' => 15,
                'fun_note' => 'Yang ini siap-siap tepuk tangan paling kenceng.',
            ],
            [
                'code' => 'tarik-tambang',
                'name' => 'Tarik Tambang Umum',
                'age_min' => 15,
                'age_max' => 45,
                'quota' => 20,
                'registered' => 20,
                'fun_note' => 'Ini langganan jadi penentu gengsi RT.',
            ],
            [
                'code' => 'karaoke-warga',
                'name' => 'Karaoke Warga',
                'age_min' => 17,
                'age_max' => 60,
                'quota' => 18,
                'registered' => 11,
                'fun_note' => 'Mic panas, penonton makin semangat.',
            ],
        ];
    }

    public function render()
    {
        return view('livewire.chatbot-widget');
    }
}
