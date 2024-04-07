@extends('layouts.app')

@section("content")
    <div class="container">
        <div  class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        {{ __('Automobiliai') }}
                        <a class="btn btn-primary" href="{{ route('cars.create') }}">{{ __('Pridėti') }}</a>
                    </div>
                    <div class="card-body">
                        <table class="table">
                            <thead>
                            <tr>
                                <th>{{ __('Valstybiniai numeriai') }}</th>
                                <th>{{ __('Markė') }}</th>
                                <th>{{ __('Modelis') }}</th>
                                <th>{{ __('Savininkas') }}</th>
                                <th></th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($cars as $car)
                                <tr>
                                    <td>{{ $car->reg_number }}</td>
                                    <td>{{ $car->brand }}</td>
                                    <td>{{ $car->model }}</td>
                                    <td>{{ $car->owner->name }} {{ $car->owner->surname }}</td>
                                    <td style="width: 100px;">
                                        <a class="btn btn-info" href="{{ route('cars.edit', $car) }}">{{ __('Redaguoti') }}</a>
                                    </td>
                                    <td style="width: 100px;">
                                        <form method="post" action="{{ route('cars.destroy', $car) }}">
                                            @csrf
                                            @method("delete")
                                            <button class="btn btn-danger">{{ __('Ištrinti') }}</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                      </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
