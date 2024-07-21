@extends('admin.layouts.app')
@section('content')

@php
use App\Models\University;
use App\Models\Category;
use App\Models\Tournament;
use App\Models\Sport;
@endphp

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
                <h3 class="card-title">Edit Event</h3>

                <div class="card-tools">

                  <div class="input-group-append">
                    <button type="submit" class="btn btn-default" data-toggle="modal" data-target="#modal-add-edit" onclick="openModel()">
                     <a href="{{ route('index.events') }}">Go back To events</a>
                    </button>
                  </div>
                </div>
              </div>
              <!-- /.card-header -->
              <div class="card-body table-responsive p-0">
                <form action="{{ route('update.events',$event->event_id) }}" method="post" >
                    @csrf
                    @method('PUT')
                     <div class="card-body">
                        <div class="row">
                            <div class="form-group col-6">
                                <label for="Name">Name</label>
                                <input required type="text" class="form-control" name="name" value="{{ $event->name }}">
                            </div>
                            <div class="form-group col-3" name="status">
                                <label>Status</label>
                                <select class="form-control" name="status">

                                    <option value="{{ $event->status }}" selected >{{  $event->status  }}</option>
                                    <option value="live">Live</option>
                                    <option value="upcoming">Upcoming</option>
                                    <option value="past">Past</option>
                                </select>
                            </div>
                            <div class="form-group col-3">
                                <label for="Name">Live Stream Link</label>
                                <input type="text" class="form-control" name="livestream_link" >
                            </div>
                        </div>
                        <div class="row">

                        </div>
                        <div class="row">
                            <div class="form-group col-3">
                                <label for="Name">Event Date</label>
                                <input type="date" class="form-control" name="event_date" value="{{ $event->event_date }}">
                            </div>
                            <div class="form-group col-3">
                                <label>Sport</label>
                                <select class="form-control" name="sport_id" required>

                                    <option value="{{ $event->sport_id }}" selected >{{  (Sport::getSingleRecord($event->sport_id))->name  }}</option>

                                    @foreach($sports as $sport)
                                    <option value={{ $sport->sport_id }}>{{ $sport->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group col-3">
                                <label>Category</label>
                                <select class="form-control" name="category_id"  required>
                                    <option value="{{ $event->category_id }}" >{{  (Category::getSingleRecord($event->category_id))->name  }}</option>

                                    @foreach($categories as $category)
                                    <option value={{ $category->category_id }}>{{ $category->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group col-3">
                                <label>Tournament</label>
                                <select class="form-control" name="tournament_id"  required>
                                    <option value="{{ $event->tournament_id }}" selected>{{  (Tournament::getSingleRecord($event->tournament_id))->name  }}</option>
                                    @foreach($tournaments as $tournament)
                                    <option value={{ $tournament->tournament_id }}>{{ $tournament->name }}</option>
                                    @endforeach
                                </select>
                              </div>
                        </div>

                        <div class="row">
                            <div class="form-group col-3">
                                <label>Match Winning status</label>
                                <select class="form-control" name="winning_status" id="winningStatus">

                                    @if($event->winning_status != NULL)

                                        <option value="{{ $event->winning_status }}" selected >{{ $event->winning_status }}</option>
                                    @else
                                        <option value="notstarted" >notstarted</option>
                                    @endif
                                    <option value="won" >Won</option>
                                    <option value="drawn" >Drawn</option>
                                    <option value="cancelled" >cancelled</option>
                                    <option value="ongoing" >ongoing</option>
                                </select>
                              </div>
                              <div class="form-group col-3" id="winnerTeamGroup" style="display: none;">
                                <label>Winner Team</label>
                                <select class="form-control" name="winner_uni_id">
                                    @if($event->winner_uni_id != NULL)
                                        <option value="{{ $event->winner_uni_id }}" selected>{{ (University::getSingleRecord($event->winner_uni_id))->name }}</option>
                                    @else
                                        <option value="">Select Winner At End</option>
                                    @endif
                                    @foreach($universities as $university)
                                        <option value="{{ $university->uni_id }}">{{ $university->name }}</option>
                                    @endforeach
                                </select>
                            </div>

                        </div>
                        <div class="row">
                            <div class="form-group col-12">
                                <label>Participating Teams</label><br>
                                <div class="row">
                                    @foreach($universities as $university)
                                    <div class="col-3 form-check">
                                    <input type="checkbox" name="teams[]" class="form-check-input"  value="{{ $university->uni_id }}" @if(in_array($university->uni_id, $team_ids)) checked  @endif> {{ $university->name }}<br>
                                    </div>
                                    @endforeach
                                </div>
                              </div>
                        </div>
                        <input type="submit" class="btn btn-primary col-12" value="Save">
                          </form>

              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
        </div>
        <!-- /.row -->

        <!-- /.row -->

        <!-- /.row -->

        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>

  </div>






@endsection
@section('scripts')
<script>

document.getElementById('winningStatus').addEventListener('change', function () {
        var winnerTeamGroup = document.getElementById('winnerTeamGroup');
        if (this.value === 'won') {
            winnerTeamGroup.style.display = 'block';
        } else {
            winnerTeamGroup.style.display = 'none';
        }
    });

    // Trigger change event to handle the case where the page loads with a pre-selected value
    document.getElementById('winningStatus').dispatchEvent(new Event('change'));
</script>
@endsection
