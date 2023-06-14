@extends('layouts.app')

@section('title')
    Mes Collectives | Mini slack
@endsection

@section('content')
    <div class="container">
        <div class="row justify-content-center my-5 ">
            <div class="col-md-10">
                <div class="card">
                    <div class="card-header">{{ __('Mes collectives') }}</div>

                    <div class="card-body">
                        <table class="table table-hover table-stripped">
                            <thead>
                            <tr>
                                <th>ID</th>
                                <th>Titre</th>
                                <th>Question</th>
                                <th></th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($collectives as $key => $collective)
                                <tr>
                                    <td>{{$key+=1}}</td>
                                    <td>{{$collective->titre}}</td>
                                    <td>
                                          <span class="badge bg-success">
                                              {{$collective->questions->count()}}
                                          </span>
                                    </td>
                                    <td class="d-flex justify-content-center align-items-center">
                                        <a href="{{route('collectives.show', $collective)}}" class="btn btn-sm btn-primary">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                        <a href="{{route('collectives.edit', $collective)}}" class="btn btn-sm btn-warning mx-2">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <form id="{{$collective->id}}" action="{{route('collectives.destroy', $collective)}}" method="post">
                                            @csrf
                                            @method('DELETE')
                                        </form>
                                        <a href="#"
                                           onclick="if(confirm('Voulez-vous supprimer?')) document.getElementById('{{$collective->id}}').submit()"
                                           class="btn btn-sm btn-danger">
                                            <i class="fas fa-trash"></i>
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                        <div class="d-flex justify-centent-center">
                            {{$collectives->links()}}
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection
