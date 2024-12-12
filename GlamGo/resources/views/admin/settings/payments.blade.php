@extends('layouts.admin')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Payment Settings</h3>
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.settings.payments.update') }}" method="POST">
                        @csrf
                        @method('PUT')
                        
                        <!-- Payment Methods -->
                        <div class="mb-4">
                            <h4>Payment Methods</h4>
                            <div class="form-check mb-2">
                                <input type="checkbox" class="form-check-input" id="accept_cash" name="accept_cash" {{ setting('accept_cash') ? 'checked' : '' }}>
                                <label class="form-check-label" for="accept_cash">Accept Cash Payments</label>
                            </div>
                            <div class="form-check mb-2">
                                <input type="checkbox" class="form-check-input" id="accept_cards" name="accept_cards" {{ setting('accept_cards') ? 'checked' : '' }}>
                                <label class="form-check-label" for="accept_cards">Accept Card Payments</label>
                            </div>
                            <div class="form-check mb-2">
                                <input type="checkbox" class="form-check-input" id="accept_online" name="accept_online" {{ setting('accept_online') ? 'checked' : '' }}>
                                <label class="form-check-label" for="accept_online">Accept Online Payments</label>
                            </div>
                        </div>

                        <!-- Currency Settings -->
                        <div class="mb-4">
                            <h4>Currency Settings</h4>
                            <div class="form-group">
                                <label for="currency">Default Currency</label>
                                <select class="form-control" id="currency" name="currency">
                                    <option value="USD" {{ setting('currency') === 'USD' ? 'selected' : '' }}>USD ($)</option>
                                    <option value="EUR" {{ setting('currency') === 'EUR' ? 'selected' : '' }}>EUR (€)</option>
                                    <option value="GBP" {{ setting('currency') === 'GBP' ? 'selected' : '' }}>GBP (£)</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="currency_symbol_position">Currency Symbol Position</label>
                                <select class="form-control" id="currency_symbol_position" name="currency_symbol_position">
                                    <option value="before" {{ setting('currency_symbol_position') === 'before' ? 'selected' : '' }}>Before Amount ($100)</option>
                                    <option value="after" {{ setting('currency_symbol_position') === 'after' ? 'selected' : '' }}>After Amount (100$)</option>
                                </select>
                            </div>
                        </div>

                        <!-- Invoice Settings -->
                        <div class="mb-4">
                            <h4>Invoice Settings</h4>
                            <div class="form-group">
                                <label for="invoice_prefix">Invoice Number Prefix</label>
                                <input type="text" class="form-control" id="invoice_prefix" name="invoice_prefix" value="{{ old('invoice_prefix', setting('invoice_prefix')) }}">
                            </div>
                            <div class="form-group">
                                <label for="invoice_footer_text">Invoice Footer Text</label>
                                <textarea class="form-control" id="invoice_footer_text" name="invoice_footer_text" rows="3">{{ old('invoice_footer_text', setting('invoice_footer_text')) }}</textarea>
                            </div>
                        </div>

                        <button type="submit" class="btn btn-primary">Save Changes</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
