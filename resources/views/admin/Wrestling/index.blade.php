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
              <h3 class="card-title">Wrestling Live Score Portal</h3>
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
                    <th>Score</th>
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
                          <form action="{{ route('updateScore.wrestling') }}" method="POST" style="display: inline;">
                            @csrf
                            <input type="hidden" name="score_id" value="{{ $score->score_id }}">
                            <input type="hidden" name="field" value="score">
                            <input type="hidden" name="increment" value="-1">
                            <button class="btn btn-sm btn-danger" type="submit">-</button>
                          </form>
                          <span id="{{ $score->score_id }}_score">{{ $score->score ?? "--" }}</span>
                          <form action="{{ route('updateScore.wrestling') }}" method="POST" style="display: inline;">
                            @csrf
                            <input type="hidden" name="score_id" value="{{ $score->score_id }}">
                            <input type="hidden" name="field" value="score">
                            <input type="hidden" name="increment" value="1">
                            <button class="btn btn-sm btn-success" type="submit">+</button>
                          </form>
                        </div>
                      </td>
                    </tr>
                  @endforeach
                </tbody>
              </table>

              <!-- Period Controls -->
              <div class="period-controls text-center mt-4">
                <h4>Current Period:</h4>
                <div class="d-inline-block">
                  <form action="{{ route('updatePeriod.wrestling') }}" method="POST" style="display: inline;">
                    @csrf
                    <input type="hidden" name="event_id" value="{{ $event->event_id }}">
                    <input type="hidden" name="increment" value="-1">
                    <button class="btn btn-sm btn-danger" type="submit">-</button>
                  </form>
                  <span class="mx-2">{{ $scores->first()->period ?? 0 }}</span>
                  <form action="{{ route('updatePeriod.wrestling') }}" method="POST" style="display: inline;">
                    @csrf
                    <input type="hidden" name="event_id" value="{{ $event->event_id }}">
                    <input type="hidden" name="increment" value="1">
                    <button class="btn btn-sm btn-success" type="submit">+</button>
                  </form>
                </div>
              </div>
              <!-- End of Period Controls -->

              <!-- Delete Event Button -->
              <div>
                  <form action="{{ route('destroy.wrestling', $event->event_id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete all records for this event?');">
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

@endsection

<!-- Add jQuery to enable AJAX -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function () {
        // AJAX for updating scores
        $('.score-control form').on('submit', function (e) {
            e.preventDefault();
            var form = $(this);
            $.ajax({
                type: form.attr('method'),
                url: form.attr('action'),
                data: form.serialize(),
                success: function (response) {
                    if (response.success) {
                    var scoreId = form.find('input[name="score_id"]').val();
                    var field = form.find('input[name="field"]').val();
                    $('#' + scoreId + '_' + field).text(response.newScore);
                    } else {
                    alert(response.message);
                    }
                },
                error: function (response) {
                    alert('Error updating score');
                }
            });
        });
  
        // AJAX for updating periods
        $('.period-controls form').on('submit', function (e) {
            e.preventDefault();
            var form = $(this);
            $.ajax({
                type: form.attr('method'),
                url: form.attr('action'),
                data: form.serialize(),
                success: function (response) {
                    if (response.success) {
                    $('.period-controls span').text(response.newPeriod);
                    } else {
                    alert(response.message);
                    }
                },
                error: function (response) {
                    alert('Error updating period');
                }
            });
        });
    });
</script>
  
