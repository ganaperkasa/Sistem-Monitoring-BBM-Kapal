@extends('layouts.app' )
@section('content')
        <div class="card">
          <div class="card-body">
            <h5 class="card-title fw-semibold mb-4">Sample Page</h5>
            <p class="mb-0">This is a sample page </p>
            <a href="{{ route('operasional.create') }}"class="btn btn-primary mt-3">Button</a>
          </div>
        </div>

@endsection
