@extends('layouts.app')

@section('content')
<div class="container py-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="display-4" style="color: #8B0000;">Company Information</h1>
        <a href="{{ route('twoqalliance.create') }}" class="btn btn-primary">
            <i class="bi bi-plus-circle"></i> Create New Company
        </a>
    </div>

    @if($companies->count())
        <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-4">
            @foreach($companies as $company)
                <div class="col">
                    <div class="card h-100 shadow-sm">
                        @if($company->logo)
                            <div class="card-img-top bg-light d-flex align-items-center justify-content-center" style="height: 150px; overflow: hidden;">
                                <img src="{{ asset('storage/' . $company->logo) }}" alt="{{ $company->name }} logo" class="img-fluid" style="max-height: 100%; object-fit: contain;">
                            </div>
                        @else
                            <div class="card-img-top bg-light d-flex align-items-center justify-content-center" style="height: 150px;">
                                <i class="bi bi-building text-muted" style="font-size: 3rem;"></i>
                            </div>
                        @endif
                        <div class="card-body">
                            <h5 class="card-title">{{ $company->name }}</h5>
                            @if($company->email)
                                <p class="card-text text-muted mb-1">
                                    <i class="bi bi-envelope"></i> {{ $company->email }}
                                </p>
                            @endif
                            @if($company->website)
                                <p class="card-text text-muted">
                                    <i class="bi bi-globe"></i> 
                                    <a href="{{ $company->website }}" target="_blank" class="text-decoration-none">
                                        {{ parse_url($company->website, PHP_URL_HOST) }}
                                    </a>
                                </p>
                            @endif
                        </div>
                        <div class="card-footer bg-white border-top-0">
                            <div class="d-flex justify-content-between">
                                <a href="{{ route('twoqalliance.edit', $company) }}" class="btn btn-sm btn-outline-primary">
                                    <i class="bi bi-pencil"></i> Edit
                                </a>
                                <form action="{{ route('twoqalliance.destroy', $company) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-outline-danger" onclick="return confirm('Delete this company?')">
                                        <i class="bi bi-trash"></i> Delete
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @else
        <div class="alert alert-info text-center py-4">
            <i class="bi bi-info-circle" style="font-size: 2rem;"></i>
            <h4 class="mt-2">No companies found</h4>
            <p class="mb-0">Click the "Create New Company" button to add your first record.</p>
        </div>
    @endif
</div>
@endsection