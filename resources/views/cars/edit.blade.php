@extends('layouts.app')

@section("content")
    <div class="container">
        <div  class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        {{ __('Redaguoti automobilį') }}
                    </div>
                    <div class="card-body">
                        @if($errors->any())
                            <div class="alert alert-danger">
                                @foreach($errors->all() as $error)
                                    <div>{{$error}} </div>
                                @endforeach
                            </div>
                        @endif

                        <form method="post" action="{{ route('cars.update', $car) }}" enctype="multipart/form-data">
                            @csrf
                            @method('put')
                            <div class="mb-3">
                                <label class="form-label">{{ __('Valstybiniai numeriai') }}:</label>
                                <input type="text" class="form-control" name="reg_number" value="{{ $car->reg_number }}">
                            </div>
                            <div class="mb-3">
                                <label class="form-label">{{ __('Markė') }}:</label>
                                <input type="text" class="form-control" name="brand" value="{{ $car->brand }}">
                            </div>
                            <div class="mb-3">
                                <label class="form-label">{{ __('Modelis') }}:</label>
                                <input type="text" class="form-control" name="model" value="{{ $car->model }}">
                            </div>
                            <div class="mb-3">
                                <label class="form-label">{{ __('Savininkas') }}:</label>
                                <select name="owner_id" class="form-select">
                                    @foreach($owners as $owner)
                                        <option value="{{ $owner->id }}" @if($owner->id == $car->owner_id) selected @endif >{{ $owner->name }} {{ $owner->surname }}</option>
                                    @endforeach
                                </select>
                            </div>

                            @if ($car->images!=null)
                                <div class="mb-3 alert alert-info">
                                    <h4>{{ __('Nuotraukos') }}</h4>
                                    <div class="row">
                                        @foreach ($car->images as $image)
                                            <div class="col-md-4">
                                                <div class="card mb-4 shadow-sm">
                                                    <img src="{{ route('image.view', $image->id) }}" alt="{{ $image->image_name }}" class="bd-placeholder-img card-img-top" width="100%">
                                                    <div class="card-body">
                                                        <p class="card-text">{{ $image->image_name }}</p>
                                                        <div class="d-flex justify-content-between align-items-center">
                                                            <div class="btn-group">
                                                                <a href="{{  route('image.download', $image->id) }}" class="btn btn-sm btn-outline-secondary">{{ __('Atsisiųsti') }}</a>
                                                                <a href="{{  route('image.delete', $image->id) }}" class="btn btn-sm btn-outline-danger">{{ __('Ištrinti') }}</a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            @endif

                            <div class="mb-3">
                                <label class="form-label">{{ __('Nuotraukos') }}</label>
                                <input type="file" class="form-control" name="image">
                            </div>

                            <button class="btn btn-info">{{ __('Redaguoti') }}</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
