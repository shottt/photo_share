@extends('layouts.app')

@section('content')
    <div class="container">
      <h2>{{__('Photo detail') }}</h2>
      <div class="row">
          <div class="col-sm-6">
            <div class="card">
              <div class="card-body">
                <h3 class="card-title">{{ $photo->title }}</h3>
                <div class="card-img">
                  <img src="{{ asset('storage/' . $photo->photo )}}" alt="">
                </div>
                @if ($comments)
                @foreach ($comments as $comment)
                        
                @endforeach
                    
                @endif
                <form action="">
                  @csrf
                  <input  class="btn btn-primary">{{ __('comment') }}
                </form>
              </div>
            </div>
          </div>
      </div>
    </div>
    
@endsection