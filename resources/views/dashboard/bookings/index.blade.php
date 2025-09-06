@extends('layouts.dashboard')

@section('page-title', 'My Bookings')

@section('content')
<div class="row mb-4">
    <div class="col-12">
        <h2 class="fw-bold mb-3">My Bookings</h2>
        <p class="text-muted">Manage and track all your tour bookings.</p>
    </div>
</div>

<div class="row mb-4">
    <div class="col-md-8">
        <div class="d-flex gap-2">
            <button class="btn btn-outline-primary active">All Bookings</button>
            <button class="btn btn-outline-primary">Confirmed</button>
            <button class="btn btn-outline-primary">Pending</button>
            <button class="btn btn-outline-primary">Cancelled</button>
        </div>
    </div>
    <div class="col-md-4 text-end">
        <a href="{{ route('tours') }}" class="btn btn-primary">
            <i class="bi bi-plus me-2"></i>
            Book New Tour
        </a>
    </div>
</div>

<div class="card">
    <div class="card-header">
        <h5 class="card-title mb-0">
            <i class="bi bi-calendar-check me-2"></i>
            Booking History
        </h5>
    </div>
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover mb-0">
                <thead>
                    <tr>
                        <th>Booking ID</th>
                        <th>Tour</th>
                        <th>Destination</th>
                        <th>Travel Dates</th>
                        <th>Status</th>
                        <th>Amount</th>
                        <th>Booked On</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($bookings as $booking)
                    <tr>
                        <td>
                            <span class="fw-semibold text-primary">{{ $booking['id'] }}</span>
                        </td>
                        <td>
                            <div class="fw-semibold">{{ $booking['tour'] }}</div>
                        </td>
                        <td>
                            <div class="text-muted">{{ $booking['destination'] }}</div>
                        </td>
                        <td>
                            <div class="small">
                                {{ \Carbon\Carbon::parse($booking['start_date'])->format('M d') }} - 
                                {{ \Carbon\Carbon::parse($booking['end_date'])->format('M d, Y') }}
                            </div>
                        </td>
                        <td>
                            @if($booking['status'] === 'confirmed')
                                <span class="badge bg-success status-badge">
                                    <i class="bi bi-check-circle me-1"></i>
                                    Confirmed
                                </span>
                            @elseif($booking['status'] === 'pending')
                                <span class="badge bg-warning status-badge">
                                    <i class="bi bi-clock me-1"></i>
                                    Pending
                                </span>
                            @elseif($booking['status'] === 'cancelled')
                                <span class="badge bg-danger status-badge">
                                    <i class="bi bi-x-circle me-1"></i>
                                    Cancelled
                                </span>
                            @else
                                <span class="badge bg-secondary status-badge">{{ ucfirst($booking['status']) }}</span>
                            @endif
                        </td>
                        <td>
                            <div class="fw-semibold">${{ number_format($booking['amount'], 2) }}</div>
                        </td>
                        <td>
                            <div class="text-muted small">{{ \Carbon\Carbon::parse($booking['created_at'])->format('M d, Y') }}</div>
                        </td>
                        <td>
                            <div class="btn-group" role="group">
                                <button type="button" class="btn btn-sm btn-outline-primary" data-bs-toggle="modal" data-bs-target="#bookingModal{{ $loop->index }}">
                                    <i class="bi bi-eye"></i>
                                </button>
                                @if($booking['status'] === 'pending')
                                <button type="button" class="btn btn-sm btn-outline-success">
                                    <i class="bi bi-check"></i>
                                </button>
                                @endif
                                @if($booking['status'] !== 'cancelled')
                                <button type="button" class="btn btn-sm btn-outline-danger">
                                    <i class="bi bi-x"></i>
                                </button>
                                @endif
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Booking Detail Modals -->
@foreach($bookings as $booking)
<div class="modal fade" id="bookingModal{{ $loop->index }}" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Booking Details - {{ $booking['id'] }}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-6">
                        <h6 class="fw-semibold">Tour Information</h6>
                        <p><strong>Tour:</strong> {{ $booking['tour'] }}</p>
                        <p><strong>Destination:</strong> {{ $booking['destination'] }}</p>
                        <p><strong>Start Date:</strong> {{ \Carbon\Carbon::parse($booking['start_date'])->format('M d, Y') }}</p>
                        <p><strong>End Date:</strong> {{ \Carbon\Carbon::parse($booking['end_date'])->format('M d, Y') }}</p>
                    </div>
                    <div class="col-md-6">
                        <h6 class="fw-semibold">Booking Information</h6>
                        <p><strong>Booking ID:</strong> {{ $booking['id'] }}</p>
                        <p><strong>Status:</strong> 
                            @if($booking['status'] === 'confirmed')
                                <span class="badge bg-success">Confirmed</span>
                            @elseif($booking['status'] === 'pending')
                                <span class="badge bg-warning">Pending</span>
                            @else
                                <span class="badge bg-danger">Cancelled</span>
                            @endif
                        </p>
                        <p><strong>Amount:</strong> ${{ number_format($booking['amount'], 2) }}</p>
                        <p><strong>Booked On:</strong> {{ \Carbon\Carbon::parse($booking['created_at'])->format('M d, Y') }}</p>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <a href="{{ route('dashboard.itineraries') }}" class="btn btn-primary">View Itinerary</a>
            </div>
        </div>
    </div>
</div>
@endforeach
@endsection
