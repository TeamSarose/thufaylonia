@extends('layouts.dashboard')

@section('page-title', 'Edit Profile')

@section('content')
<div class="row mb-4">
    <div class="col-12">
        <h2 class="fw-bold mb-3">Edit Profile</h2>
        <p class="text-muted">Update your personal information and preferences.</p>
    </div>
</div>

<div class="row">
    <!-- Profile Information -->
    <div class="col-lg-8">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title mb-0">
                    <i class="bi bi-person me-2"></i>
                    Personal Information
                </h5>
            </div>
            <div class="card-body">
                <form>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="firstName" class="form-label">First Name</label>
                            <input type="text" class="form-control" id="firstName" value="{{ $user->name ?? 'John' }}">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="lastName" class="form-label">Last Name</label>
                            <input type="text" class="form-control" id="lastName" value="Doe">
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="email" class="form-label">Email Address</label>
                            <input type="email" class="form-control" id="email" value="{{ $user->email ?? 'john.doe@example.com' }}">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="phone" class="form-label">Phone Number</label>
                            <input type="tel" class="form-control" id="phone" value="+1 (555) 123-4567">
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="dateOfBirth" class="form-label">Date of Birth</label>
                            <input type="date" class="form-control" id="dateOfBirth" value="1990-01-15">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="gender" class="form-label">Gender</label>
                            <select class="form-select" id="gender">
                                <option value="male" selected>Male</option>
                                <option value="female">Female</option>
                                <option value="other">Other</option>
                                <option value="prefer-not-to-say">Prefer not to say</option>
                            </select>
                        </div>
                    </div>
                    
                    <div class="mb-3">
                        <label for="address" class="form-label">Address</label>
                        <textarea class="form-control" id="address" rows="3" placeholder="Enter your full address">123 Main Street, New York, NY 10001</textarea>
                    </div>
                    
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="city" class="form-label">City</label>
                            <input type="text" class="form-control" id="city" value="New York">
                        </div>
                        <div class="col-md-3 mb-3">
                            <label for="state" class="form-label">State</label>
                            <input type="text" class="form-control" id="state" value="NY">
                        </div>
                        <div class="col-md-3 mb-3">
                            <label for="zipCode" class="form-label">ZIP Code</label>
                            <input type="text" class="form-control" id="zipCode" value="10001">
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="country" class="form-label">Country</label>
                            <select class="form-select" id="country">
                                <option value="US" selected>United States</option>
                                <option value="CA">Canada</option>
                                <option value="UK">United Kingdom</option>
                                <option value="AU">Australia</option>
                                <option value="DE">Germany</option>
                                <option value="FR">France</option>
                                <option value="JP">Japan</option>
                            </select>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="language" class="form-label">Preferred Language</label>
                            <select class="form-select" id="language">
                                <option value="en" selected>English</option>
                                <option value="es">Spanish</option>
                                <option value="fr">French</option>
                                <option value="de">German</option>
                                <option value="it">Italian</option>
                                <option value="pt">Portuguese</option>
                                <option value="ja">Japanese</option>
                            </select>
                        </div>
                    </div>
                    
                    <div class="d-flex gap-2">
                        <button type="submit" class="btn btn-primary">Save Changes</button>
                        <button type="button" class="btn btn-outline-secondary">Cancel</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    
    <!-- Profile Picture & Preferences -->
    <div class="col-lg-4">
        <!-- Profile Picture -->
        <div class="card mb-4">
            <div class="card-header">
                <h5 class="card-title mb-0">
                    <i class="bi bi-camera me-2"></i>
                    Profile Picture
                </h5>
            </div>
            <div class="card-body text-center">
                <div class="mb-3">
                    <img src="https://i.pravatar.cc/150?img=1" alt="Profile Picture" class="rounded-circle" width="120" height="120">
                </div>
                <div class="d-flex gap-2 justify-content-center">
                    <button class="btn btn-outline-primary btn-sm">
                        <i class="bi bi-camera me-1"></i>
                        Change
                    </button>
                    <button class="btn btn-outline-danger btn-sm">
                        <i class="bi bi-trash me-1"></i>
                        Remove
                    </button>
                </div>
            </div>
        </div>
        
        <!-- Travel Preferences -->
        <div class="card mb-4">
            <div class="card-header">
                <h5 class="card-title mb-0">
                    <i class="bi bi-heart me-2"></i>
                    Travel Preferences
                </h5>
            </div>
            <div class="card-body">
                <div class="mb-3">
                    <label class="form-label">Travel Style</label>
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" id="budget" checked>
                        <label class="form-check-label" for="budget">Budget Travel</label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" id="luxury">
                        <label class="form-check-label" for="luxury">Luxury Travel</label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" id="adventure" checked>
                        <label class="form-check-label" for="adventure">Adventure</label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" id="cultural">
                        <label class="form-check-label" for="cultural">Cultural</label>
                    </div>
                </div>
                
                <div class="mb-3">
                    <label for="groupSize" class="form-label">Preferred Group Size</label>
                    <select class="form-select" id="groupSize">
                        <option value="solo">Solo Travel</option>
                        <option value="couple" selected>Couple</option>
                        <option value="small">Small Group (3-5)</option>
                        <option value="medium">Medium Group (6-10)</option>
                        <option value="large">Large Group (10+)</option>
                    </select>
                </div>
                
                <div class="mb-3">
                    <label for="dietary" class="form-label">Dietary Restrictions</label>
                    <select class="form-select" id="dietary">
                        <option value="none">None</option>
                        <option value="vegetarian">Vegetarian</option>
                        <option value="vegan">Vegan</option>
                        <option value="gluten-free">Gluten-Free</option>
                        <option value="halal">Halal</option>
                        <option value="kosher">Kosher</option>
                    </select>
                </div>
            </div>
        </div>
        
        <!-- Account Settings -->
        <div class="card">
            <div class="card-header">
                <h5 class="card-title mb-0">
                    <i class="bi bi-gear me-2"></i>
                    Account Settings
                </h5>
            </div>
            <div class="card-body">
                <div class="mb-3">
                    <div class="form-check form-switch">
                        <input class="form-check-input" type="checkbox" id="emailNotifications" checked>
                        <label class="form-check-label" for="emailNotifications">Email Notifications</label>
                    </div>
                </div>
                <div class="mb-3">
                    <div class="form-check form-switch">
                        <input class="form-check-input" type="checkbox" id="smsNotifications">
                        <label class="form-check-label" for="smsNotifications">SMS Notifications</label>
                    </div>
                </div>
                <div class="mb-3">
                    <div class="form-check form-switch">
                        <input class="form-check-input" type="checkbox" id="marketingEmails" checked>
                        <label class="form-check-label" for="marketingEmails">Marketing Emails</label>
                    </div>
                </div>
                
                <hr>
                
                <div class="d-grid gap-2">
                    <a href="{{ route('profile.edit') }}" class="btn btn-outline-primary btn-sm">
                        <i class="bi bi-shield-lock me-2"></i>
                        Security Settings
                    </a>
                    <button class="btn btn-outline-danger btn-sm">
                        <i class="bi bi-trash me-2"></i>
                        Delete Account
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
