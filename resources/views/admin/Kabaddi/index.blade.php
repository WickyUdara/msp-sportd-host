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
              <h3 class="card-title">Kabaddi Live Score Portal</h3>
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
                    <th>Raid Points</th>
                    <th>Bonus Points</th>
                    <th>Tackle Points</th>
                    <th>All Out Points</th>
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
                          <button class="btn btn-sm btn-danger" onclick="updateScore({{ $score->score_id }}, 'raid_points', -1)">-</button>
                          <span id="{{ $score->score_id }}_raid_points">{{ $score->raid_points ?? "--" }}</span>
                          <button class="btn btn-sm btn-success" onclick="updateScore({{ $score->score_id }}, 'raid_points', 1)">+</button>
                        </div>
                      </td>
                      <td>
                        <div class="score-control">
                          <button class="btn btn-sm btn-danger" onclick="updateScore({{ $score->score_id }}, 'bonus_points', -1)">-</button>
                          <span id="{{ $score->score_id }}_bonus_points">{{ $score->bonus_points ?? "--" }}</span>
                          <button class="btn btn-sm btn-success" onclick="updateScore({{ $score->score_id }}, 'bonus_points', 1)">+</button>
                        </div>
                      </td>
                      <td>
                        <div class="score-control">
                          <button class="btn btn-sm btn-danger" onclick="updateScore({{ $score->score_id }}, 'tackle_points', -1)">-</button>
                          <span id="{{ $score->score_id }}_tackle_points">{{ $score->tackle_points ?? "--" }}</span>
                          <button class="btn btn-sm btn-success" onclick="updateScore({{ $score->score_id }}, 'tackle_points', 1)">+</button>
                        </div>
                      </td>
                      <td>
                        <div class="score-control">
                          <button class="btn btn-sm btn-danger" onclick="updateScore({{ $score->score_id }}, 'all_out_points', -1)">-</button>
                          <span id="{{ $score->score_id }}_all_out_points">{{ $score->all_out_points ?? "--" }}</span>
                          <button class="btn btn-sm btn-success" onclick="updateScore({{ $score->score_id }}, 'all_out_points', 1)">+</button>
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
                <form action="{{ route('destroy.kabaddi', $event->event_id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete all records for this event?');">
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

<script>
  function updateScore(scoreId, field, increment) {
    $.ajax({
      url: '{{ route("updateScore.kabaddi") }}',
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
          $('#' + scoreId + '_total_score').text(response.totalScore);
        } else {
          alert('Error updating score');
        }
      },
      error: function(xhr) {
        alert('Error updating score');
      }
    });
  }
</script>

@endsection
