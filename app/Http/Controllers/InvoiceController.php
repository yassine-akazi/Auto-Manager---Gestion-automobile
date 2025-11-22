<?php

namespace App\Http\Controllers;

use App\Models\Invoice;
use App\Models\Client;
use Illuminate\Http\Request;

class InvoiceController extends Controller
{
    public function index()
    {
        $invoices = Invoice::with('client')->latest()->paginate(10);
        return view('invoices.index', compact('invoices'));
    }

    public function create()
    {
        $clients = Client::all();
        return view('invoices.create', compact('clients'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'client_id' => 'required|exists:clients,id',
            'numero' => 'required|unique:invoices,numero',
            'date_emission' => 'required|date',
            'montant' => 'required|numeric',
        ]);

        Invoice::create($request->all());
        return redirect()->route('invoices.index')->with('success', 'Facture ajoutée avec succès.');
    }

    public function show(Invoice $invoice)
    {
        return view('invoices.show', compact('invoice'));
    }

    public function edit(Invoice $invoice)
    {
        $clients = Client::all();
        return view('invoices.edit', compact('invoice','clients'));
    }

    public function update(Request $request, Invoice $invoice)
    {
        $request->validate([
            'client_id' => 'required|exists:clients,id',
            'numero' => 'required|unique:invoices,numero,'.$invoice->id,
            'date_emission' => 'required|date',
            'montant' => 'required|numeric',
        ]);

        $invoice->update($request->all());
        return redirect()->route('invoices.index')->with('success', 'Facture mise à jour.');
    }

    public function destroy(Invoice $invoice)
    {
        $invoice->delete();
        return redirect()->route('invoices.index')->with('success', 'Facture supprimée.');
    }
}