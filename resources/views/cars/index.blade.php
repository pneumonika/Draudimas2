@extends('layouts.app')

@section("content")
    <div class="container">
        <div  class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        {{ __('Automobiliai') }}
                        @can('create', App\Models\Car::class)
                        <a class="btn btn-primary" href="{{ route('cars.create') }}">{{ __('Pridėti') }}</a>
                        @endcan
                    </div>
                    <div class="card-body">
                        <table class="table">
                            <thead>
                            <tr>
                                <th>{{ __('Valstybiniai numeriai') }}</th>
                                <th>{{ __('Markė') }}</th>
                                <th>{{ __('Modelis') }}</th>
                                <th>{{ __('Savininkas') }}</th>
                                <th>{{ __('Nuotraukos') }}</th>
                                <th></th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($cars as $car)
                                @can('view', $car)
                                <tr>
                                    <td>{{ $car->reg_number }}</td>
                                    <td>{{ $car->brand }}</td>
                                    <td>{{ $car->model }}</td>
                                    <td>{{ $car->owner->name }} {{ $car->owner->surname }}</td>
                                    <td>
                                        @can('update', $car)
                                        @if ($car->images->isNotEmpty())
                                            <a href="{{  route('image.downloadAll', $car->id) }}" class="btn btn-primary" target="_blank">{{ __('Atsisiųsti') }}</a>
                                        @endif
                                        @endcan
                                    </td>
                                    <td style="width: 100px;">
                                        @can('update', $car)
                                        <a class="btn btn-info" href="{{ route('cars.edit', $car) }}">{{ __('Redaguoti') }}</a>
                                        @endcan
                                    </td>
                                    <td style="width: 100px;">
                                        <form method="post" action="{{ route('cars.destroy', $car) }}">
                                            @csrf
                                            @can('delete', $car)
                                            @method("delete")
                                            <button class="btn btn-danger">{{ __('Ištrinti') }}</button>
                                            @endcan
                                        </form>
                                    </td>
                                </tr>
                                @endcan
                            @endforeach
                            </tbody>
                      </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
