@php
$tours = [
    [
        'image' => 'https://picsum.photos/800/500?random=1',
        'title' => 'Mystical Mountain Adventures',
        'region' => 'Swiss Alps',
        'days' => 7,
        'price' => 2499,
        'tags' => ['Adventure', 'Mountains', 'Hiking']
    ],
    [
        'image' => 'https://picsum.photos/800/500?random=2',
        'title' => 'Tropical Paradise Escape',
        'region' => 'Maldives',
        'days' => 5,
        'price' => 3299,
        'tags' => ['Beach', 'Luxury', 'Romance']
    ],
    [
        'image' => 'https://picsum.photos/800/500?random=3',
        'title' => 'Cultural Heritage Journey',
        'region' => 'Kyoto, Japan',
        'days' => 10,
        'price' => 1899,
        'tags' => ['Culture', 'History', 'Temples']
    ],
    [
        'image' => 'https://picsum.photos/800/500?random=4',
        'title' => 'Safari Wildlife Experience',
        'region' => 'Kenya',
        'days' => 8,
        'price' => 2799,
        'tags' => ['Wildlife', 'Safari', 'Adventure']
    ],
    [
        'image' => 'https://picsum.photos/800/500?random=5',
        'title' => 'Northern Lights Quest',
        'region' => 'Iceland',
        'days' => 6,
        'price' => 2199,
        'tags' => ['Aurora', 'Winter', 'Photography']
    ],
    [
        'image' => 'https://picsum.photos/800/500?random=6',
        'title' => 'Mediterranean Coastal Tour',
        'region' => 'Greek Islands',
        'days' => 9,
        'price' => 1999,
        'tags' => ['Coast', 'Islands', 'Relaxation']
    ],
];

$guides = [
    [
        'avatar' => 'https://i.pravatar.cc/150?img=10',
        'name' => 'Maria Rodriguez',
        'city' => 'Barcelona, Spain',
        'languages' => ['Spanish', 'English', 'French'],
        'rating' => 4.9,
        'rate' => 85
    ],
    [
        'avatar' => 'https://i.pravatar.cc/150?img=11',
        'name' => 'Hiroshi Tanaka',
        'city' => 'Tokyo, Japan',
        'languages' => ['Japanese', 'English'],
        'rating' => 4.8,
        'rate' => 95
    ],
    [
        'avatar' => 'https://i.pravatar.cc/150?img=12',
        'name' => 'Ahmed Hassan',
        'city' => 'Cairo, Egypt',
        'languages' => ['Arabic', 'English', 'German'],
        'rating' => 4.7,
        'rate' => 70
    ],
    [
        'avatar' => 'https://i.pravatar.cc/150?img=13',
        'name' => 'Sophie Laurent',
        'city' => 'Paris, France',
        'languages' => ['French', 'English', 'Italian'],
        'rating' => 4.9,
        'rate' => 110
    ],
    [
        'avatar' => 'https://i.pravatar.cc/150?img=14',
        'name' => 'Marco Silva',
        'city' => 'Rio de Janeiro, Brazil',
        'languages' => ['Portuguese', 'English', 'Spanish'],
        'rating' => 4.6,
        'rate' => 65
    ],
    [
        'avatar' => 'https://i.pravatar.cc/150?img=15',
        'name' => 'Anna Kowalski',
        'city' => 'Krakow, Poland',
        'languages' => ['Polish', 'English', 'Russian'],
        'rating' => 4.8,
        'rate' => 55
    ],
];
@endphp

@extends('layouts.app')

@section('content')

