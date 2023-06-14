@extends('layouts.app')

@section('title')
    Home | Mini slack
@endsection

@section('content')
    <div class="container">
        <div class="row my-5">
            <div class="col-md-9">
                <div class="card">
                    <div class="card-header">{{ __('Dernieres questions') }}</div>

                    <div class="card-body">
                        <ul class="list-group">
                            @foreach($questions as $question)
                                <hr>
                                <li class="d-flex justify-content-between">
                                    <a href="{{route('questions.show',$question)}}" class="text-decoration-none">
                                        {{$question->titre}}
                                    </a>

                                <li class="d-flex">
                                    <p>
                                        {{$question->body}}
                                    </p>
                                </li>
                                <li class="d-flex">
                                        <span class="badge bg-secondary p-1">
                                            {{$question->collective->titre}}
                                      </span>
                                    <span class="d-flex justify-content-center">
                                            Posté par : <b>{{ $question->user->name }}</b>
                                        </span>
                                </li>
                                </li>
                            @endforeach
                            <hr>
                        </ul>
                        <div class="d-flex justify-centent-center my-2">
                            {{$questions->links()}}
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-3">
                <div class="card">
                    <div class="card-header">{{ __('Categories') }}</div>

                    <div class="card-body">
                        <ul class="list-group">
                            @foreach($categories as $category)
                                <li class="list-group-item d-flex justify-content-between">
                                    <a href="{{route('home',$category)}}" class="text-decoration-none">
                                        {{$category->nom}}
                                    </a>

                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection
