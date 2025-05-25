@extends('layouts.app')

@section('content')
<div class="container py-4">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow-sm">
                <div class="card-header bg-primary text-white">
                    <h4 class="mb-0">Edit Company: {{ $twoqalliance->name }}</h4>
                </div>
                <div class="card-body">
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <h5 class="alert-heading">Please fix the following errors</h5>
                            <ul class="mb-0">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form action="{{ route('twoqalliance.update', $twoqalliance) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div class="mb-3">
                            <label for="name" class="form-label">Company Name <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="name" name="name" value="{{ old('name', $twoqalliance->name) }}" required>
                        </div>

                        <div class="mb-3">
                            <label for="email" class="form-label">Email Address</label>
                            <input type="email" class="form-control" id="email" name="email" value="{{ old('email', $twoqalliance->email) }}">
                        </div>

                        <div class="mb-3">
                            <label for="website" class="form-label">Website URL</label>
                            <input type="url" class="form-control" id="website" name="website" value="{{ old('website', $twoqalliance->website) }}" placeholder="https://example.com">
                        </div>

                        <div class="mb-4">
                            <label class="form-label">Current Logo</label>
                            <div class="mb-2">
                                @if ($twoqalliance->logo)
                                    <img src="{{ asset('storage/' . $twoqalliance->logo) }}" alt="{{ $twoqalliance->name }} logo" class="img-thumbnail" style="max-height: 100px;">
                                @else
                                    <span class="text-muted">No logo uploaded</span>
                                @endif
                            </div>
                            
                            <label for="logo" class="form-label">Update Logo</label>
                            <input type="file" class="form-control" id="logo" name="logo" accept="image/*">
                            <div class="form-text">Minimum 100×100 pixels, will be resized to square aspect ratio</div>
                        </div>

                        <div class="d-flex justify-content-between align-items-center">
                            <a href="{{ route('twoqalliance.index') }}" class="btn btn-outline-secondary">
                                <i class="bi bi-arrow-left"></i> Back to list
                            </a>
                            <button type="submit" class="btn btn-primary">
                                <i class="bi bi-check-circle"></i> Update Company
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection