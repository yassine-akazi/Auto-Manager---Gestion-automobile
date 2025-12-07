@extends('layouts.app')

@section('content')
<div class="max-w-3xl mx-auto bg-white p-6 shadow rounded">

<h2 class="text-2xl font-bold mb-4">Paramètres Facture</h2>

<form action="{{ route('invoice.settings.update') }}" method="POST" enctype="multipart/form-data">
    @csrf

    <label class="block font-semibold">Nom de l'entreprise</label>
    <input name="company_name" class="input" value="{{ $settings->company_name }}">

    <label class="block font-semibold mt-3">Téléphone</label>
    <input name="company_phone" class="input" value="{{ $settings->company_phone }}">

    <label class="block font-semibold mt-3">Adresse</label>
    <input name="company_address" class="input" value="{{ $settings->company_address }}">

    <label class="block font-semibold mt-3">Logo</label>
    <input type="file" name="logo" class="input">

    @if($settings->logo)
        <img src="{{ asset('storage/'.$settings->logo) }}" class="h-20 mt-2">
    @endif

    <label class="block font-semibold mt-3">Texte du bas (footer)</label>
    <textarea name="footer_text" class="input h-24">{{ $settings->footer_text }}</textarea>

    <button class="bg-red-600 text-white px-4 py-2 rounded mt-4">Enregistrer</button>
</form>

</div>
@endsection