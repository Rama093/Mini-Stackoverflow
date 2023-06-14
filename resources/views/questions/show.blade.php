@extends('layouts.app')

@section('titre')
    {{ $questions-> titre}} | Help Me
@endsection

@section('content')
    <div class="container" id="app">
        <div class="row my-5 ">
            <vote-component id="{{$questions->id}}" votes="{{$questions->votes}}"></vote-component>
            <div class="col-md-10">
                <div class="card">
                    <div class="card-header">
                        <h4>
                            {{$questions->titre}}
                        </h4>
                    </div>

                    <div class="card-body">
                        <div class="card-text">
                            {{$questions->body}}
                        </div>
                    </div>

                    <div class="card-footer d-flex justify-content-between">
                        <span class="fw-bold">
                             {{$questions->user->name}}
                        </span>
                        <span class="fw-bold">
                             {{$questions->created_at->diffForhumans()}}
                        </span>
                    </div>

                </div>
                <comment-component
                    question_id="{{$questions->id}}"
                    user_id="{{auth()->check() ? auth()->user()->id: null}}"
                    verified_user="{{auth()->check() && auth()->user()->email_verified_at !==null ? true : false }}"
                    valide ="{{auth()->check() && auth()->user()->type == "superviseur"}}"

                >
                </comment-component>
            </div>
        </div>
    </div>
@endsection
