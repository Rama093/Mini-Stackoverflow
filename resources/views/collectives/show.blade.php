@extends('layouts.app')

@section('titre')
    {{ $collective-> titre}} | Mini slack
@endsection

@section('content')
    <div class="container">
        <div class="row justify-content-center my-5 ">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{$collective->titre}}</div>

                    <div class="card-body">
                        <ul class="list-group">
                            @foreach($collective->questions as $question)
                                <li class="list-group-item list-group-item-action">
                                    <a href="{{route('questions.show', $question)}}" class="btn btn-link text-decoration-none text-primary">
                                        {{$question->titre}}
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
