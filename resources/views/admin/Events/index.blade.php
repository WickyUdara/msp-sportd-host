@extends('admin.layouts.app')
@section('content')

@php
use App\Models\University;
use App\Models\Sport;
use App\Models\Category;
use App\Models\Tournament;
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
                @if (session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif
                <h3 class="card-title">Events</h3>

                <div class="card-tools">

                  <div class="input-group-append">
                    <button type="submit" class="btn btn-default" >
                     <a href="{{ route('create.events') }}">Add New Event</a>
                    </button>
                  </div>
                </div>
              </div>
              <!-- /.card-header -->
              <div class="card-body table-responsive p-0">
                <table class="table table-hover text-nowrap">
                  <thead>
                    <tr>
                      <th>Name</th>
                      <th>Date</th>
                      <th>Status</th>
                      <th>Live Stream Link</th>
                      <th>Teams</th>
                      <th>Sport</th>
                      <th>Category</th>
                      <th>Tournament</th>
                      <th>Winner</th>
                      <th></th>
                      <th></th>
                    </tr>
                  </thead>
                  <tbody>

                  @foreach ($events as $event)
                  <tr style="{{ $event->status == 'live' ? 'color:white;
                    background-color: green;
                    font-weight: bold;' : '' }}">
                        <td>{{ $event->name }}</td>
                        <td>{{ $event->event_date }}</td>
                        <td >
                                                                {{ $event->status }}</td>
                        <td>{{ $event->livestream_link }}</td>
                        <td>
                          <table>
                            <tr>
                              @foreach ($event->participants as $team)
                                <td><h6><span class="badge badge-primary">{{ $team->university->name }}</span></h6></td>
                              @endforeach
                            <tr>
                          </table>
                        </td>
                        <td>{{ (Sport::getSingleRecord($event->sport_id))->name }}</td>
                        <td>{{ (Category::getSingleRecord($event->category_id))->name }}</td>
                        <td>{{ (Tournament::getSingleRecord($event->tournament_id))->name }}</td>
                        <td> @if($event->winner_uni_id != NULL)
                            @php
                                $university = University::find($event->winner_uni_id);
                            @endphp
                            {{ $university ? $university->name : '' }}
                        @else

                        @endif</td>
                        @php


                            if($event->sport_id==5)
                                $path = 'show.beachVolleyBall';

                            elseif($event->sport_id==4)
                                $path = 'show.badminton';

                            elseif($event->sport_id==3)
                                $path = 'show.karate';

                            elseif($event->sport_id==1)
                                $path = 'show.cricket';
                            elseif($event->sport_id==8)
                                $path = 'show.carrom';

                            elseif ($event->sport_id==7)
                                $path = 'show.kabaddi';

                            elseif($event->sport_id==6)
                                $path = 'show.tableTennis';

                            elseif($event->sport_id==2)
                                $path = 'show.swimming';
                            elseif ($event->sport_id==13)
                                $path = 'show.hockey';

                            elseif ($event->sport_id==11)
                                $path = 'show.roadRace';
                            elseif($event->sport_id==9)
                                $path = 'show.rugby';

                            elseif ($event->sport_id==22) 
                                $path = 'show.chess';

                            elseif ($event->sport_id==18) {
                                $path = 'show.wrestling';
                            }

                            elseif ($event->sport_id==17)
                                $path = 'show.taekwondo';


                            elseif($event->sport_id==10)
                                $path = 'show.volleyBall';

                        @endphp
                        <td><a {{ $event->status != 'live'? 'disabled':'' }}  href="{{route($path,$event->event_id)
                         }}" class="btn btn-warning" >Add Marks</a></td>
                        <td><a href="{{ route('edit.events',$event->event_id) }}" class="btn btn-primary">Edit</a></td>
                        <td><form action="{{ route('delete.events',$event->event_id) }}" method="POST" style="display:inline-block;" class="delete-form">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this event?');">Delete</button>
                        </form></td>
                    </tr>
                    @endforeach

                  </tbody>
                </table>
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

<!-- model for eddit and add -->

