@extends('layouts.app')

@section('titre')
    Update Collective | Mini stack
@endsection

@section('content')
    <div class="container">
        <div class="row justify-content-center my-5">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Mettre à jour une collection') }}</div>

                    <div class="card-body">
                        <form method="POST" action="{{ route('collectives.update', $collective) }}">
                            @csrf
                            @method('PUT')
                            <div class="row mb-3">
                                <label for="category_id" class="col-md-4 col-form-label text-md-end">{{ __('Categorie') }} <span class="text-danger fw-bold">*</span> </label>

                                <div class="col-md-6">
                                    <select name="category_id" id="category_id"
                                            class="form-select @error('category_id') is-invalid @enderror" >
                                        <option disabled selected>Choisis une catégorie</option>
                                        @foreach($categories as $cat)
                                            <option
                                                @if($cat->id === $collective->category_id) selected @endif
                                                value="{{$cat->id}}">
                                                {{$cat->nom}}
                                            </option>
                                        @endforeach
                                    </select>

                                    @error('category_id')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="titre" class="col-md-4 col-form-label text-md-end">{{ __('Titre') }} <span class="text-danger fw-bold">*</span></label>

                                <div class="col-md-6">
                                    <input id="name" type="text" class="form-control @error('titre') is-invalid @enderror" name="titre" value="{{ old('titre', $collective->titre) }}" required autocomplete="titre" autofocus>

                                    @error('titre')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="description" class="col-md-4 col-form-label text-md-end">{{ __('Description') }} <span class="text-danger fw-bold">*</span></label>

                                <div class="col-md-6">
                                    <textarea rows="5" cols="30"
                                              class="form-control @error('description') is-invalid @enderror" name="description"
                                              required autocomplete="description">{{ old('description',$collective->description) }}</textarea>

                                    @error('description')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
                                        {{ __('Enregistrer') }}
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
