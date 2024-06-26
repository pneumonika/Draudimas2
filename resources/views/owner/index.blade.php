@extends('layouts.app')

@section("content")
    <div class="container">
        <div  class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        {{ __('Automobilių savininkai') }}
                        @can('create', App\Models\Owner::class)
                        <a class="btn btn-primary" href="{{ route('owner.create') }}">{{ __('Pridėti') }}</a>
                        @endcan
                    </div>
                    <div class="card-body">
                      <table class="table">
                          <thead>
                          <tr>
                              <th>{{ __('Vardas') }}</th>
                              <th>{{ __('Pavardė') }}</th>
                              <th>{{ __('Telefonas') }}</th>
                              <th>{{ __('El. paštas') }}</th>
                              <th>{{ __('Adresas') }}</th>
                              <th></th>
                          </tr>
                          </thead>
                          <tbody>
                          @foreach($owners as $owner)
                              @can('view', $owner)
                          <tr>
                              <td>{{ $owner->name }}</td>
                              <td>{{ $owner->surname }}</td>
                              <td>{{ $owner->phone }}</td>
                              <td>{{ $owner->email }}</td>
                              <td>{{ $owner->address }}</td>
                              <td style="width: 100px;">
                                  @can('update', $owner)
                                  <a class="btn btn-info" href="{{ route('owner.edit', $owner->id) }}">{{ __('Redaguoti') }}</a>
                                  @endcan
                              </td>
                              <td style="width: 100px;">
                                  @can('delete', $owner)
                                  <a class="btn btn-danger" href="{{ route('owner.delete', $owner->id) }}">{{ __('Ištrinti') }}</a>
                                  @endcan
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
