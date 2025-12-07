<!DOCTYPE html>
<html lang="fr">
<head>
<meta charset="UTF-8">
<title>Facture {{ $invoice->numero }}</title>
<style>
@page { size: A4; margin: 15mm; }
body { font-family: DejaVu Sans, sans-serif; font-size: 12px; color: #222; margin:0; padding:0; }
.header { display:flex; justify-content:space-between; align-items:flex-start; border-bottom:3px solid #1E40AF; padding-bottom:10px; margin-bottom:20px; }
.company { font-weight:700; color:#1E40AF; }
.company-details { font-size:11px; color:#555; margin-top:3px; }
.invoice-title { font-size:22px; font-weight:700; color:#1E40AF; }
.invoice-meta { font-size:11px; margin-top:5px; }
.table { width:100%; border-collapse: collapse; margin-top:15px; }
.table th, .table td { border:1px solid #ddd; padding:6px; text-align:left; }
.table th { background:#1E40AF; color:#fff; }
.right { text-align:right; }
.totals { margin-top:15px; width:100%; }
.totals td { padding:6px; }
.totals .label { font-weight:700; }
.footer { margin-top:25px; font-size:10px; text-align:center; color:#555; border-top:1px solid #ddd; padding-top:10px; }
</style>
</head>
<body>

<!-- HEADER -->
<div class="header">
    <div>
        <div class="company">{{ $invoice->entreprise_nom }}</div>
        <div class="company-details">{{ $invoice->entreprise_adresse }} | Tél: {{ $invoice->entreprise_tel }}</div>
    </div>
    <div>
        <div class="invoice-title">FACTURE</div>
        <div class="invoice-meta">Date: {{ $invoice->date_emission->format('d/m/Y') }}</div>
        <div class="invoice-meta">N°: {{ $invoice->numero }}</div>
    </div>
</div>

<!-- CLIENT -->
<h3>Client</h3>
<p>{{ $invoice->client->nom ?? '-' }}</p>
<p>{{ $invoice->client->adresse ?? '-' }}</p>
<p>{{ $invoice->client->telephone ?? '-' }}</p>

<!-- PRODUITS -->
<h3>Produits / Services</h3>
<table class="table">
    <thead>
        <tr>
            <th>Nom</th>
            <th>Qté</th>
            <th>PU</th>
            <th>Total HT</th>
        </tr>
    </thead>
    <tbody>
        @foreach($invoice->products as $p)
            <tr>
                <td>{{ $p['nom'] }}</td>
                <td>{{ $p['qty'] }}</td>
                <td class="right">{{ number_format($p['prix'],2,',',' ') }} DH</td>
                <td class="right">{{ number_format($p['line_total'] ?? ($p['qty']*$p['prix']),2,',',' ') }} DH</td>
            </tr>
        @endforeach
    </tbody>
</table>

<!-- TOTALS from form -->
<table class="totals">
    <tr>
        <td class="label">Total HT</td>
        <td class="right">{{ number_format($invoice->total_ht ?? 0, 2, ',', ' ') }} DH</td>
    </tr>
    <tr>
        <td class="label">Montant TVA ({{ $invoice->tva_rate ?? 0 }}%)</td>
        <td class="right">{{ number_format($invoice->tva_amount ?? 0, 2, ',', ' ') }} DH</td>
    </tr>
    <tr>
        <td class="label"><b>Total TTC</b></td>
        <td class="right"><b>{{ number_format($invoice->total ?? 0, 2, ',', ' ') }} DH</b></td>
    </tr>
</table>

<!-- FOOTER -->
<div class="footer">
    {{ $invoice->entreprise_nom }} — {{ $invoice->entreprise_tel }} — {{ $invoice->entreprise_adresse }}
</div>

</body>
</html>