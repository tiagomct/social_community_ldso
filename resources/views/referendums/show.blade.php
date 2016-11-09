@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="row">

            <div class="col-md-12 col-xs-12 col-sm-12">
                <ul class="list-group">

                    <!--    Title   -->
                    <li class="list-group-item">
                        <h2>{{ $referendum->title }}</h2>
                    </li>

                    <!--    Created at  -->
                    <li class="list-group-item">
                        <h4>Date created:</h4>
                        <p>{{ $referendum->created_at }}</p>
                    </li>

                    <!--    Description -->
                    <li class="list-group-item">
                        <h4> Description: </h4>
                        <p>{{ $referendum->description }}</p>
                    </li>
                </ul>

            </div>
        </div>
        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <table class="table">
                    <thead>
                    <th>
                        <h4>Option</h4>
                    </th>
                    <th>
                        <h4>Votes</h4>
                    </th>
                    @if($voted==False)
                        <th>
                            <h4>Choose option</h4>
                        </th>
                    @endif
                    </thead>
                    <tbody>
                    @for($i=0; $i<$number_of_answers; $i++)
                        <tr>
                            <td>
                                <p>{{ $answers[$i]->description }}</p>
                            </td>
                            <td>
                                <h3>{{$voteCount[$i]}}</h3>
                            </td>
                            @if($voted==False)
                                <td>
                                    <a href={{action('ReferendumsController@submitVote', array($referendum->id, $answers[$i]->id)) }} class="btn
                                       btn-success"> Vote </a>
                                </td>
                            @endif
                        </tr>
                    @endfor

                    </tbody>
                </table>

            </div>
        </div>
    </div>

@endsection