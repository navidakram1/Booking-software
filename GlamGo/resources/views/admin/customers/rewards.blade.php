@extends('layouts.admin')

@section('content')
<div class="container-fluid px-4">
    <h1 class="mt-4">Customer Rewards</h1>
    <div class="card mb-4">
        <div class="card-header">
            <i class="fas fa-gift me-1"></i>
            Customer Reward Points
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="rewardsTable">
                    <thead>
                        <tr>
                            <th>Customer Name</th>
                            <th>Email</th>
                            <th>Total Points</th>
                            <th>Last Points Earned</th>
                            <th>Points History</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($customers as $customer)
                        <tr>
                            <td>{{ $customer->name }}</td>
                            <td>{{ $customer->email }}</td>
                            <td>{{ $customer->rewards->sum('points') }}</td>
                            <td>{{ $customer->rewards->sortByDesc('created_at')->first()?->created_at->format('M d, Y') ?? 'Never' }}</td>
                            <td>
                                <button type="button" class="btn btn-info btn-sm" 
                                        onclick="showPointsHistory({{ $customer->id }})">
                                    View History
                                </button>
                            </td>
                            <td>
                                <button type="button" class="btn btn-primary btn-sm" 
                                        onclick="addPoints({{ $customer->id }})">
                                    Add Points
                                </button>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            
            {{ $customers->links() }}
        </div>
    </div>
</div>

<!-- Points History Modal -->
<div class="modal fade" id="pointsHistoryModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Points History</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div id="pointsHistoryContent"></div>
            </div>
        </div>
    </div>
</div>

<!-- Add Points Modal -->
<div class="modal fade" id="addPointsModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Add Reward Points</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="addPointsForm" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label for="points" class="form-label">Points</label>
                        <input type="number" class="form-control" id="points" name="points" required>
                    </div>
                    <div class="mb-3">
                        <label for="reason" class="form-label">Reason</label>
                        <textarea class="form-control" id="reason" name="reason" rows="3" required></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary">Add Points</button>
                </form>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
    $(document).ready(function() {
        $('#rewardsTable').DataTable({
            order: [[2, 'desc']],
            pageLength: 25,
        });
    });

    function showPointsHistory(customerId) {
        // Implement points history view logic
        $('#pointsHistoryModal').modal('show');
    }

    function addPoints(customerId) {
        const form = document.getElementById('addPointsForm');
        form.action = `/admin/customers/${customerId}/rewards`;
        $('#addPointsModal').modal('show');
    }
</script>
@endpush
