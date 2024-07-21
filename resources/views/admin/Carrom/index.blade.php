@extends('admin.layouts.app')

@section('head')
    <link rel="stylesheet" href="{{ asset('karate/index.css') }}">
@endsection


@section('content')
    <div class="content-wrapper">

        <section class="content">
            <div class="container-fluid">
                <div class="row">


                    <!-- /.col -->
                </div>
                <!-- /.row -->
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Carrom Live Score Portal</h3>

                                <div class="card-tools">

                                    <div class="input-group-append">
                                        <button type="submit" class="btn btn-default" data-toggle="modal" data-target="#modal-add-edit" onclick="openModel()">
                                            <a href="{{ route('index.events') }}">Go back To events</a>
                                        </button>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body table-responsive p-0">
                    </div>
                    <!-- /.card-body -->
                    <div class="container">
                        <div class="top">
                            @foreach($scores as $score)
                                <div class="top-left">
                                    <img class="team-image "src="{{ asset($score->university_img) }}" alt="{{ $score->university_name }}" class="team-image">
                                    <h2>Score related to the team name :{{$score->university_name}}</h2>
                                    <form action="{{ route('update.carrom', ['carrom' => $score->score_id]) }}" method="POST">
                                        @csrf
                                        @method('PUT')
                                        <input type="hidden" name="score_id" value="{{ $score->score_id }}">
                                        <input type="hidden" name="event_id" value="{{ $event->event_id }}">
                                        <input type="number" name="score" placeholder="Enter Score" required>
                                        <button type="submit">Submit</button>
                                    </form>
                                </div>
                            @endforeach
                        </div>
                        <div class="bottom">
                            <h2>Score related to this Event name: {{$event->name}}</h2>
                            <table>
                                <thead>
                                <tr>
                                    <th>Score ID</th>
                                    <th>Event ID</th>
                                    <th>University ID</th>
                                    <th>Score</th>
                                    <th>Points</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($scores as $score)
                                    <tr>
                                        <td>{{ $score->score_id }}</td>
                                        <td>{{ $score->event_id }}</td>
                                        <td>{{$score->university_name}}</td>
                                        <td>{{ $score->score }}</td>
                                        <td>{{ $score->points }}</td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div >
                    </div>

                </div>
                <!-- /.card -->
            </div>
    </div>


    </div><!-- /.container-fluid -->
    </section>

    </div>



@endsection
