@extends('admin.layouts.app')
@section('content')

@php
use App\Models\University;
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
                <h3 class="card-title">Create an Event</h3>

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
                <form action="{{ route('store.events') }}" method="post" >
                    @csrf
                      <div class="card-body">
                        <div class="row">
                            <div class="form-group col-6">
                                <label for="Name">Name</label>
                                <input required type="text" class="form-control" name="name" id=name>
                            </div>
                            <div class="form-group col-3" name="status" required>
                                <label>Status</label>
                                <select class="form-control" name="status">
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
                            <div class="form-group col-3">
                                <label for="Name">Event Date</label>
                                <input type="date" class="form-control" name="event_date" required>
                            </div>
                            <div class="form-group col-3">
                                <label>Sport</label>
                                <select class="form-control" name="sport_id" required>
                                    <option value="" >Select the sport</option>

                                    @foreach($sports as $sport)
                                    <option value={{ $sport->sport_id }}>{{ $sport->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group col-3">
                                <label>Category</label>
                                <select class="form-control" name="category_id"  required>
                                    <option value="" >Select The Category</option>

                                    @foreach($categories as $category)
                                    <option value={{ $category->category_id }}>{{ $category->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group col-3">
                                <label>Tournament</label>
                                <select class="form-control" name="tournament_id"  required>
                                    <option value="" >Select Tournament</option>
                                    @foreach($tournaments as $tournament)
                                    <option value={{ $tournament->tournament_id }}>{{ $tournament->name }}</option>
                                    @endforeach
                                </select>
                              </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-12">
                                <label>Participating Teams</label>
                                <div class="row">
                                    @foreach($universities as $index => $university)
                                        <div class="col-3 form-check">
                                            <input type="checkbox" name="teams[]" class="form-check-input" value="{{ $university->uni_id }}">
                                            <label class="form-check-label">{{ $university->name }}</label>
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


</script>
@endsection
