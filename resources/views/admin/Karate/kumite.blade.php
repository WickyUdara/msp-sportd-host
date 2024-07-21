<div class="card">
  <div class="card-body">
    <div class="card-header">
      <h5>Weight Class</h5>
    </div>
    <br>
    <form action="" method="post">
      @method('PATCH')
      @csrf
      <div class="input-group mb-3 w-50" role="group" aria-label="Second group">
        <input type="hidden" name="update_weight_class" value="">
        <input type="text" class="form-control" name="weight_class" value="{{ $scores->get(0)->weight_class }}">
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