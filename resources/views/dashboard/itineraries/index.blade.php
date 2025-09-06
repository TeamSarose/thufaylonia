@extends('layouts.dashboard')

@section('page-title', 'My Itineraries')

@section('content')
<div class="row mb-4">
    <div class="col-12">
        <h2 class="fw-bold mb-3">My Itineraries</h2>
        <p class="text-muted">View and manage your travel itineraries.</p>
    </div>
</div>

<div class="row mb-4">
    <div class="col-md-8">
        <div class="d-flex gap-2">
            <button class="btn btn-outline-primary active">All Itineraries</button>
            <button class="btn btn-outline-primary">Active</button>
            <button class="btn btn-outline-primary">Draft</button>
            <button class="btn btn-outline-primary">Completed</button>
        </div>
    </div>
    <div class="col-md-4 text-end">
        <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#createItineraryModal">
            <i class="bi bi-plus me-2"></i>
            Create Itinerary
        </button>
    </div>
</div>

<div class="row">
    @foreach($itineraries as $itinerary)
    <div class="col-lg-4 col-md-6 mb-4">
        <div class="card h-100">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h6 class="card-title mb-0">{{ $itinerary['title'] }}</h6>
                <div class="dropdown">
                    <button class="btn btn-sm btn-outline-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown">
                        <i class="bi bi-three-dots"></i>
                    </button>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="#"><i class="bi bi-eye me-2"></i>View</a></li>
                        <li><a class="dropdown-item" href="#"><i class="bi bi-pencil me-2"></i>Edit</a></li>
                        <li><a class="dropdown-item" href="#"><i class="bi bi-share me-2"></i>Share</a></li>
                        <li><hr class="dropdown-divider"></li>
                        <li><a class="dropdown-item text-danger" href="#"><i class="bi bi-trash me-2"></i>Delete</a></li>
                    </ul>
                </div>
            </div>
            <div class="card-body">
                <div class="mb-3">
                    <div class="d-flex align-items-center mb-2">
                        <i class="bi bi-geo-alt text-primary me-2"></i>
                        <span class="fw-semibold">{{ $itinerary['destination'] }}</span>
                    </div>
                    <div class="d-flex align-items-center mb-2">
                        <i class="bi bi-calendar text-primary me-2"></i>
                        <span>{{ $itinerary['duration'] }}</span>
                    </div>
                    <div class="d-flex align-items-center">
                        <i class="bi bi-clock text-primary me-2"></i>
                        <span class="text-muted small">Updated {{ \Carbon\Carbon::parse($itinerary['last_updated'])->diffForHumans() }}</span>
                    </div>
                </div>
                
                <div class="mb-3">
                    @if($itinerary['status'] === 'active')
                        <span class="badge bg-success status-badge">
                            <i class="bi bi-play-circle me-1"></i>
                            Active
                        </span>
                    @elseif($itinerary['status'] === 'draft')
                        <span class="badge bg-warning status-badge">
                            <i class="bi bi-pencil me-1"></i>
                            Draft
                        </span>
                    @elseif($itinerary['status'] === 'completed')
                        <span class="badge bg-info status-badge">
                            <i class="bi bi-check-circle me-1"></i>
                            Completed
                        </span>
                    @endif
                </div>
                
                <div class="progress mb-3" style="height: 6px;">
                    @if($itinerary['status'] === 'completed')
                        <div class="progress-bar bg-success" style="width: 100%"></div>
                    @elseif($itinerary['status'] === 'active')
                        <div class="progress-bar bg-primary" style="width: 75%"></div>
                    @else
                        <div class="progress-bar bg-warning" style="width: 30%"></div>
                    @endif
                </div>
            </div>
            <div class="card-footer bg-transparent">
                <div class="d-flex gap-2">
                    <button class="btn btn-primary btn-sm flex-fill" data-bs-toggle="modal" data-bs-target="#itineraryModal{{ $loop->index }}">
                        <i class="bi bi-eye me-1"></i>
                        View Details
                    </button>
                    <button class="btn btn-outline-primary btn-sm">
                        <i class="bi bi-pencil"></i>
                    </button>
                </div>
            </div>
        </div>
    </div>
    @endforeach
