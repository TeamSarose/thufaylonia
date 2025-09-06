@extends('layouts.dashboard')

@section('page-title', 'Messages')

@section('content')
<div class="row mb-4">
    <div class="col-12">
        <h2 class="fw-bold mb-3">Messages</h2>
        <p class="text-muted">Communicate with your guides and support team.</p>
    </div>
</div>

<div class="row">
    <!-- Messages List -->
    <div class="col-lg-4">
        <div class="card">
            <div class="card-header">
                <div class="d-flex justify-content-between align-items-center">
                    <h5 class="card-title mb-0">Conversations</h5>
                    <button class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#newMessageModal">
                        <i class="bi bi-plus"></i>
                    </button>
                </div>
            </div>
            <div class="card-body p-0">
                <div class="list-group list-group-flush">
                    @foreach($messages as $message)
                    <a href="#" class="list-group-item list-group-item-action {{ !$message['is_read'] ? 'bg-light' : '' }}" 
                       data-bs-toggle="modal" data-bs-target="#messageModal{{ $loop->index }}">
                        <div class="d-flex align-items-start">
                            <div class="flex-shrink-0">
                                <div class="bg-primary-subtle rounded-circle d-flex align-items-center justify-content-center" style="width: 40px; height: 40px;">
                                    <i class="bi bi-person text-primary"></i>
                                </div>
                            </div>
                            <div class="flex-grow-1 ms-3">
                                <div class="d-flex justify-content-between align-items-start">
                                    <h6 class="mb-1 {{ !$message['is_read'] ? 'fw-bold' : '' }}">{{ $message['from'] }}</h6>
                                    <small class="text-muted">{{ \Carbon\Carbon::parse($message['created_at'])->format('M d') }}</small>
                                </div>
                                <p class="mb-1 {{ !$message['is_read'] ? 'fw-semibold' : '' }}">{{ $message['subject'] }}</p>
                                <p class="mb-0 text-muted small">{{ Str::limit($message['message'], 50) }}</p>
                                @if(!$message['is_read'])
                                <span class="badge bg-primary rounded-pill mt-1">New</span>
                                @endif
                            </div>
                        </div>
                    </a>
                    @endforeach
                </div>
            </div>
        </div>
    </div>

    <!-- Message Content -->
    <div class="col-lg-8">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title mb-0">Select a conversation to view messages</h5>
            </div>
            <div class="card-body text-center py-5">
                <i class="bi bi-chat-dots text-muted" style="font-size: 3rem;"></i>
                <h5 class="text-muted mt-3">No conversation selected</h5>
                <p class="text-muted">Choose a conversation from the list to view messages.</p>
            </div>
        </div>
    </div>
</div>

<!-- New Message Modal -->
<div class="modal fade" id="newMessageModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">New Message</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <form>
                    <div class="mb-3">
                        <label for="recipient" class="form-label">To</label>
                        <select class="form-select" id="recipient">
                            <option value="">Select recipient</option>
                            <option value="support">THUFAYLONIA Support</option>
                            <option value="maria">Maria Rodriguez (Guide)</option>
                            <option value="hiroshi">Hiroshi Tanaka (Guide)</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="subject" class="form-label">Subject</label>
                        <input type="text" class="form-control" id="subject" placeholder="Enter message subject">
                    </div>
                    <div class="mb-3">
                        <label for="message" class="form-label">Message</label>
                        <textarea class="form-control" id="message" rows="5" placeholder="Type your message here..."></textarea>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-primary">Send Message</button>
            </div>
        </div>
    </div>
</div>

<!-- Message Detail Modals -->
@foreach($messages as $message)
<div class="modal fade" id="messageModal{{ $loop->index }}" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <div class="d-flex align-items-center">
                    <div class="bg-primary-subtle rounded-circle d-flex align-items-center justify-content-center me-3" style="width: 40px; height: 40px;">
                        <i class="bi bi-person text-primary"></i>
                    </div>
                    <div>
                        <h5 class="modal-title mb-0">{{ $message['from'] }}</h5>
                        <small class="text-muted">{{ $message['subject'] }}</small>
                    </div>
                </div>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <div class="mb-3">
                    <div class="d-flex justify-content-between align-items-center mb-2">
                        <span class="text-muted small">{{ \Carbon\Carbon::parse($message['created_at'])->format('M d, Y \a\t g:i A') }}</span>
                        @if(!$message['is_read'])
                        <span class="badge bg-primary">Unread</span>
                        @endif
                    </div>
                    <div class="bg-light p-3 rounded">
                        <p class="mb-0">{{ $message['message'] }}</p>
                    </div>
                </div>
                
                <!-- Reply Section -->
                <div class="border-top pt-3">
                    <h6 class="fw-semibold mb-3">Reply</h6>
                    <form>
                        <div class="mb-3">
                            <textarea class="form-control" rows="4" placeholder="Type your reply..."></textarea>
                        </div>
                        <div class="d-flex gap-2">
                            <button type="button" class="btn btn-primary">Send Reply</button>
                            <button type="button" class="btn btn-outline-secondary">Mark as Read</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endforeach

<!-- Quick Actions -->
<div class="row mt-4">
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
                        <button class="btn btn-outline-primary w-100 h-100 d-flex flex-column align-items-center justify-content-center py-3" 
                                data-bs-toggle="modal" data-bs-target="#newMessageModal">
                            <i class="bi bi-plus-circle fs-4 mb-2"></i>
                            <span>New Message</span>
                        </button>
                    </div>
                    <div class="col-md-3">
                        <a href="#" class="btn btn-outline-primary w-100 h-100 d-flex flex-column align-items-center justify-content-center py-3">
                            <i class="bi bi-headset fs-4 mb-2"></i>
                            <span>Contact Support</span>
                        </a>
                    </div>
                    <div class="col-md-3">
                        <a href="#" class="btn btn-outline-primary w-100 h-100 d-flex flex-column align-items-center justify-content-center py-3">
                            <i class="bi bi-people fs-4 mb-2"></i>
                            <span>My Guides</span>
                        </a>
                    </div>
                    <div class="col-md-3">
                        <a href="#" class="btn btn-outline-primary w-100 h-100 d-flex flex-column align-items-center justify-content-center py-3">
                            <i class="bi bi-gear fs-4 mb-2"></i>
                            <span>Message Settings</span>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
