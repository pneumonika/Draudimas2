@extends('layouts.app')

@section("content")
    <div class="container">
        <div  class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        {{ __('Redaguoti automobilio savininką') }}
                    </div>
                    <div class="card-body">
                        @if($errors->any())
                            <div class="alert alert-danger">
                                @foreach($errors->all() as $error)
                                    <div>{{$error}} </div>
                                @endforeach
                            </div>
                        @endif

                        <form method="post" action="{{ route('owner.save', $owner->id) }}">
                            @csrf
                            <div class="mb-3">
                                <label class="form-label">{{ __('Vardas') }}:</label>
                                <input type="text" class="form-control" name="name" value="{{ $owner->name }}">
                            </div>
                            <div class="mb-3">
                                <label class="form-label">{{ __('Pavardė') }}:</label>
                                <input type="text" class="form-control" name="surname" value="{{ $owner->surname }}">
                            </div>
                            <div class="mb-3">
                                <label class="form-label">{{ __('Telefonas') }}:</label>
                                <input type="text" class="form-control" name="phone" value="{{ $owner->phone }}">
                            </div>
                            <div class="mb-3">
                                <label class="form-label">{{ __('El. paštas') }}:</label>
                                <input type="text" class="form-control" name="email" value="{{ $owner->email }}">
                            </div>
                            <div class="mb-3">
                                <label class="form-label">{{ __('Adresas') }}:</label>
                                <input type="text" class="form-control" name="address" value="{{ $owner->address }}">
                            </div>
                            <button class="btn btn-info">{{ __('Redaguoti') }}</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
