@extends('layouts.dashboard')

@section('page-title', 'Dashboard Overview')

@section('content')
<div class="row mb-4">
    <div class="col-12">
        <h2 class="fw-bold mb-3">Welcome back, {{ Auth::user()->name ?? 'User' }}!</h2>
        <p class="text-muted">Here's what's happening with your travel plans.</p>
    </div>
</div>

<!-- KPI Cards -->
<div class="row mb-4">
    <div class="col-md-3 mb-3">
        <div class="card kpi-card">
            <div class="card-body text-center">
                <div class="kpi-number">{{ $kpis['total_bookings'] }}</div>
                <div class="kpi-label">Total Bookings</div>
            </div>
        </div>
    </div>
    <div class="col-md-3 mb-3">
        <div class="card kpi-card">
            <div class="card-body text-center">
                <div class="kpi-number">${{ number_format($kpis['balance_due'], 2) }}</div>
                <div class="kpi-label">Balance Due</div>
            </div>
        </div>
    </div>
    <div class="col-md-3 mb-3">
        <div class="card kpi-card">
            <div class="card-body text-center">
                <div class="kpi-number">{{ $kpis['upcoming_trips'] }}</div>
                <div class="kpi-label">Upcoming Trips</div>
            </div>
        </div>
    </div>
    <div class="col-md-3 mb-3">
        <div class="card kpi-card">
            <div class="card-body text-center">
                <div class="kpi-number">${{ number_format($kpis['total_spent'], 2) }}</div>
                <div class="kpi-label">Total Spent</div>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <!-- Recent Bookings -->
    <div class="col-lg-8 mb-4">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title mb-0">
                    <i class="bi bi-calendar-check me-2"></i>
                    Recent Bookings
                </h5>
            </div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover mb-0">
                        <thead>
                            <tr>
                                <th>Booking ID</th>
                                <th>Tour</th>
                                <th>Date</th>
                                <th>Status</th>
                                <th>Amount</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($recent_bookings as $booking)
                            <tr>
                                <td>
                                    <span class="fw-semibold">{{ $booking['id'] }}</span>
                                </td>
                                <td>
                                    <div class="fw-semibold">{{ $booking['tour'] }}</div>
                                </td>
                                <td>{{ \Carbon\Carbon::parse($booking['date'])->format('M d, Y') }}</td>
                                <td>
                                    @if($booking['status'] === 'confirmed')
                                        <span class="badge bg-success status-badge">Confirmed</span>
                                    @elseif($booking['status'] === 'pending')
                                        <span class="badge bg-warning status-badge">Pending</span>
                                    @else
                                        <span class="badge bg-secondary status-badge">{{ ucfirst($booking['status']) }}</span>
                                    @endif
                                </td>
                                <td class="fw-semibold">${{ number_format($booking['amount'], 2) }}</td>
                                <td>
                                    <a href="{{ route('dashboard.bookings') }}" class="btn btn-sm btn-outline-primary">View</a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="card-footer bg-transparent">
                <a href="{{ route('dashboard.bookings') }}" class="btn btn-primary">View All Bookings</a>
            </div>
        </div>
    </div>

    <!-- Upcoming Trips -->
    <div class="col-lg-4 mb-4">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title mb-0">
                    <i class="bi bi-airplane me-2"></i>
                    Upcoming Trips
                </h5>
            </div>
            <div class="card-body">
                @foreach($upcoming_trips as $trip)
                <div class="d-flex align-items-center mb-3 pb-3 {{ !$loop->last ? 'border-bottom' : '' }}">
                    <div class="flex-shrink-0">
                        <div class="bg-primary-subtle rounded-circle d-flex align-items-center justify-content-center" style="width: 40px; height: 40px;">
                            <i class="bi bi-geo-alt text-primary"></i>
                        </div>
                    </div>
                    <div class="flex-grow-1 ms-3">
                        <div class="fw-semibold">{{ $trip['tour'] }}</div>
                        <div class="text-muted small">{{ $trip['destination'] }}</div>
                        <div class="text-muted small">
                            {{ \Carbon\Carbon::parse($trip['start_date'])->format('M d') }} - 
                            {{ \Carbon\Carbon::parse($trip['end_date'])->format('M d, Y') }}
                        </div>
                    </div>
                    <div class="flex-shrink-0">
                        @if($trip['status'] === 'confirmed')
                            <span class="badge bg-success status-badge">Confirmed</span>
                        @else
                            <span class="badge bg-warning status-badge">Pending</span>
                        @endif
                    </div>
                </div>
                @endforeach
            </div>
            <div class="card-footer bg-transparent">
                <a href="{{ route('dashboard.itineraries') }}" class="btn btn-outline-primary btn-sm">View All Trips</a>
            </div>
        </div>
    </div>
</div>

<!-- Quick Actions -->
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title mb-0">
                    <i class="bi bi-lightning me-2"></i>
                    Quick Actions
                </h5>
            </div>
            <div class="card-body">
                <div class="row g-3">
                    <div class="col-md-3">
                        <a href="{{ route('tours') }}" class="btn btn-outline-primary w-100 h-100 d-flex flex-column align-items-center justify-content-center py-3">
                            <i class="bi bi-search fs-4 mb-2"></i>
                            <span>Browse Tours</span>
                        </a>
                    </div>
                    <div class="col-md-3">
                        <a href="{{ route('guides') }}" class="btn btn-outline-primary w-100 h-100 d-flex flex-column align-items-center justify-content-center py-3">
                            <i class="bi bi-people fs-4 mb-2"></i>
                            <span>Find Guides</span>
                        </a>
                    </div>
                    <div class="col-md-3">
                        <a href="{{ route('dashboard.messages') }}" class="btn btn-outline-primary w-100 h-100 d-flex flex-column align-items-center justify-content-center py-3">
                            <i class="bi bi-chat-dots fs-4 mb-2"></i>
                            <span>Messages</span>
                        </a>
                    </div>
                    <div class="col-md-3">
                        <a href="{{ route('dashboard.profile') }}" class="btn btn-outline-primary w-100 h-100 d-flex flex-column align-items-center justify-content-center py-3">
                            <i class="bi bi-person fs-4 mb-2"></i>
                            <span>Edit Profile</span>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
