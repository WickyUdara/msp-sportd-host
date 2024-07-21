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
                <h3 class="card-title">Sports</h3>

                <div class="card-tools">

                  <div class="input-group-append">
                    <button type="submit" class="btn btn-default" onclick="openModel()">
                      Add New Sport
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
                      <th>Edit</th>
                      <th>Delete</th>
                    </tr>
                  </thead>
                  <tbody>
                   @foreach ($sports as $sport)
                   <tr>
                      <td id="{{ $sport->sport_id }}_name">{{ $sport->name }}</td>
                      <td><button class="btn btn-primary" onclick="openModel({{ $sport->sport_id }}, true)">Edit</button></form></td>
                      <td>
                        <form action="{{ route('sports.destroy', $sport->sport_id) }}" method="POST" style="display:inline-block;">
                          @csrf
                          @method('DELETE')
                          <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure?')">Delete</button>
                      </form>
                    </td>                   </tr>
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
                <h5 class="modal-title" id="addEventModalLabel">Add New Sport</h5>
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
                       <input required type="text" class="form-control" name="name" id=m_name>
                      </div>

                    <div class="card-footer">
                    <button type="submit" class="btn btn-primary">Submit</button>
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
        document.getElementById('addEventModalLabel').innerHTML = 'Add New Sport'
        $('#edit_up_form').attr('action', '')
        $('#m_name').val('')
        $('#addEventModal').modal()
      }
    }
</script>
@endsection
