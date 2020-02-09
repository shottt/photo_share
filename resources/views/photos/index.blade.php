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
                <a href="{{ route('photos.show', $photo->id) }}" class="btn btn-primary">{{ __('Go Detail') }}</a>
                <a href="{{ route('photos.edit', $photo->id) }}" class="btn btn-warning">{{ __('Go Edit') }}</a>
              <form action="{{ route('photos.delete', $photo->id) }}" method="POST" class="d-inline">
                @csrf
                <button class="btn btn-danger" onclick='return confirm("削除しますか？");'>{{ __('Go Delete') }}</button>
              </form>

              </div>
            </div>
          </div>
            
        @endforeach
      </div>
    </div>
    
@endsection