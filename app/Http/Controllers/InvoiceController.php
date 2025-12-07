<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Invoice;
use App\Models\Client;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Storage;

class InvoiceController extends Controller
{
    public function create()
    {
        $clients = Client::all();
        return view('invoices.create', compact('clients'));
    }
    
    public function store(Request $request)
    {
        $request->validate([
            'client_id' => 'required|exists:clients,id',
            'products' => 'required|array',
            'logo' => 'nullable|image|max:2048',
            'tva_rate' => 'nullable|numeric|min:0|max:100'
        ]);

        // Upload logo
        $logo = null;
        if ($request->hasFile('logo')) {
            $logo = $request->file('logo')->store('logos', 'public');
        }

        // Calculate total HT
        $total = 0;
        foreach ($request->products as $product) {
            $total += $product['qty'] * $product['prix'];
        }

        // TVA (convert % to decimal)
        $tva_rate = ($request->tva_rate ?? 20) / 100;

        // Invoice number
        $lastInvoice = Invoice::latest()->first();
        $numero = 'F-' . str_pad(($lastInvoice?->id ?? 0) + 1, 4, '0', STR_PAD_LEFT);

        // Save invoice
        $invoice = Invoice::create([
            'client_id' => $request->client_id,
            'numero' => $numero,
            'products' => $request->products,
            'logo' => $logo,
            'total' => $total,
            'montant' => $total,
            'tva_amount' => $request->tva_amount,
            'date_emission' => now(),
            'entreprise_nom' => $request->entreprise_nom,
            'entreprise_adresse' => $request->entreprise_adresse,
            'entreprise_tel' => $request->entreprise_tel,
        ]);

        $invoice->refresh();

        // Generate PDF
        $pdf = Pdf::loadView('invoices.template', compact('invoice'));

        return $pdf->download('invoice-' . $invoice->numero . '.pdf');
    }


    public function index()
    {
        $invoices = Invoice::latest()->get();
        return view('invoices.index', compact('invoices'));
    }

    public function download(Invoice $invoice)
    {
        $path = $invoice->invoice_path ?? 'invoices/'.$invoice->numero.'.pdf';
        if (!Storage::disk('public')->exists($path)) {
            abort(404, 'Invoice not found.');
        }
        return response()->download(storage_path('app/public/'.$path));
    }
}