<!-- Hero Section -->
<section class="position-relative" style="min-height: 72vh;">
    <div class="position-absolute top-0 start-0 w-100 h-100" style="
        background-image: url('https://images.unsplash.com/photo-1500530855697-b586d89ba3ee?q=80&w=1600&auto=format&fit=crop');
        background-size: cover; background-position: center;"></div>
    <div class="position-absolute top-0 start-0 w-100 h-100" style="background: linear-gradient(180deg, rgba(0,0,0,0.45), rgba(0,0,0,0.35));"></div>

    <div class="container position-relative text-center text-white d-flex flex-column align-items-center justify-content-center" style="min-height:72vh;">
        <h1 class="display-4 fw-bold mb-3">Plan smarter. Travel richer.</h1>
        <p class="lead mb-4" style="max-width: 720px;">Experience the future of travel with AI-powered itineraries and expertly matched chauffeur guides for your perfect journey.</p>
        <div class="d-flex gap-2 mb-4">
            <a href="/tours" class="btn btn-primary btn-lg">Start Planning</a>
            <a href="/guides" class="btn btn-outline-light btn-lg">Find a Guide</a>
        </div>

        <!-- Search Bar -->
        <form method="GET" action="/tours" class="bg-white rounded-3 shadow p-3 w-100" style="max-width: 980px;">
            <div class="row g-2 align-items-end">
                <div class="col-12 col-md-3">
                    <label class="form-label fw-semibold">Destination</label>
                    <input type="text" name="destination" class="form-control" placeholder="Where to?">
                </div>
                <div class="col-6 col-md-3">
                    <label class="form-label fw-semibold">Dates</label>
                    <input type="date" name="dates" class="form-control">
                </div>
                <div class="col-6 col-md-3">
                    <label class="form-label fw-semibold">Travelers</label>
                    <select name="travelers" class="form-select">
                        <option value="">Select</option>
                        <option value="1">1 Person</option>
                        <option value="2">2 People</option>
                        <option value="3-5">3-5 People</option>
                        <option value="6+">6+ People</option>
                    </select>
                </div>
                <div class="col-12 col-md-3">
                    <label class="form-label fw-semibold">Budget</label>
                    <select name="budget" class="form-select">
                        <option value="">Any</option>
                        <option value="budget">$500-1500</option>
                        <option value="mid">$1500-3000</option>
                        <option value="luxury">$3000+</option>
                    </select>
                </div>
                <div class="col-12">
                    <button type="submit" class="btn btn-primary w-100 mt-2">Search Tours</button>
                </div>
            </div>
        </form>
    </div>
</section>

<!-- Featured Tours -->
<section class="py-5 bg-light">
    <div class="container">
        <div class="text-center mb-5">
            <h2 class="fw-bold display-5">Featured Tours</h2>
            <p class="text-muted lead">Discover our most popular destinations and experiences</p>
        </div>
        <div class="row g-4">
            @foreach($tours as $tour)
            <div class="col-12 col-md-6 col-lg-4">
                <div class="card h-100 border-0 shadow-sm hover-shadow">
                    <img src="{{ $tour['image'] }}" class="card-img-top" alt="{{ $tour['title'] }}">
                    <div class="card-body">
                        <div class="d-flex align-items-center text-primary small mb-2">
                            <i class="bi bi-geo-alt-fill me-1"></i> {{ $tour['region'] }}
                        </div>
                        <h5 class="card-title fw-bold">{{ $tour['title'] }}</h5>
                        <div class="mb-2">
                            @foreach($tour['tags'] as $tag)
                                <span class="badge text-bg-light border me-1">{{ $tag }}</span>
                            @endforeach
                        </div>
                        <div class="d-flex align-items-center justify-content-between">
                            <span class="fs-5 fw-bold">${{ number_format($tour['price']) }}</span>
                            <span class="text-muted">per person</span>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>

<!-- Top Guides -->
<section class="py-5">
    <div class="container">
        <div class="text-center mb-5">
            <h2 class="fw-bold display-5">Top Guides</h2>
            <p class="text-muted lead">Connect with expert local guides for authentic experiences</p>
        </div>
        <div class="row g-4">
            @foreach($guides as $guide)
            <div class="col-12 col-md-6 col-lg-4">
                <div class="card h-100 text-center border-0 shadow-sm">
                    <div class="card-body">
                        <img src="{{ $guide['avatar'] }}" alt="{{ $guide['name'] }}" class="rounded-circle mb-3" width="80" height="80">
                        <h5 class="fw-bold mb-1">{{ $guide['name'] }}</h5>
                        <div class="text-muted small mb-2"><i class="bi bi-geo-alt me-1"></i>{{ $guide['city'] }}</div>
                        <div class="mb-2">
                            @foreach($guide['languages'] as $language)
                                <span class="badge bg-primary-subtle text-primary-emphasis border border-primary-subtle me-1">{{ $language }}</span>
                            @endforeach
                        </div>
                        <div class="d-flex align-items-center justify-content-center mb-3">
                            @for($i = 0; $i < 5; $i++)
                                <i class="bi {{ $i < floor($guide['rating']) ? 'bi-star-fill text-warning' : 'bi-star text-muted' }}"></i>
                            @endfor
                            <span class="ms-2 text-muted small">{{ $guide['rating'] }}</span>
                        </div>
                        <div class="fs-5 fw-bold mb-3">${{ $guide['rate'] }}/day</div>
                        <button class="btn btn-primary w-100">Check Availability</button>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>

