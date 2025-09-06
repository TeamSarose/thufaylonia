@extends('layouts.dashboard')

@section('page-title', 'Payment History')

@section('content')
<div class="row mb-4">
    <div class="col-12">
        <h2 class="fw-bold mb-3">Payment History</h2>
        <p class="text-muted">Track all your payments and transactions.</p>
    </div>
</div>

<!-- Payment Summary Cards -->
<div class="row mb-4">
    <div class="col-md-3 mb-3">
        <div class="card bg-success text-white">
            <div class="card-body text-center">
                <i class="bi bi-check-circle fs-2 mb-2"></i>
                <div class="fs-4 fw-bold">${{ number_format(collect($payments)->where('status', 'completed')->where('amount', '>', 0)->sum('amount'), 2) }}</div>
                <div class="small">Total Paid</div>
            </div>
        </div>
    </div>
    <div class="col-md-3 mb-3">
        <div class="card bg-warning text-white">
            <div class="card-body text-center">
                <i class="bi bi-clock fs-2 mb-2"></i>
                <div class="fs-4 fw-bold">${{ number_format(collect($payments)->where('status', 'pending')->sum('amount'), 2) }}</div>
                <div class="small">Pending</div>
            </div>
        </div>
    </div>
    <div class="col-md-3 mb-3">
        <div class="card bg-info text-white">
            <div class="card-body text-center">
                <i class="bi bi-arrow-return-left fs-2 mb-2"></i>
                <div class="fs-4 fw-bold">${{ number_format(abs(collect($payments)->where('amount', '<', 0)->sum('amount')), 2) }}</div>
                <div class="small">Refunded</div>
            </div>
        </div>
    </div>
    <div class="col-md-3 mb-3">
        <div class="card bg-primary text-white">
            <div class="card-body text-center">
                <i class="bi bi-receipt fs-2 mb-2"></i>
                <div class="fs-4 fw-bold">{{ count($payments) }}</div>
                <div class="small">Total Transactions</div>
            </div>
        </div>
    </div>
</div>

<div class="row mb-4">
    <div class="col-md-8">
        <div class="d-flex gap-2">
            <button class="btn btn-outline-primary active">All Payments</button>
            <button class="btn btn-outline-primary">Completed</button>
            <button class="btn btn-outline-primary">Pending</button>
            <button class="btn btn-outline-primary">Refunds</button>
        </div>
    </div>
    <div class="col-md-4 text-end">
        <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#downloadInvoiceModal">
            <i class="bi bi-download me-2"></i>
            Download Invoices
        </button>
    </div>
</div>

<div class="card">
    <div class="card-header">
        <h5 class="card-title mb-0">
            <i class="bi bi-credit-card me-2"></i>
            Transaction History
        </h5>
    </div>
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover mb-0">
                <thead>
                    <tr>
                        <th>Transaction ID</th>
                        <th>Description</th>
                        <th>Amount</th>
                        <th>Status</th>
                        <th>Payment Method</th>
                        <th>Date</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($payments as $payment)
                    <tr>
                        <td>
                            <span class="fw-semibold text-primary">{{ $payment['id'] }}</span>
                        </td>
                        <td>
                            <div class="fw-semibold">{{ $payment['description'] }}</div>
                        </td>
                        <td>
                            <div class="fw-semibold {{ $payment['amount'] < 0 ? 'text-danger' : 'text-success' }}">
                                {{ $payment['amount'] < 0 ? '-' : '' }}${{ number_format(abs($payment['amount']), 2) }}
                            </div>
                        </td>
                        <td>
                            @if($payment['status'] === 'completed')
                                <span class="badge bg-success status-badge">
                                    <i class="bi bi-check-circle me-1"></i>
                                    Completed
                                </span>
                            @elseif($payment['status'] === 'pending')
                                <span class="badge bg-warning status-badge">
                                    <i class="bi bi-clock me-1"></i>
                                    Pending
                                </span>
                            @elseif($payment['status'] === 'failed')
                                <span class="badge bg-danger status-badge">
                                    <i class="bi bi-x-circle me-1"></i>
                                    Failed
                                </span>
                            @else
                                <span class="badge bg-secondary status-badge">{{ ucfirst($payment['status']) }}</span>
                            @endif
                        </td>
                        <td>
                            <div class="d-flex align-items-center">
                                @if($payment['method'] === 'Credit Card')
                                    <i class="bi bi-credit-card text-primary me-2"></i>
                                @elseif($payment['method'] === 'PayPal')
                                    <i class="bi bi-paypal text-primary me-2"></i>
                                @else
                                    <i class="bi bi-bank text-primary me-2"></i>
                                @endif
                                <span>{{ $payment['method'] }}</span>
                            </div>
                        </td>
                        <td>
                            <div class="text-muted">{{ \Carbon\Carbon::parse($payment['date'])->format('M d, Y') }}</div>
                        </td>
                        <td>
                            <div class="btn-group" role="group">
                                <button type="button" class="btn btn-sm btn-outline-primary" data-bs-toggle="modal" data-bs-target="#paymentModal{{ $loop->index }}">
                                    <i class="bi bi-eye"></i>
                                </button>
                                <button type="button" class="btn btn-sm btn-outline-secondary">
                                    <i class="bi bi-download"></i>
                                </button>
                                @if($payment['status'] === 'pending')
                                <button type="button" class="btn btn-sm btn-outline-success">
                                    <i class="bi bi-arrow-repeat"></i>
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

