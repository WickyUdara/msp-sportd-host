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
                <h3 class="card-title">Cricket Live Score Portal</h3>

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
                @php
                  $batting = null;
                  $balling = null;

                  if ($scores->get(0)->current_role != $scores->get(1)->current_role) {
                    if ($scores->get(0)->current_role == "bat") {
                      $batting = $scores->get(0);
                      $balling = $scores->get(1);
                    } else {
                      $batting = $scores->get(1);
                      $balling = $scores->get(0);
                    }
                  }
                @endphp

                @if (is_null($batting) && is_null($balling))
                  <div class="w-100" style="text-align: center">
                    <h2>Match Not Started Yet...</h2>
                    <form action="" method="POST">
                      @method('PATCH')
                      @csrf
                      <div class="card" style="text-align: left;">
                        <div class="card-body">
                          <label for="Name">Team Batting:</label>
                          <select class="form-control" name="roles[]">
                            <option value="{{ $scores->get(0)->university->uni_id }}" selected>{{ $scores->get(0)->university->name }}</option>
                            <option value="{{ $scores->get(1)->university->uni_id }}">{{ $scores->get(1)->university->name }}</option>
                          </select>
                          <br>
                          <label for="Name">Team Balling:</label>
                          <select class="form-control" name="roles[]">
                            <option value="{{ $scores->get(0)->university->uni_id }}">{{ $scores->get(0)->university->name }}</option>
                            <option value="{{ $scores->get(1)->university->uni_id }}" selected>{{ $scores->get(1)->university->name }}</option>
                          </select>
                          <br>
                          <input class="btn btn-primary" type="submit" value="Start"/>
                        </div>
                      </div>
                    </form>
                  </div>
                @else
                  <div class="card">
                    <div class="card-body">
                      <form action="" method="POST">
                        @method('PATCH')
                        @csrf
                        <table>
                          <tr>
                            <td>Batting:&nbsp;</td>
                            <td><b>{{ $batting->university->name }}</b></td>
                            <td rowspan="2">&nbsp;&nbsp;<input class="btn btn-warning" type="submit" value="Switch"></td>
                          </tr>
                          <tr>
                            <td>Balling:&nbsp;</td>
                            <td><b>{{ $balling->university->name }}</b></td>
                          </tr>
                        </table>
                        <input type="hidden" name="roles[]" value="{{ $balling->university->uni_id }}">
                        <input type="hidden" name="roles[]" value="{{ $batting->university->uni_id }}">
                      </form>
                    </div>
                  </div>
                  <div class="card">
                    <div class="card-body">
                      <div class="card-header">
                        <table>
                          <tr>
                            <td><h3 class="card-title">Batting:</h3></td>
                            <td>&nbsp;<img width="25" src="{{ $batting->university->img_url }}" alt=""></td>
                            <td>&nbsp;{{ $batting->university->name }}</td>
                          </tr>
                        </table>
                      </div>
                      <div class="card-body">
                        <div class="btn-toolbar" role="toolbar" aria-label="Toolbar with button groups" style="font-family: 'Courier New', Courier, monospace">
                          <div class="btn-group mr-2" role="group" aria-label="First group">
                            <form action="" method="post"><input type="hidden" name="n_6s" value="{{ $batting->n_6s + 1 }}"><button type="submit" class="btn btn-primary border">+ 6 Shot</button>@method('PATCH')@csrf</form>
                            <form action="" method="post"><input type="hidden" name="n_4s" value="{{ $batting->n_4s + 1 }}"><button type="submit" class="btn btn-primary border">+ 4 Shot</button>@method('PATCH')@csrf</form>
                          </div>
                          <div class="btn-group mr-2" role="group" aria-label="First group_1">
                            <form action="" method="post"><input type="hidden" name="runs" value="{{ $batting->runs + 1 }}"><button type="submit" class="btn btn-primary border">+ Run 1</button>@method('PATCH')@csrf</form>
                            <form action="" method="post"><input type="hidden" name="runs" value="{{ $batting->runs + 2 }}"><button type="submit" class="btn btn-primary border">+ Run 2</button>@method('PATCH')@csrf</form>
                            <form action="" method="post"><input type="hidden" name="runs" value="{{ $batting->runs + 3 }}"><button type="submit" class="btn btn-primary border">+ Run 3</button>@method('PATCH')@csrf</form>
                            <form action="" method="post"><input type="hidden" name="runs" value="{{ $batting->runs + 4 }}"><button type="submit" class="btn btn-primary border">+ Run 4</button>@method('PATCH')@csrf</form>
                            <form action="" method="post"><input type="hidden" name="runs" value="{{ $batting->runs + 6 }}"><button type="submit" class="btn btn-primary border">+ Run 6</button>@method('PATCH')@csrf</form>
                          </div>                          
                          <div class="btn-group mr-2" role="group" aria-label="Second group">
                            <form action="" method="post"><input type="hidden" name="wickets" value="{{ $batting->wickets + 1 }}"><button type="submit" class="btn btn-primary border">+ Wicket</button>@method('PATCH')@csrf</form>
                          </div>
                          <div class="btn-group mr-2" role="group" aria-label="Second group">
                            <form action="" method="post"><input type="hidden" name="innings" value="{{ $batting->innings + 1 }}"><button type="submit" class="btn btn-primary border">+ Inning</button>@method('PATCH')@csrf</form>
                          </div>
                          <div class="btn-group" role="group" aria-label="Third group">
                            <form action="" method="post"><input type="hidden" name="wide_balls" value="{{ $batting->wide_balls + 1 }}"><button type="submit" class="btn btn-primary border">+ Wide Ball</button>@method('PATCH')@csrf</form>
                            <form action="" method="post"><input type="hidden" name="no_balls" value="{{ $batting->no_balls + 1 }}"><button type="submit" class="btn btn-primary border">+ No Ball (White)</button>@method('PATCH')@csrf</form>
                          </div>
                        </div>
                        <div class="btn-toolbar" role="toolbar" aria-label="Toolbar with button groups" style="font-family: 'Courier New', Courier, monospace">
                          <div class="btn-group mr-2" role="group" aria-label="First group">
                            <form action="" method="post"><input type="hidden" name="n_6s" value="{{ $batting->n_6s - 1 }}"><button type="submit" class="btn btn-danger border">- 6 Shot</button>@method('PATCH')@csrf</form>
                            <form action="" method="post"><input type="hidden" name="n_4s" value="{{ $batting->n_4s - 1 }}"><button type="submit" class="btn btn-danger border">- 4 Shot</button>@method('PATCH')@csrf</form>
                          </div>
                          <div class="btn-group mr-2" role="group" aria-label="First group_1">
                            <form action="" method="post"><input type="hidden" name="runs" value="{{ $batting->runs - 1 }}"><button type="submit" class="btn btn-danger border">- Run 1</button>@method('PATCH')@csrf</form>
                            <form action="" method="post"><input type="hidden" name="runs" value="{{ $batting->runs - 2 }}"><button type="submit" class="btn btn-danger border">- Run 2</button>@method('PATCH')@csrf</form>
                            <form action="" method="post"><input type="hidden" name="runs" value="{{ $batting->runs - 3 }}"><button type="submit" class="btn btn-danger border">- Run 3</button>@method('PATCH')@csrf</form>
                            <form action="" method="post"><input type="hidden" name="runs" value="{{ $batting->runs - 4 }}"><button type="submit" class="btn btn-danger border">- Run 4</button>@method('PATCH')@csrf</form>
                            <form action="" method="post"><input type="hidden" name="runs" value="{{ $batting->runs - 6 }}"><button type="submit" class="btn btn-danger border">- Run 6</button>@method('PATCH')@csrf</form>
                          </div>                          
                          <div class="btn-group mr-2" role="group" aria-label="Second group">
                            <form action="" method="post"><input type="hidden" name="wickets" value="{{ $batting->wickets - 1 }}"><button type="submit" class="btn btn-danger border">- Wicket</button>@method('PATCH')@csrf</form>
                          </div>
                          <div class="btn-group mr-2" role="group" aria-label="Second group">
                            <form action="" method="post"><input type="hidden" name="innings" value="{{ $batting->innings - 1 }}"><button type="submit" class="btn btn-danger border">- Inning</button>@method('PATCH')@csrf</form>
                          </div>
                          <div class="btn-group" role="group" aria-label="Third group">
                            <form action="" method="post"><input type="hidden" name="wide_balls" value="{{ $batting->wide_balls - 1 }}"><button type="submit" class="btn btn-danger border">- Wide Ball</button>@method('PATCH')@csrf</form>
                            <form action="" method="post"><input type="hidden" name="no_balls" value="{{ $batting->no_balls - 1 }}"><button type="submit" class="btn btn-danger border">- No Ball (White)</button>@method('PATCH')@csrf</form>
                          </div>
                        </div>
                        <br>
                        
                        <form action="" method="post">
                          @method('PATCH')
                          @csrf
                          <div class="input-group mb-3 w-50" role="group" aria-label="Second group">
                            <input type="text" class="form-control" name="runs" value="{{ $batting->runs }}">
                            <div class="input-group-append">
                              <button type="submit" class="btn btn-info border">Update Runs</button>
                            </div>
                          </div>
                        </form>
                        
                        <br>
                        <table class="table">
                          <tr>
                            <th>Runs</th>
                            <th>6S</th>
                            <th>4S</th>
                            <th>Overs</th>
                            <th>Wickets</th>
                            <th>Innings</th>
                            <th>Balls</th>
                            <th>Wide Balls</th>
                            <th>No Balls (White)</th>
                            <th>Final Score</th>
                          </tr>
                          <tr>
                            <td>{{ $batting->runs }}</td>
                            <td>{{ $batting->n_6s }}</td>
                            <td>{{ $batting->n_4s }}</td>
                            <td><h5><span class="badge badge-info">{{ $batting->overs }}</span></h5></td>
                            <td><h5><span class="badge badge-info">{{ $batting->wickets }}</span></h5></td>
                            <td><h5><span class="badge badge-info">{{ $batting->innings }}</span></h5></td>
                            <td><h5><span class="badge badge-info">{{ $batting->balls }}</span></h5></td>
                            <td>{{ $batting->wide_balls }}</td>
                            <td>{{ $batting->no_balls }}</td>
                            <td><h4><span class="badge badge-success">{{ $batting->score }}</span></h4></td>
                          </tr>
                        </table>
                      </div>
                    </div>
                  </div>
                  <div class="card">
                    <div class="card-body">
                      <div class="card-header">
                        <table>
                          <tr>
                            <td><h3 class="card-title">Balling:</h3></td>
                            <td>&nbsp;<img width="25" src="{{ $balling->university->img_url }}" alt=""></td>
                            <td>&nbsp;{{ $balling->university->name }}</td>
                          </tr>
                        </table>
                      </div>
                      <div class="card-body">
                        <table class="table">
                          <tr>
                            <th>Runs</th>
                            <th>6S</th>
                            <th>4S</th>
                            <th>Overs</th>
                            <th>Wickets</th>
                            <th>Innings</th>
                            <th>Balls</th>
                            <th>Wide Balls</th>
                            <th>No Balls (White)</th>
                            <th>Final Score</th>
                          </tr>
                          <tr>
                            <td>{{ $balling->runs }}</td>
                            <td>{{ $balling->n_6s }}</td>
                            <td>{{ $balling->n_4s }}</td>
                            <td><h5><span class="badge badge-info">{{ $balling->overs }}</span></h5></td>
                            <td><h5><span class="badge badge-info">{{ $balling->wickets }}</span></h5></td>
                            <td><h5><span class="badge badge-info">{{ $balling->innings }}</span></h5></td>
                            <td><h5><span class="badge badge-info">{{ $balling->balls }}</span></h5></td>
                            <td>{{ $balling->wide_balls }}</td>
                            <td>{{ $balling->no_balls }}</td>
                            <td><h4><span class="badge badge-success">{{ $balling->score }}</span></h4></td>
                          </tr>
                        </table>
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


      </div><!-- /.container-fluid -->
    </section>

  </div>



@endsection