<div class="modal fade" id="addEventModal" tabindex="-1" role="dialog" aria-labelledby="addEventModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addEventModalLabel">Add New Event</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="" method="post" id="edit_up_form">
                  <input type="hidden" name="_method" id="f_method" value="POST">
                  @csrf
                    <div class="card-body">
                      <div class="form-group">
                        <label for="Name">Name</label>
                       <input required type="text" class="form-control" name="name" id=name>
                      </div>
                      <div class="form-group" name="status" id=status>
                        <label>Status</label>
                        <select class="form-control">
                        <option>Live</option>
                        <option>Upcoming</option>
                        <option>Past</option>
                        </select>
                      </div>
                      <div class="form-group">
                        <label for="Name">Live Stream Link</label>
                       <input required type="text" class="form-control" name="livestream_link" id=link>
                      </div>
                      <div class="form-group">
                        <label for="Name">Event Date</label>
                       <input required type="date" class="form-control" name="event_date" id=date>
                      </div>
                      <div class="form-group">
                        <label>Team A</label>
                        <select class="form-control" name="team1_uni_id" id="team1_uni_id">
                            @foreach($universities as $university)
                            <option value={{ $university->uni_id }}>{{ $university->name }}</option>
                            @endforeach
                        </select>
                      </div>
                      <div class="form-group">
                        <label>Team B</label>
                        <select class="form-control" name="team1_uni_id" id="team1_uni_id">
                            @foreach($universities as $university)
                            <option value={{ $university->uni_id }}>{{ $university->name }}</option>
                            @endforeach
                        </select>
                      </div>
                      <div class="form-group">
                        <label>Winner Team</label>
                        <select class="form-control" name="winner_uni_id" id="winner_uni_id">
                            @foreach($universities as $university)
                            <option value={{ $university->uni_id }}>{{ $university->name }}</option>
                            @endforeach
                        </select>
                      </div>
                      <div class="form-group">
                        <label>Sport</label>
                        <select class="form-control" name="sport_id" id="sport_id">
                            @foreach($sports as $sport)
                            <option value={{ $sport->sport_id }}>{{ $sport->name }}</option>
                            @endforeach
                        </select>
                      </div>
                      <div class="form-group">
                        <label>Category</label>
                        <select class="form-control" name="category_id" id="category_id">
                            @foreach($categories as $category)
                            <option value={{ $category->category_id }}>{{ $category->name }}</option>
                            @endforeach
                        </select>
                      </div>
                      <div class="form-group">
                        <label>Tournament</label>
                        <select class="form-control" name="tournament_id" id="tournament_id">
                            @foreach($tournaments as $tournament)
                            <option value={{ $tournament->tournament_id }}>{{ $tournament->name }}</option>
                            @endforeach
                        </select>
                      </div>


                        </form>

                    <div class="card-footer">
                    <button type="submit" class="btn btn-primary">Save</button>
                    </div>
                  </form>
            </div>
        </div>
    </div>
</div>



@endsection
@section('scripts')
<script>
    $(document).ready(function () {
        // Code to handle opening and closing of modal
        $('#addEventModal').on('show.bs.modal', function (e) {
            // Do something when modal is about to be shown
        });

        $('#addEventModal').on('hidden.bs.modal', function (e) {
            // Do something when modal is hidden
        });
    });

    function openModel(eventID=null, update=false){
      if(update){
        $('#f_method').val('PATCH')
        document.getElementById('addEventModalLabel').innerHTML = 'Edit Sport Details'
        $('#edit_up_form').attr('action', `${window.location.href}/${eventID}`)
        $('#m_name').val($(`#${eventID}_name`).html())
        $('#addEventModal').modal()
      }else{
        $('#f_method').val('POST')
        document.getElementById('addEventModalLabel').innerHTML = 'Add New Event'
        $('#edit_up_form').attr('action', '')
        $('#m_name').val('')
        $('#m_name').val('')
        $('#m_name').val('')
        $('#m_name').val('')
        $('#m_name').val('')
        $('#m_name').val('')
        $('#addEventModal').modal()
      }
    }
</script>
@endsection
