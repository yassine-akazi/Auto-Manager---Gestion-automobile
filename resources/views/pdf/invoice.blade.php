<!DOCTYPE html>
<html lang="fr">
<head>
<meta charset="UTF-8">
<style>
    body { font-family: DejaVu Sans, sans-serif; font-size: 12px; color:#222; }
    .header { display:flex; justify-content:space-between; border-bottom:3px solid #1E88E5; padding-bottom:10px; margin-bottom:20px; }
    .company-info { font-size: 12px; line-height: 1.4; }
    .title { font-size: 26px; font-weight: bold; color: #1E88E5; }
    .table { width: 100%; border-collapse: collapse; margin-top: 15px; }
    .table th { background:#1E88E5; color:white; padding:8px; }
    .table td { padding:8px; border:1px solid #ddd; }
    .totals { margin-top: 20px; width: 300px; float:right; }
    .totals tr td:first-child { font-weight:bold; }
</style>
</head>
<body>

<div class="header">
    <div>
        @if($invoice->logo)
            <img src="{{ public_path('storage/'.$invoice->logo) }}" style="height:70px;">
        @endif
        <div class="company-info">
            <strong>{{ $invoice->entreprise_nom }}</strong><br>
            {{ $invoice->entreprise_adresse }}<br>
            Tél : {{ $invoice->entreprise_tel }}
        </div>
    </div>

    <div style="text-align:right">
        <div class="title">FACTURE</div>
        <div><strong>Date :</strong> {{ $invoice->date_emission->format('d/m/Y') }}</div>
        <div><strong>N° :</strong> {{ $invoice->numero }}</div>
    </div>
</div>

<h3>🧍 Informations Client</h3>
<table class="table">
    <tr><th style="width:30%">Nom</th><td>{{ $invoice->client->nom }}</td></tr>
    <tr><th>Adresse</th><td>{{ $invoice->client->adresse ?? '-' }}</td></tr>
    <tr><th>Téléphone</th><td>{{ $invoice->client->telephone ?? '-' }}</td></tr>
    <tr><th>Email</th><td>{{ $invoice->client->email ?? '-' }}</td></tr>
</table>

<h3 style="margin-top:20px;">📦 Produits / Services</h3>

<table class="table">
    <thead>
        <tr>
            <th>Désignation</th>
            <th style="text-align:center">Qté</th>
            <th style="text-align:right">Prix HT</th>
            <th style="text-align:right">Total HT</th>
        </tr>
    </thead>
    <tbody>
        @php $totalHT = 0; @endphp

        @foreach($invoice->products as $p)
            @php 
                $line = $p['qty'] * $p['prix'];
                $totalHT += $line;
            @endphp
            <tr>
                <td>{{ $p['nom'] }}</td>
                <td style="text-align:center">{{ $p['qty'] }}</td>
                <td style="text-align:right">{{ number_format($p['prix'], 2, ',', ' ') }} DH</td>
                <td style="text-align:right">{{ number_format($line, 2, ',', ' ') }} DH</td>
            </tr>
        @endforeach
    </tbody>
</table>

@php
    $tvaRate = floatval($invoice->tva_rate ?? 0);       // ex : 20
    $tvaAmount = $totalHT * ($tvaRate / 100);           // tva en DH
    $totalTTC = $totalHT + $tvaAmount;
@endphp

<h3 style="margin-top:25px;">💶 Totaux</h3>

<table class="totals">
    <tr>
        <td>Total HT :</td>
        <td style="text-align:right">{{ number_format($totalHT, 2, ',', ' ') }} DH</td>
    </tr>
    <tr>
        <td>TVA ({{ $tvaRate }}%) :</td>
        <td style="text-align:right">{{ number_format($tvaAmount, 2, ',', ' ') }} DH</td>
    </tr>
    <tr>
        <td>Total TTC :</td>
        <td style="text-align:right; font-weight:bold">
            {{ number_format($totalTTC, 2, ',', ' ') }} DH
        </td>
    </tr>
</table>

</div>

</body>
</html>