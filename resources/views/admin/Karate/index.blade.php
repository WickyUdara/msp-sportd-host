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
                <h3 class="card-title">Karate Live Score Portal</h3>

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


                @if ($scores->get(0)->type == "none" || $scores->get(1)->type == "none" || $scores->get(0)->type != $scores->get(1)->type)
    
                  <h3 style="text-align: center;">Match Not Started Yet...</h3>
                  <div class="card">
                    <div class="card-body">
                      <form action="" method="POST">
                        @method('PATCH')
                        @csrf
                        <input type="hidden" name="start_match" value="" />
                        <label for="">Type:</label>
                        <select onchange="onChangeType(this.value)" class="form-control" name="type">
                          <option value="kata">Kata</option>
                          <option value="kumite">Kumite (Individual)</option>
                        </select>
                        <br>
                        <button class="btn btn-primary" type="submit">Start</button>
                      </form>
                    </div>
                  </div>
                @else
                  @if ($scores->get(0)->type == 'kata')
                    @include('admin.Karate.kata')
                  @elseif($scores->get(0)->type == 'kumite')
                  @include('admin.Karate.kumite')
                  @endif
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