<!-- Payment Detail Modals -->
@foreach($payments as $payment)
<div class="modal fade" id="paymentModal{{ $loop->index }}" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Payment Details - {{ $payment['id'] }}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-6">
                        <h6 class="fw-semibold">Transaction Information</h6>
                        <p><strong>Transaction ID:</strong> {{ $payment['id'] }}</p>
                        <p><strong>Description:</strong> {{ $payment['description'] }}</p>
                        <p><strong>Amount:</strong> 
                            <span class="fw-bold {{ $payment['amount'] < 0 ? 'text-danger' : 'text-success' }}">
                                {{ $payment['amount'] < 0 ? '-' : '' }}${{ number_format(abs($payment['amount']), 2) }}
                            </span>
                        </p>
                        <p><strong>Status:</strong> 
                            @if($payment['status'] === 'completed')
                                <span class="badge bg-success">Completed</span>
                            @elseif($payment['status'] === 'pending')
                                <span class="badge bg-warning">Pending</span>
                            @else
                                <span class="badge bg-danger">Failed</span>
                            @endif
                        </p>
                    </div>
                    <div class="col-md-6">
                        <h6 class="fw-semibold">Payment Details</h6>
                        <p><strong>Payment Method:</strong> {{ $payment['method'] }}</p>
                        <p><strong>Date:</strong> {{ \Carbon\Carbon::parse($payment['date'])->format('M d, Y \a\t g:i A') }}</p>
                        <p><strong>Reference:</strong> REF-{{ strtoupper(substr($payment['id'], -8)) }}</p>
                    </div>
                </div>
                
                @if($payment['status'] === 'pending')
                <div class="alert alert-warning mt-3">
                    <i class="bi bi-exclamation-triangle me-2"></i>
                    This payment is still pending. Please complete the payment process or contact support if you need assistance.
                </div>
                @endif
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-outline-primary">
                    <i class="bi bi-download me-2"></i>
                    Download Receipt
                </button>
                @if($payment['status'] === 'pending')
                <button type="button" class="btn btn-primary">
                    <i class="bi bi-arrow-repeat me-2"></i>
                    Retry Payment
                </button>
                @endif
            </div>
        </div>
    </div>
</div>
@endforeach

<!-- Download Invoice Modal -->
<div class="modal fade" id="downloadInvoiceModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Download Invoices</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <div class="mb-3">
                    <label for="dateRange" class="form-label">Date Range</label>
                    <select class="form-select" id="dateRange">
                        <option value="all">All Time</option>
                        <option value="last30">Last 30 Days</option>
                        <option value="last90">Last 90 Days</option>
                        <option value="thisyear">This Year</option>
                    </select>
                </div>
                <div class="mb-3">
                    <label for="format" class="form-label">Format</label>
                    <select class="form-select" id="format">
                        <option value="pdf">PDF</option>
                        <option value="excel">Excel</option>
                        <option value="csv">CSV</option>
                    </select>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" id="includeRefunds">
                    <label class="form-check-label" for="includeRefunds">
                        Include refunds
                    </label>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-primary">
                    <i class="bi bi-download me-2"></i>
                    Download
                </button>
            </div>
        </div>
    </div>
</div>
@endsection
