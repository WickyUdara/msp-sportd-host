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
              <h3 class="card-title">Beach Volleyball Live Score Portal</h3>
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
              <form action="{{ route('store.beachVolleyBall') }}" method="POST">
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
                      <th>Set 1 Score</th>
                      <th>Set 2 Score</th>
                      <th>Set 3 Score</th>
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
                            <button class="btn btn-sm btn-danger" onclick="updateScore({{ $score->score_id }}, 'set_1_score', -1)">-</button>
                            <span id="{{ $score->score_id }}_set_1_score">{{ $score->set_1_score ?? "--" }}</span>
                            <button class="btn btn-sm btn-success" onclick="updateScore({{ $score->score_id }}, 'set_1_score', 1)">+</button>
                          </div>
                        </td>
                        <td>
                          <div class="score-control">
                            <button class="btn btn-sm btn-danger" onclick="updateScore({{ $score->score_id }}, 'set_2_score', -1)">-</button>
                            <span id="{{ $score->score_id }}_set_2_score">{{ $score->set_2_score ?? "--" }}</span>
                            <button class="btn btn-sm btn-success" onclick="updateScore({{ $score->score_id }}, 'set_2_score', 1)">+</button>
                          </div>
                        </td>
                        <td>
                          <div class="score-control">
                            <button class="btn btn-sm btn-danger" onclick="updateScore({{ $score->score_id }}, 'set_3_score', -1)">-</button>
                            <span id="{{ $score->score_id }}_set_3_score">{{ $score->set_3_score ?? "--" }}</span>
                            <button class="btn btn-sm btn-success" onclick="updateScore({{ $score->score_id }}, 'set_3_score', 1)">+</button>
                          </div>
                        </td>
                      </tr>
                    @endforeach
                  </tbody>
                </table>

                <!-- Round Controls -->
                <div class="round-controls text-center mt-4">
                  <h4>Current Round: <span id="current-round">{{ $scores->first()->round ?? 0 }}</span></h4>
                  <div class="d-inline-block">
                    <button class="btn btn-sm btn-danger" onclick="updateRound({{ $event->event_id }}, -1)">-</button>
                    <span id="current-round-copy" class="mx-2">{{ $scores->first()->round ?? 0 }}</span>
                    <button class="btn btn-sm btn-success" onclick="updateRound({{ $event->event_id }}, 1)">+</button>
                  </div>
                </div>
                <!-- End of Round Controls -->

                <div>
                  <form action="{{ route('destroy.beachVolleyBall', $event->event_id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete all records for this event?');">
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
  </div>
</div>
<!-- /.container-fluid -->
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

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
  function updateScore(scoreId, field, increment) {
    $.ajax({
      url: '{{ route("updateScore.beachVolleyBall") }}',
      method: 'POST',
      headers: {
        'X-CSRF-TOKEN': '{{ csrf_token() }}'
      },
      data: {
        score_id: scoreId,
        field: field,
        increment: increment
      },
      success: function(response) {
        if (response.success) {
          document.getElementById(scoreId + '_' + field).innerText = response.newScore;
        } else {
          alert('Error updating score');
        }
      },
      error: function(xhr) {
        alert('Error updating score');
      }
    });
  }

  function updateRound(eventId, increment) {
    $.ajax({
      url: '{{ route("updateRound.beachVolleyBall") }}',
      method: 'POST',
      headers: {
        'X-CSRF-TOKEN': '{{ csrf_token() }}'
      },
      data: {
        event_id: eventId,
        increment: increment
      },
      success: function(response) {
        if (response.success) {
          document.getElementById('current-round').innerText = response.newRound;
          document.getElementById('current-round-copy').innerText = response.newRound;
        } else {
          alert('Error updating round');
        }
      },
      error: function(xhr) {
        alert('Error updating round');
      }
    });
  }
</script>

@endsection
