@extends('layouts.app')

@section("content")
    <div class="container">
        <div  class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        {{ __('Pridėti naują automobilį') }}
                    </div>
                    <div class="card-body">
                        @if($errors->any())
                            <div class="alert alert-danger">
                                @foreach($errors->all() as $error)
                                    <div>{{$error}} </div>
                                @endforeach
                            </div>
                        @endif

                        <form method="post" action="{{ route('cars.store') }}">
                            @csrf
                            <div class="mb-3">
                                <label class="form-label">{{ __('Valstybiniai numeriai') }}:</label>
                                <input type="text" class="form-control" name="reg_number" value="{{old('reg_number')}}">
                            </div>
{{--                                @error('reg_number') {{ $message }} @enderror--}}
                            <div class="mb-3">
                                <label class="form-label">{{ __('Markė') }}:</label>
                                <input type="text" class="form-control" name="brand" value="{{old('brand')}}">
                            </div>
                            <div class="mb-3">
                                <label class="form-label">{{ __('Modelis') }}:</label>
                                <input type="text" class="form-control" name="model" value="{{old('model')}}">
                            </div>
                            <div class="mb-3">
                                <label class="form-label">{{ __('Savininkas') }}:</label>
                                <select name="owner_id" class="form-select">
                                    @foreach($owners as $owner)
                                        <option value="{{ $owner->id }}">{{ $owner->name }} {{ $owner->surname }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <button class="btn btn-success">{{ __('Pridėti') }}</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
