@extends('layouts.app')

@section('content')
<style>
    @import url('https://fonts.googleapis.com/css2?family=Cinzel:wght@400;700&family=Playfair+Display&display=swap');

    .wasiat-bg {
        background: url('https://www.transparenttextures.com/patterns/old-moon.png'), #fdf6e3;
        font-family: 'Cinzel', serif;
        padding: 2rem;
        border-radius: 1rem;
        border: 2px solid #d6c7a1;
        box-shadow: 0 0 25px rgba(0,0,0,0.1);
    }

    .wasiat-label {
        font-family: 'Playfair Display', serif;
        font-weight: 700;
        font-size: 1.1rem;
        color: #3a3226;
    }

    .wasiat-input,
    .wasiat-textarea,
    .wasiat-select {
        background-color: rgba(255,255,255,0.8);
        color: #3a3226;
        border: 1px solid #bfae8e;
        border-radius: 0.375rem;
        padding: 0.5rem 1rem;
        width: 100%;
    }

    .submit-btn {
        background-color: #8b6a4a;
        color: #fff;
        font-weight: bold;
        border-radius: 0.375rem;
        padding: 0.75rem 1.5rem;
        margin-top: 1rem;
        transition: background 0.3s ease;
    }

    .submit-btn:hover {
        background-color: #a48261;
    }

    .page-title {
        font-family: 'Cinzel', serif;
        font-size: 2rem;
        font-weight: bold;
        color: #5e473a;
        margin-bottom: 1rem;
        text-align: center;
    }
</style>

<div class="max-w-3xl mx-auto mt-10 fade-in">
    <div class="wasiat-bg">
        <h1 class="page-title">Tulis Surat Wasiat Anda</h1>
        <form method="POST" action="{{ route('messages.store') }}">
            @csrf

            <div class="mb-4">
                <label class="wasiat-label" for="recipient_name">Nama Penerima</label>
                <input type="text" id="recipient_name" name="recipient_name" class="wasiat-input" required>
            </div>

            <div class="mb-4">
                <label class="wasiat-label" for="recipient_email">Email Penerima</label>
                <input type="email" id="recipient_email" name="recipient_email" class="wasiat-input" required>
            </div>

            <div class="mb-4">
                <label class="wasiat-label" for="delivery_schedule">Jadwal Pengiriman</label>
                <select id="delivery_schedule" name="delivery_schedule" class="wasiat-select" required>
                    <option value="upon-death">Setelah saya meninggal dunia</option>
                    <option value="birthday">Saat ulang tahun penerima</option>
                </select>
            </div>

            <div class="mb-4">
                <label class="wasiat-label" for="message">Isi Pesan Wasiat</label>
                <textarea id="message" name="message" rows="6" class="wasiat-textarea" required></textarea>
            </div>

            <div class="mb-4 flex items-center space-x-2">
                <input type="checkbox" id="repeat_yearly" name="repeat_yearly" class="accent-[#8b6a4a]">
                <label for="repeat_yearly" class="wasiat-label text-sm font-normal">Kirim ulang setiap tahun</label>
            </div>

            <button type="submit" class="submit-btn">Kirim Wasiat</button>
        </form>
    </div>
</div>
@endsection
