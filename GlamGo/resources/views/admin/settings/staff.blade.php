@extends('layouts.admin')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Staff Settings</h3>
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.settings.staff.update') }}" method="POST">
                        @csrf
                        @method('PUT')
                        
                        <!-- Schedule Settings -->
                        <div class="mb-4">
                            <h4>Schedule Settings</h4>
                            <div class="form-group">
                                <label for="default_shift_duration">Default Shift Duration (hours)</label>
                                <input type="number" class="form-control" id="default_shift_duration" name="default_shift_duration" value="{{ old('default_shift_duration', setting('default_shift_duration')) }}" min="1" max="12">
                            </div>
                            <div class="form-group">
                                <label for="break_duration">Default Break Duration (minutes)</label>
                                <input type="number" class="form-control" id="break_duration" name="break_duration" value="{{ old('break_duration', setting('break_duration')) }}" min="15" max="120" step="15">
                            </div>
                        </div>

                        <!-- Leave Settings -->
                        <div class="mb-4">
                            <h4>Leave Settings</h4>
                            <div class="form-group">
                                <label for="annual_leave_days">Annual Leave Days</label>
                                <input type="number" class="form-control" id="annual_leave_days" name="annual_leave_days" value="{{ old('annual_leave_days', setting('annual_leave_days')) }}" min="0" max="365">
                            </div>
                            <div class="form-group">
                                <label for="sick_leave_days">Sick Leave Days</label>
                                <input type="number" class="form-control" id="sick_leave_days" name="sick_leave_days" value="{{ old('sick_leave_days', setting('sick_leave_days')) }}" min="0" max="365">
                            </div>
                            <div class="form-check">
                                <input type="checkbox" class="form-check-input" id="require_leave_approval" name="require_leave_approval" {{ setting('require_leave_approval') ? 'checked' : '' }}>
                                <label class="form-check-label" for="require_leave_approval">Require Leave Approval</label>
                            </div>
                        </div>

                        <!-- Commission Settings -->
                        <div class="mb-4">
                            <h4>Commission Settings</h4>
                            <div class="form-group">
                                <label for="default_commission_rate">Default Commission Rate (%)</label>
                                <input type="number" class="form-control" id="default_commission_rate" name="default_commission_rate" value="{{ old('default_commission_rate', setting('default_commission_rate')) }}" min="0" max="100" step="0.1">
                            </div>
                            <div class="form-check">
                                <input type="checkbox" class="form-check-input" id="enable_service_specific_commission" name="enable_service_specific_commission" {{ setting('enable_service_specific_commission') ? 'checked' : '' }}>
                                <label class="form-check-label" for="enable_service_specific_commission">Enable Service-Specific Commission Rates</label>
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
