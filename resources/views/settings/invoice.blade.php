@extends('layouts.app')

@section('content')
<div class="max-w-2xl mx-auto bg-white p-6 shadow rounded">
    <h2 class="mb-4 text-2xl font-bold">Paramètres de la facture</h2>

    @if(session('success'))
        <div class="mb-3 text-green-600">{{ session('success') }}</div>
    @endif

    <form action="{{ route('settings.invoice.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="mb-3">
            <label class="block font-medium">Nom de l'entreprise</label>
            <input name="company_name" value="{{ old('company_name', $settings->company_name) }}" class="w-full border p-2 rounded">
        </div>

        <div class="mb-3">
            <label class="block font-medium">Logo</label>
            <input type="file" name="company_logo" class="w-full">
            @if($settings->company_logo)
                <img src="{{ asset('storage/'.$settings->company_logo) }}" class="h-20 mt-2">
            @endif
        </div>

        <div class="mb-3 grid grid-cols-2 gap-3">
            <div>
                <label class="block font-medium">Email</label>
                <input name="company_email" value="{{ old('company_email', $settings->company_email) }}" class="w-full border p-2 rounded">
            </div>
            <div>
                <label class="block font-medium">Téléphone</label>
                <input name="company_phone" value="{{ old('company_phone', $settings->company_phone) }}" class="w-full border p-2 rounded">
            </div>
        </div>

        <div class="mb-3">
            <label class="block font-medium">Adresse</label>
            <textarea name="company_address" class="w-full border p-2 rounded">{{ old('company_address', $settings->company_address) }}</textarea>
        </div>

        <div class="mb-3">
            <label class="block font-medium">Couleur principale</label>
            <input type="color" name="invoice_color" value="{{ old('invoice_color', $settings->invoice_color) }}">
        </div>

        <button class="bg-blue-600 text-white px-4 py-2 rounded">Sauvegarder</button>
    </form>
</div>
@endsection