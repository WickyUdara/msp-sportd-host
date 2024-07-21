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
              <h3 class="card-title">Taekwondo Live Score Portal</h3>
              <div class="card-tools">
                <div class="input-group-append">
                  <button type="submit" class="btn btn-default" data-toggle="modal" data-target="#modal-add-edit">
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

          <div class="card">
            <div class="card-body">
              <table class="table text-center" id="scores-table">
                <thead>
                  <tr>
                    <th>Team</th>
                    <th>Score</th>
                    <th>Penalty</th>
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
                          <button class="btn btn-sm btn-danger" onclick="updateScore({{ $score->score_id }}, 'score', -1)">-</button>
                          <span id="{{ $score->score_id }}_score">{{ $score->score ?? "--" }}</span>
                          <button class="btn btn-sm btn-success" onclick="updateScore({{ $score->score_id }}, 'score', 1)">+</button>
                        </div>
                      </td>
                      <td>
                        <div class="score-control">
                          <button class="btn btn-sm btn-danger" onclick="updateScore({{ $score->score_id }}, 'penalty', -1)">-</button>
                          <span id="{{ $score->score_id }}_penalty">{{ $score->penalty ?? "--" }}</span>
                          <button class="btn btn-sm btn-success" onclick="updateScore({{ $score->score_id }}, 'penalty', 1)">+</button>
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
                  <button class="btn btn-sm btn-danger" onclick="updateRound({{ $scores->first()->event_id }}, -1)">-</button>
                  <span class="mx-2" id="round-display">{{ $scores->first()->round ?? 0 }}</span>
                  <button class="btn btn-sm btn-success" onclick="updateRound({{ $scores->first()->event_id }}, 1)">+</button>
                </div>
              </div>
              <!-- End of Round Controls -->

              <div>
                <form action="{{ route('destroy.taekwondo', $event->event_id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete all records for this event?');">
                  @csrf
                  @method('DELETE')
                  <button type="submit" class="btn btn-sm btn-danger">Delete this event</button>
                </form>
              </div>
            </div>
          </div>
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
      url: "{{ route('updateScore.taekwondo') }}",
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
          $('#' + scoreId + '_' + field).text(response.newScore);
        } else {
          alert(response.error);
        }
      },
      error: function(xhr) {
        alert('An error occurred while updating the score');
      }
    });
  }

  function updateRound(eventId, increment) {
    $.ajax({
      url: "{{ route('updateRound.taekwondo') }}",
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
          $('#current-round').text(response.newRound);
          $('#round-display').text(response.newRound);
        } else {
          alert(response.error);
        }
      },
      error: function(xhr) {
        alert('An error occurred while updating the round');
      }
    });
  }
</script>

@endsection
