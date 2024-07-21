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
                <h3 class="card-title">Rugby Live Score Portal</h3>

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
                <div class="card">
                  <div class="card-body">
                    <div class="card-header">
                      <h5>Current Round</h5>
                    </div>
                    <br>
                    <form action="" method="post">
                      @method('PATCH')
                      @csrf
                      <div class="input-group mb-3 w-50" role="group" aria-label="Second group">
                        <input type="hidden" name="update_current_round" value="">
                        <input type="text" class="form-control" name="current_round" value="{{ $scores->get(0)->current_round }}" placeholder="Enter current round name...">
                        <div class="input-group-append">
                          <button type="submit" class="btn btn-primary border">Update</button>
                        </div>
                      </div>
                    </form>
                  </div>
                </div>

                <br>
                <h3>Update Places</h3>

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
                            <form action="" method="post">
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
          </div>
        </div>


      </div><!-- /.container-fluid -->
    </section>

  </div>



@endsection
