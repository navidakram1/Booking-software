@extends('layouts.admin')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Integrations Settings</h3>
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.settings.integrations.update') }}" method="POST">
                        @csrf
                        @method('PUT')
                        
                        <!-- Google Calendar Integration -->
                        <div class="mb-4">
                            <h4>Google Calendar</h4>
                            <div class="form-group">
                                <label for="google_calendar_api_key">API Key</label>
                                <input type="text" class="form-control" id="google_calendar_api_key" name="google_calendar_api_key" value="{{ old('google_calendar_api_key', setting('google_calendar_api_key')) }}">
                            </div>
                            <div class="form-check">
                                <input type="checkbox" class="form-check-input" id="google_calendar_enabled" name="google_calendar_enabled" {{ setting('google_calendar_enabled') ? 'checked' : '' }}>
                                <label class="form-check-label" for="google_calendar_enabled">Enable Google Calendar Integration</label>
                            </div>
                        </div>

                        <!-- SMS Integration -->
                        <div class="mb-4">
                            <h4>SMS Service</h4>
                            <div class="form-group">
                                <label for="sms_provider">SMS Provider</label>
                                <select class="form-control" id="sms_provider" name="sms_provider">
                                    <option value="twilio" {{ setting('sms_provider') === 'twilio' ? 'selected' : '' }}>Twilio</option>
                                    <option value="nexmo" {{ setting('sms_provider') === 'nexmo' ? 'selected' : '' }}>Nexmo</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="sms_api_key">API Key</label>
                                <input type="text" class="form-control" id="sms_api_key" name="sms_api_key" value="{{ old('sms_api_key', setting('sms_api_key')) }}">
                            </div>
                            <div class="form-group">
                                <label for="sms_api_secret">API Secret</label>
                                <input type="password" class="form-control" id="sms_api_secret" name="sms_api_secret" value="{{ old('sms_api_secret', setting('sms_api_secret')) }}">
                            </div>
                        </div>

                        <!-- Payment Gateway Integration -->
                        <div class="mb-4">
                            <h4>Payment Gateway</h4>
                            <div class="form-group">
                                <label for="payment_gateway">Payment Provider</label>
                                <select class="form-control" id="payment_gateway" name="payment_gateway">
                                    <option value="stripe" {{ setting('payment_gateway') === 'stripe' ? 'selected' : '' }}>Stripe</option>
                                    <option value="paypal" {{ setting('payment_gateway') === 'paypal' ? 'selected' : '' }}>PayPal</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="payment_api_key">API Key</label>
                                <input type="text" class="form-control" id="payment_api_key" name="payment_api_key" value="{{ old('payment_api_key', setting('payment_api_key')) }}">
                            </div>
                            <div class="form-group">
                                <label for="payment_api_secret">API Secret</label>
                                <input type="password" class="form-control" id="payment_api_secret" name="payment_api_secret" value="{{ old('payment_api_secret', setting('payment_api_secret')) }}">
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