<!-- How It Works -->
<section class="py-5 bg-light">
    <div class="container">
        <div class="row text-center g-4">
            <div class="col-12">
                <h2 class="fw-bold display-5 mb-3">How It Works</h2>
                <p class="text-muted lead mb-5">Get started in three simple steps</p>
            </div>
            <div class="col-12 col-md-4">
                <div class="p-4 rounded-3 h-100">
                    <div class="bg-primary-subtle text-primary rounded-3 d-inline-flex p-3 mb-3">
                        <i class="bi bi-search fs-4"></i>
                    </div>
                    <h5 class="fw-bold mb-2 fs-4">1. Discover</h5>
                    <p class="text-muted">Browse our AI-curated tours or search for your perfect destination using our smart filters.</p>
                </div>
            </div>
            <div class="col-12 col-md-4">
                <div class="p-4 rounded-3 h-100">
                    <div class="bg-primary-subtle text-primary rounded-3 d-inline-flex p-3 mb-3">
                        <i class="bi bi-people fs-4"></i>
                    </div>
                    <h5 class="fw-bold mb-2 fs-4">2. Connect</h5>
                    <p class="text-muted">Get matched with verified local guides who speak your language and share your interests.</p>
                </div>
            </div>
            <div class="col-12 col-md-4">
                <div class="p-4 rounded-3 h-100">
                    <div class="bg-primary-subtle text-primary rounded-3 d-inline-flex p-3 mb-3">
                        <i class="bi bi-badge-ad fs-4"></i>
                    </div>
                    <h5 class="fw-bold mb-2 fs-4">3. Experience</h5>
                    <p class="text-muted">Enjoy your personalized journey with real-time updates and 24/7 support throughout your trip.</p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Testimonials (Enhanced) -->
<section class="py-5">
    <div class="container">
        <div class="text-center mb-4">
            <h2 class="fw-bold display-6">What travelers say</h2>
            <p class="text-muted">Real reviews from our happy customers</p>
        </div>
        <div id="testimonialsCarousel" class="carousel slide" data-bs-ride="carousel">
            <div class="carousel-indicators">
                <button type="button" data-bs-target="#testimonialsCarousel" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
                <button type="button" data-bs-target="#testimonialsCarousel" data-bs-slide-to="1" aria-label="Slide 2"></button>
                <button type="button" data-bs-target="#testimonialsCarousel" data-bs-slide-to="2" aria-label="Slide 3"></button>
            </div>
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <div class="card border-0 shadow-sm mx-auto" style="max-width: 860px;">
                        <div class="card-body p-4 p-md-5 text-center">
                            <img src="https://i.pravatar.cc/100?img=32" alt="Reviewer avatar" class="rounded-circle mb-3" width="64" height="64">
                            <div class="mb-2 text-warning">
                                <i class="bi bi-star-fill"></i>
                                <i class="bi bi-star-fill"></i>
                                <i class="bi bi-star-fill"></i>
                                <i class="bi bi-star-fill"></i>
                                <i class="bi bi-star-half"></i>
                            </div>
                            <p class="lead mb-3">“THUFAYLONIA helped us plan the most unforgettable trip. The guide was amazing and the itinerary was perfect.”</p>
                            <span class="fw-bold">Alex P.</span>
                            <div class="text-muted small">Family Trip • Switzerland</div>
                        </div>
                    </div>
                </div>
                <div class="carousel-item">
                    <div class="card border-0 shadow-sm mx-auto" style="max-width: 860px;">
                        <div class="card-body p-4 p-md-5 text-center">
                            <img src="https://i.pravatar.cc/100?img=36" alt="Reviewer avatar" class="rounded-circle mb-3" width="64" height="64">
                            <div class="mb-2 text-warning">
                                <i class="bi bi-star-fill"></i>
                                <i class="bi bi-star-fill"></i>
                                <i class="bi bi-star-fill"></i>
                                <i class="bi bi-star-fill"></i>
                                <i class="bi bi-star-fill"></i>
                            </div>
                            <p class="lead mb-3">“Seamless planning with AI and a friendly local guide made all the difference!”</p>
                            <span class="fw-bold">Priya R.</span>
                            <div class="text-muted small">Couples Tour • Japan</div>
                        </div>
                    </div>
                </div>
                <div class="carousel-item">
                    <div class="card border-0 shadow-sm mx-auto" style="max-width: 860px;">
                        <div class="card-body p-4 p-md-5 text-center">
                            <img src="https://i.pravatar.cc/100?img=58" alt="Reviewer avatar" class="rounded-circle mb-3" width="64" height="64">
                            <div class="mb-2 text-warning">
                                <i class="bi bi-star-fill"></i>
                                <i class="bi bi-star-fill"></i>
                                <i class="bi bi-star-fill"></i>
                                <i class="bi bi-star-fill"></i>
                                <i class="bi bi-star"></i>
                            </div>
                            <p class="lead mb-3">“Great value and incredible experiences. Highly recommended for stress-free travel.”</p>
                            <span class="fw-bold">Marco D.</span>
                            <div class="text-muted small">Friends Trip • Iceland</div>
                        </div>
                    </div>
                </div>
            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#testimonialsCarousel" data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#testimonialsCarousel" data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </button>
        </div>
    </div>
    
