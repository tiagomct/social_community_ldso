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
                    @if(!($userAnswerId))
                        <th>
                            <h4>Choose option</h4>
                        </th>
                    @endif
                    </thead>
                    <tbody>
                    @foreach($answers as $answer)
                        <tr class={{ ($answer->id)==($userAnswerId) ? 'success' : ''  }}>
                            <td>
                                <p>{{ $answer->description }}</p>
                            </td>
                            <td>
                                <h3>{{ $answer->CountVotes() }}</h3>
                            </td>
                            @if(!($userAnswerId))
                                <td>
                                    <a href={{action('ReferendumsController@submitVote', array($referendum->id, $answer->id)) }} class="btn
                                       btn-success"><i class="fa fa-thumbs-up"></i> Vote </a>
                                </td>
                            @endif
                        </tr>
                    @endforeach

                    </tbody>
                </table>

            </div>
        </div>
    </div>

@endsection