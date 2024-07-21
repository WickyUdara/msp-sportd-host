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
              <h3 class="card-title">Hockey Live Score Portal</h3>
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
          @if ($scores->isEmpty())
            <div class="w-100" style="text-align: center">
              <h2>Match Not Started Yet...</h2>
              <form action="{{ route('store.hockey') }}" method="POST">
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
                    <tr>
                      <th>Team</th>
                      <th>Goals</th>
                      <th>Shots</th>
                      <th>Circle Penetrations</th>
                      <th>Penalty Corners</th>
                      <th>Green Cards</th>
                      <th>Yellow Cards</th>
                      <th>Red Cards</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach ($scores as $score)
                      <tr id="score-row-{{ $score->score_id }}">
                        <td>
                          <img src="{{ $score->university->img_url }}" alt="{{ $score->university->name }}" style="width: 20px; height: 20px; margin-right: 5px;">
                          {{ $score->university->name }}
                        </td>
                        @foreach(['goals', 'shots', 'circle_penetrations', 'penalty_corners', 'green_cards', 'yellow_cards', 'red_cards'] as $field)
                        <td>
                          <div class="score-control">
                            <button class="btn btn-sm btn-success" onclick="changeScore({{ $score->score_id }}, '{{ $field }}', -1)">-</button>
                            <span id="{{ $score->score_id }}_{{ $field }}">{{ $score->$field ?? "--" }}</span>
                            <button class="btn btn-sm btn-success" onclick="changeScore({{ $score->score_id }}, '{{ $field }}', 1)">+</button>
                          </div>
                        </td>
                        @endforeach
                      </tr>
                    @endforeach
                  </tbody>
                </table>
                <div>
                  <form action="{{ route('destroy.hockey', $event->event_id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete all records for this event?');">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-sm btn-danger">Delete this event</button>
                  </form>
                </div>
              </div>
            </div>
          @endif

          <!-- Current Live Score Card -->
          <div class="card live-score-card">
            <h1 class="card-title pt-3">Current Live Score</h1>
            <hr>
            <div class="card-body">
              <table class="table">
                <thead>
                  <tr>
                    <th>Team</th>
                    <th>Goals</th>
                    <th>Shots</th>
                    <th>Circle Penetrations</th>
                    <th>Penalty Corners</th>
                    <th>Green Cards</th>
                    <th>Yellow Cards</th>
                    <th>Red Cards</th>
                  </tr>
                </thead>
                <tbody id="live-scores">
                  @foreach ($scores as $score)
                    <tr>
                      <td>
                        <img src="{{ $score->university->img_url }}" alt="{{ $score->university->name }}" style="width: 20px; height: 20px; margin-right: 5px;">
                        {{ $score->university->name }}
                      </td>
                      @foreach(['goals', 'shots', 'circle_penetrations', 'penalty_corners', 'green_cards', 'yellow_cards', 'red_cards'] as $field)
                      <td id="live_{{ $score->score_id }}_{{ $field }}">{{ $score->$field ?? "--" }}</td>
                      @endforeach
                    </tr>
                  @endforeach
                </tbody>
              </table>
            </div>
          </div>
          <!-- /.Current Live Score Card -->

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
  .live-score-card {
    text-align: center;
    width: 40%;
    position: fixed;
    bottom: 20px;
    right: 20px;
  }

  @media only screen and (max-height: 700px){
    .live-score-card {
        display: none;
    }
  }

  @media only screen and (max-width: 700px){
    .live-score-card {
        display: none;
    }
  }
  
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
  function changeScore(scoreId, field, increment) {
    $.ajax({
      url: '{{ route('update.hockey', '') }}/' + scoreId,
      type: 'PATCH',
      data: {
        _token: '{{ csrf_token() }}',
        field: field,
        increment: increment
      },
      success: function(response) {
        if(response.success) {
          const scoreElement = document.getElementById(`${scoreId}_${field}`);
          scoreElement.textContent = response.newScore;

          // Update the live score card
          document.querySelector(`#live_${scoreId}_${field}`).textContent = response.newScore;
        } else {
          alert('Error updating score');
        }
      },
      error: function(xhr, status, error) {
        alert('Error updating score');
      }
    });
  }
</script>

@endsection