</div>

<!-- Create Itinerary Modal -->
<div class="modal fade" id="createItineraryModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Create New Itinerary</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <form>
                    <div class="mb-3">
                        <label for="itineraryTitle" class="form-label">Itinerary Title</label>
                        <input type="text" class="form-control" id="itineraryTitle" placeholder="e.g., European Adventure">
                    </div>
                    <div class="mb-3">
                        <label for="destination" class="form-label">Destination</label>
                        <input type="text" class="form-control" id="destination" placeholder="e.g., Paris, France">
                    </div>
                    <div class="mb-3">
                        <label for="duration" class="form-label">Duration</label>
                        <select class="form-select" id="duration">
                            <option value="3 days">3 days</option>
                            <option value="5 days">5 days</option>
                            <option value="7 days">7 days</option>
                            <option value="10 days">10 days</option>
                            <option value="14 days">14 days</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="description" class="form-label">Description</label>
                        <textarea class="form-control" id="description" rows="3" placeholder="Describe your travel plans..."></textarea>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-primary">Create Itinerary</button>
            </div>
        </div>
    </div>
</div>

<!-- Itinerary Detail Modals -->
@foreach($itineraries as $itinerary)
<div class="modal fade" id="itineraryModal{{ $loop->index }}" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">{{ $itinerary['title'] }}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <div class="row mb-4">
                    <div class="col-md-6">
                        <h6 class="fw-semibold">Itinerary Details</h6>
                        <p><strong>Destination:</strong> {{ $itinerary['destination'] }}</p>
                        <p><strong>Duration:</strong> {{ $itinerary['duration'] }}</p>
                        <p><strong>Status:</strong> 
                            @if($itinerary['status'] === 'active')
                                <span class="badge bg-success">Active</span>
                            @elseif($itinerary['status'] === 'draft')
                                <span class="badge bg-warning">Draft</span>
                            @else
                                <span class="badge bg-info">Completed</span>
                            @endif
                        </p>
                    </div>
                    <div class="col-md-6">
                        <h6 class="fw-semibold">Timeline</h6>
                        <p><strong>Created:</strong> {{ \Carbon\Carbon::parse($itinerary['created_at'])->format('M d, Y') }}</p>
                        <p><strong>Last Updated:</strong> {{ \Carbon\Carbon::parse($itinerary['last_updated'])->format('M d, Y') }}</p>
                    </div>
                </div>
                
                <div class="mb-4">
                    <h6 class="fw-semibold">Day-by-Day Plan</h6>
                    <div class="timeline">
                        <div class="timeline-item">
                            <div class="timeline-marker bg-primary"></div>
                            <div class="timeline-content">
                                <h6>Day 1: Arrival</h6>
                                <p class="text-muted small">Check into hotel and explore the local area.</p>
                            </div>
                        </div>
                        <div class="timeline-item">
                            <div class="timeline-marker bg-primary"></div>
                            <div class="timeline-content">
                                <h6>Day 2: City Tour</h6>
                                <p class="text-muted small">Guided tour of main attractions and landmarks.</p>
                            </div>
                        </div>
                        <div class="timeline-item">
                            <div class="timeline-marker bg-secondary"></div>
                            <div class="timeline-content">
                                <h6>Day 3: Free Day</h6>
                                <p class="text-muted small">Free time to explore on your own.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Edit Itinerary</button>
            </div>
        </div>
    </div>
</div>
@endforeach

<style>
.timeline {
    position: relative;
    padding-left: 30px;
}

.timeline::before {
    content: '';
    position: absolute;
    left: 15px;
    top: 0;
    bottom: 0;
    width: 2px;
    background: #dee2e6;
}

.timeline-item {
    position: relative;
    margin-bottom: 20px;
}

.timeline-marker {
    position: absolute;
    left: -22px;
    top: 5px;
    width: 12px;
    height: 12px;
    border-radius: 50%;
    border: 2px solid white;
    box-shadow: 0 0 0 2px #dee2e6;
}

.timeline-content h6 {
    margin-bottom: 5px;
    font-weight: 600;
}
</style>
@endsection
