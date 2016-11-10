@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <!--    Referendum info    -->
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

        <!--    Voting table       -->
        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <table class="table">
                    <thead>
                    <!--    Description     -->
                    <th>
                        <h4>Option</h4>
                    </th>
                    <!--    Number of votes -->
                    <th>
                        <h4>Votes</h4>
                    </th>
                    <!--    Submit vote     -->
                    @if(!($userAnswerId))
                        <th>
                            <h4>Vote</h4>
                        </th>
                    @endif
                    </thead>
                    <tbody>
                    @foreach($answers as $answer)
                        <tr class={{ ($answer->id)==($userAnswerId) ? 'success' : ''  }}>
                            <!--    Description     -->
                            <td>
                                <p>{{ $answer->description }}</p>
                            </td>
                            <!--    Number of votes -->
                            <td>
                                <h3>{{ $answer->number_of_votes }}</h3>
                            </td>
                            <!--    Submit vote     -->
                            @if(!($userAnswerId))
                                <td>
                                    <a href={{action('ReferendumsController@submitVote', array($referendum->id, $answer->id)) }} class="btn
                                       btn-primary"><i class="fa fa-thumbs-up"></i> Vote </a>
                                </td>
                            @endif
                        </tr>
                    @endforeach

                    </tbody>
                </table>

            </div>
        </div>
        <!-- TODO create a percentage bar or pie chart -->
    </div>

@endsection