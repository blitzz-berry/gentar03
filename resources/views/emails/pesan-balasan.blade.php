<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Balasan Pesan</title>
</head>
<body style="font-family: Arial, sans-serif; color: #1f2937; line-height: 1.6;">
    <p>Halo {{ $pesanKontak->nama }},</p>

    <p>Terima kasih sudah menghubungi kami. Berikut balasan dari admin:</p>

    <div style="padding: 12px; border: 1px solid #d1d5db; border-radius: 8px; background: #f9fafb;">
        {!! nl2br(e($pesanBalasan)) !!}
    </div>

    <p style="margin-top: 20px; margin-bottom: 6px;"><strong>Ringkasan pesan Anda:</strong></p>
    <p style="margin: 0 0 6px 0;"><strong>Subjek:</strong> {{ $pesanKontak->subjek }}</p>
    <p style="margin: 0;">{{ $pesanKontak->pesan }}</p>

    <p style="margin-top: 20px;">Salam,<br>Admin {{ config('app.name') }}</p>
</body>
</html>