</section>

<!-- Footer (Enhanced) -->
<footer class="bg-dark text-white pt-5 pb-4 mt-5">
    <div class="container">
        <div class="row g-4 align-items-start">
            <div class="col-12 col-lg-4">
                <h5 class="fw-bold mb-3">THUFAYLONIA</h5>
                <p class="text-secondary small">AI-powered itineraries and premium chauffeur guides. Plan smarter. Travel richer.</p>
                <div class="mt-3 d-flex gap-3 fs-5">
                    <a href="#" class="text-light"><i class="bi bi-twitter-x"></i></a>
                    <a href="#" class="text-light"><i class="bi bi-instagram"></i></a>
                    <a href="#" class="text-light"><i class="bi bi-facebook"></i></a>
                    <a href="#" class="text-light"><i class="bi bi-youtube"></i></a>
                </div>
            </div>
            <div class="col-6 col-lg-2">
                <h6 class="text-uppercase text-secondary small">Product</h6>
                <ul class="list-unstyled small mt-2">
                    <li><a class="link-light text-decoration-none" href="#">Tours</a></li>
                    <li><a class="link-light text-decoration-none" href="#">Guides</a></li>
                    <li><a class="link-light text-decoration-none" href="#">Pricing</a></li>
                </ul>
            </div>
            <div class="col-6 col-lg-2">
                <h6 class="text-uppercase text-secondary small">Company</h6>
                <ul class="list-unstyled small mt-2">
                    <li><a class="link-light text-decoration-none" href="#">About</a></li>
                    <li><a class="link-light text-decoration-none" href="#">Careers</a></li>
                    <li><a class="link-light text-decoration-none" href="#">Contact</a></li>
                </ul>
            </div>
            <div class="col-12 col-lg-4">
                <h6 class="text-uppercase text-secondary small">Subscribe</h6>
                <p class="small text-secondary mb-2">Get travel inspiration and exclusive offers.</p>
                <form class="d-flex gap-2">
                    <input type="email" class="form-control" placeholder="Enter your email">
                    <button type="submit" class="btn btn-primary">Subscribe</button>
                </form>
            </div>
        </div>
        <div class="border-top border-secondary mt-4 pt-3 d-flex flex-column flex-md-row justify-content-between small text-secondary">
            <div>© 2025 THUFAYLONIA. All rights reserved.</div>
            <div class="mt-2 mt-md-0">
                <a href="#" class="link-secondary text-decoration-none me-3">Privacy</a>
                <a href="#" class="link-secondary text-decoration-none">Terms</a>
            </div>
        </div>
    </div>
</footer>

@endsection
