@extends('admin.layouts.app')
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
                            <h3 class="card-title">Chess Live Score Portal</h3>
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
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    @if ($scores->isEmpty())
                        <div class="w-100" style="text-align: center">
                            <h2>Match Not Started Yet...</h2>
                            <form action="{{ route('store.chess') }}" method="POST">
                                @csrf
                                <div class="card" style="text-align: left;">
                                    <div class="card-body">
                                        <label for="Name">Team 1:</label>
                                        <select class="form-control" name="university_id[]">
                                            <option value="{{ optional($scores->get(0)->university)->uni_id }}" selected>{{ optional($scores->get(0)->university)->name }}</option>
                                            <option value="{{ optional($scores->get(1)->university)->uni_id }}">{{ optional($scores->get(1)->university)->name }}</option>
                                        </select>
                                        <br>
                                        <label for="Name">Team 2:</label>
                                        <select class="form-control" name="university_id[]">
                                            <option value="{{ optional($scores->get(0)->university)->uni_id }}">{{ optional($scores->get(0)->university)->name }}</option>
                                            <option value="{{ optional($scores->get(1)->university)->uni_id }}" selected>{{ optional($scores->get(1)->university)->name }}</option>
                                        </select>
                                        <br>
                                        <input type="hidden" name="event_id" value="{{ $event->event_id }}">
                                        <input class="btn btn-primary" type="submit" value="Start"/>
                                    </div>
                                </div>
                            </form>
                        </div>
                    @else
                        <div class="card">
                            <div class="card-body">
                                <table class="table" id="scores-table">
                                    <thead>
                                        <tr class="text-center">
                                            <th>Team</th>
                                            <th>Match 1 Score</th>
                                            <th>Match 2 Score</th>
                                            <th>Match 3 Score</th>
                                            <th>Match 4 Score</th>
                                            <th>Match 5 Score</th>
                                            <th>Match 6 Score</th>
                                            <th>Total Score</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($scores as $score)
                                            <tr id="score-row-{{ $score->score_id }}">
                                                <td>
                                                    <img src="{{ $score->university->img_url }}" alt="{{ $score->university->name }}" style="width: 20px; height: 20px; margin-right: 5px;">
                                                    {{ $score->university->name }}
                                                </td>
                                                <td>
                                                    <div class="score-control">
                                                        <button class="btn btn-sm btn-danger" onclick="changeScore({{ $score->score_id }}, 'match_1_score', -0.5)">-</button>
                                                        <span id="{{ $score->score_id }}_match_1_score">{{ $score->match_1_score ?? "--" }}</span>
                                                        <button class="btn btn-sm btn-success" onclick="changeScore({{ $score->score_id }}, 'match_1_score', 0.5)">+</button>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="score-control">
                                                        <button class="btn btn-sm btn-danger" onclick="changeScore({{ $score->score_id }}, 'match_2_score', -0.5)">-</button>
                                                        <span id="{{ $score->score_id }}_match_2_score">{{ $score->match_2_score ?? "--" }}</span>
                                                        <button class="btn btn-sm btn-success" onclick="changeScore({{ $score->score_id }}, 'match_2_score', 0.5)">+</button>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="score-control">
                                                        <button class="btn btn-sm btn-danger" onclick="changeScore({{ $score->score_id }}, 'match_3_score', -0.5)">-</button>
                                                        <span id="{{ $score->score_id }}_match_3_score">{{ $score->match_3_score ?? "--" }}</span>
                                                        <button class="btn btn-sm btn-success" onclick="changeScore({{ $score->score_id }}, 'match_3_score', 0.5)">+</button>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="score-control">
                                                        <button class="btn btn-sm btn-danger" onclick="changeScore({{ $score->score_id }}, 'match_4_score', -0.5)">-</button>
                                                        <span id="{{ $score->score_id }}_match_4_score">{{ $score->match_4_score ?? "--" }}</span>
                                                        <button class="btn btn-sm btn-success" onclick="changeScore({{ $score->score_id }}, 'match_4_score', 0.5)">+</button>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="score-control">
                                                        <button class="btn btn-sm btn-danger" onclick="changeScore({{ $score->score_id }}, 'match_5_score', -0.5)">-</button>
                                                        <span id="{{ $score->score_id }}_match_5_score">{{ $score->match_5_score ?? "--" }}</span>
                                                        <button class="btn btn-sm btn-success" onclick="changeScore({{ $score->score_id }}, 'match_5_score', 0.5)">+</button>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="score-control">
                                                        <button class="btn btn-sm btn-danger" onclick="changeScore({{ $score->score_id }}, 'match_6_score', -0.5)">-</button>
                                                        <span id="{{ $score->score_id }}_match_6_score">{{ $score->match_6_score ?? "--" }}</span>
                                                        <button class="btn btn-sm btn-success" onclick="changeScore({{ $score->score_id }}, 'match_6_score', 0.5)">+</button>
                                                    </div>
                                                </td>
                                                <td>
                                                    <span id="{{ $score->score_id }}_total_score">{{ $score->total_score ?? "--" }}</span>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                                <div>
                                    <form action="{{ route('destroy.chess', $event->event_id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete all records for this event?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger">Delete this event</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    @endif
                </div>
                <!-- /.card-body -->
            </div>
            <!-- /.card -->
        </div>
    </section>
</div>

<style>
    .score-control {
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .score-control button {
        margin: 0 5px;
    }

    .score-control span {
        display: inline-block;
        width: 30px;
        text-align: center;
    }
</style>

@endsection

@section('scripts')
<script>
    function changeScore(scoreId, field, increment) {
        $.ajax({
            url: '{{ route("updateScore.chess") }}',
            method: 'POST',
            data: {
                _token: '{{ csrf_token() }}',
                score_id: scoreId,
                field: field,
                increment: increment
            },
            success: function(response) {
                if (response.success) {
                    $('#' + scoreId + '_' + field).text(response.newScore);
                    $('#' + scoreId + '_total_score').text(response.totalScore);
                } else {
                    alert(response.message);
                }
            },
            error: function() {
                alert('An error occurred while updating the score.');
            }
        });
    }
</script>
@endsection
