@extends('layouts.app')

@section('content')
    <div class="container">
      <h2>{{__('Photo List') }}</h2>
      <div class="row">
        @foreach ($photos as $photo)
          <div class="col-sm-6">
            <div class="card">
              <div class="card-body">
                <h3 class="card-title">{{ $photo->title }}</h3>
                <div class="card-img">
                  <img src="{{ asset('storage/' . $photo->photo )}}" alt="">
                </div>
                <a href="#" class="btn btn-primary">{{ __('detail') }}</a>
              </div>
            </div>
          </div>
            
        @endforeach
      </div>
    </div>
    
@endsection