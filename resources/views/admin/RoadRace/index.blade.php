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
              <h3 class="card-title">Road Race Live Score Portal</h3>
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
          @foreach ($scores as $score)
            <div class="card">
              <div class="card-body">
                <div class="card-header">
                  <table>
                    <tr>
                      <td><img width="25" src="{{ $score->university->img_url }}" alt=""></td>
                      <td>&nbsp;{{ $score->university->name }}</td>
                    </tr>
                  </table>
                </div>
                <div class="card-body" style="text-align: center">
                  <div class="row">
                    <div class="col">
                      <form action="{{ route('updateScore.roadRace') }}" method="POST">
                        @method('PATCH')
                        @csrf
                        <div class="input-group mb-3 w-50" role="group" aria-label="Second group">
                          <input type="hidden" name="score_id" value="{{ $score->score_id }}">
                          <input type="text" class="form-control" name="place" value="{{ $score->place }}">
                          <div class="input-group-append">
                            <button type="submit" class="btn btn-primary border">Update Place</button>
                          </div>
                        </div>
                      </form>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          @endforeach
        </div>
        <!-- /.card-body -->
      </div>
      <!-- /.card -->
      <div class="card">
        <div class="card-body">
          <div>
            <form action="{{ route('destroy.roadRace', $event->event_id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete all records for this event?');">
              @csrf
              @method('DELETE')
              <button type="submit" class="btn btn-sm btn-danger">Delete this event</button>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- Current Stats Card -->
  <div class="card live-score-card">
      <h1 class="card-title pt-3">Current Stats</h1>
      <hr>
    <div class="card-body">
      <ul>
        <li>Total Participants: {{ $totalParticipants }}</li>
        <li>Completed Races: {{ $completedRaces }}</li>
        <li>Ongoing Races: {{ $ongoingRaces }}</li>
        <li>Places:
          <ul>
            @foreach ($scores as $score)
              <li>{{ $score->university->name }}: {{ $score->place }}</li>
            @endforeach
          </ul>
        </li>
      </ul>
    </div>
  </div>
  <!-- /.Current Stats Card -->

</div>
<!-- /.container-fluid -->
</section>

</div>

<style>
  .live-score-card {
    text-align: center;
    width: 20%;
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
</style>

@endsection
