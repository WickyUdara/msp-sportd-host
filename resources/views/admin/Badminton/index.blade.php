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
                                <h3 class="card-title">Badminton Live Score Portal</h3>

                                <div class="card-tools">

                                    <div class="input-group-append">
                                        <button type="submit" class="btn btn-default" data-toggle="modal"
                                            data-target="#modal-add-edit" onclick="openModel()">
                                            <a href="{{ route('index.events') }}">Go back To events</a>
                                        </button>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col">

                        <!-- form 1 -->
                        <div class="card card" style="font-family: 'Courier New', Courier, monospace; font-style:bold">


                            <div class="card-body">
                                <table>
                                    <tr>
                                        <td><img src="{{ $uni_1->img_url }}" alt="" width="40px">&nbsp; &nbsp;
                                        </td>
                                        <td>
                                            <h1 class="card-title"> <b>{{ $uni_1->name }}</b> </h1>
                                        </td>
                                    </tr>
                                </table>

                                <div class="row align-items-center justify-content-center" style="margin-top: 10px">

                                    <table class="table table-bordered">
                                        <thead>
                                            <th>Set</th>
                                            <th>Score</th>
                                        </thead>
                                        <tr>
                                            <td>Set 1</td>
                                            <td>
                                                <div class="row">
                                                    <div class="col">
                                                        <div class="card-body">
                                                            <form action="" method="post">
                                                                @method('PATCH')
                                                                @csrf
                                                                <input type="hidden" name="id"
                                                                    value="{{ $scores[0]['score_id'] }}">
                                                                <input type="hidden" name="set1_marks"
                                                                    value="{{ $scores[0]['set1_marks'] - 1 }}">
                                                                <button type="submit"
                                                                    class="btn btn-primary btn-lg">-</button>
                                                            </form>
                                                        </div>
                                                    </div>
                                                    <div class="col">
                                                        <div class="card-body">
                                                            <div class="form-group">
                                                                <label

                                                                    for="c_set_score_1">{{ $scores[0]['set1_marks'] ==-1 ? 'Not Started' : ($scores[0]['set1_marks']) }}</label>

                                                            </div>

                                                        </div>
                                                    </div>
                                                    <div class="col">
                                                        <div class="card-body">
                                                            <form action="" method="post">
                                                                @method('PATCH')
                                                                @csrf
                                                                <input type="hidden" name="id"
                                                                    value="{{ $scores[0]['score_id'] }}">
                                                                <input type="hidden" name="set1_marks"
                                                                    value="{{ $scores[0]['set1_marks'] + 1 }}">
                                                                <button type="submit"
                                                                    class="btn btn-primary btn-lg">+</button>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Set 2</td>
                                            <td>
                                                <div class="row">
                                                    <div class="col">
                                                        <div class="card-body">
                                                            <form action="" method="post">
                                                                @method('PATCH')
                                                                @csrf
                                                                <input type="hidden" name="id"
                                                                    value="{{ $scores[0]['score_id'] }}">
                                                                <input type="hidden" name="set2_marks"
                                                                    value="{{ $scores[0]['set2_marks'] - 1 }}">
                                                                <button type="submit"
                                                                    class="btn btn-primary btn-lg">-</button>
                                                            </form>
                                                        </div>
                                                    </div>
                                                    <div class="col">
                                                        <div class="card-body">
                                                            <div class="form-group">
                                                                <label

                                                                    for="c_set_score_2">{{ $scores[0]['set2_marks'] ==-1 ? 'Not Started' : ($scores[0]['set2_marks']) }}</label>

                                                           </div>

                                                        </div>
                                                    </div>
                                                    <div class="col">
                                                        <div class="card-body">
                                                            <form action="" method="post">
                                                                @method('PATCH')
                                                                @csrf
                                                                <input type="hidden" name="id"
                                                                    value="{{ $scores[0]['score_id'] }}">
                                                                <input type="hidden" name="set2_marks"
                                                                    value="{{ $scores[0]['set2_marks'] + 1 }}">
                                                                <button type="submit"
                                                                    class="btn btn-primary btn-lg">+</button>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Set 3</td>
                                            <td>
                                                <div class="row">
                                                    <div class="col">
                                                        <div class="card-body">
                                                            <form action="" method="post">
                                                                @method('PATCH')
                                                                @csrf
                                                                <input type="hidden" name="id"
                                                                    value="{{ $scores[0]['score_id'] }}">
                                                                <input type="hidden" name="set3_marks"
                                                                    value="{{ $scores[0]['set3_marks'] - 1 }}">
                                                                <button type="submit"
                                                                    class="btn btn-primary btn-lg">-</button>
                                                            </form>
                                                        </div>
                                                    </div>
                                                    <div class="col">
                                                        <div class="card-body">
                                                            <div class="form-group">
                                                                <label

                                                                    for="c_set_score_3">{{ $scores[0]['set3_marks'] ==-1 ? 'Not Started' : ($scores[0]['set3_marks']) }}</label>

                                                            </div>

                                                        </div>
                                                    </div>
                                                    <div class="col">
                                                        <div class="card-body">
                                                            <form action="" method="post">
                                                                @method('PATCH')
                                                                @csrf
                                                                <input type="hidden" name="id"
                                                                    value="{{ $scores[0]['score_id'] }}">
                                                                <input type="hidden" name="set3_marks"
                                                                    value="{{ $scores[0]['set3_marks'] + 1 }}">
                                                                <button type="submit"
                                                                    class="btn btn-primary btn-lg">+</button>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- /.form -->
                    <div class="col">
                        <!-- form 2 -->
                        <div class="card">



                            <div class="card-body">
                                <table>
                                    <tr>
                                        <td><img src="{{ $uni_2->img_url }}" alt="" width="40px">&nbsp; &nbsp;
                                            &nbsp;</td>
                                        <td>
                                            <h1 class="card-title"> <b>{{ $uni_2->name }}</b></h1>
                                        </td>
                                    </tr>
                                </table>

                                <div class="row align-items-center justify-content-center" style="margin-top: 10px">

                                    <table class="table table-bordered">
                                        <thead>
                                            <th>Set</th>
                                            <th>Score</th>
                                        </thead>
                                        <tr>
                                            <td>Set 1</td>
                                            <td>
                                                <div class="row">
                                                    <div class="col">
                                                        <div class="card-body">
                                                            <form action="" method="post">
                                                                @method('PATCH')
                                                                @csrf
                                                                <input type="hidden" name="id"
                                                                    value="{{ $scores[1]['score_id'] }}">
                                                                <input type="hidden" name="set1_marks"
                                                                    value="{{ $scores[1]['set1_marks'] - 1 }}">
                                                                <button type="submit"
                                                                    class="btn btn-primary btn-lg">-</button>
                                                            </form>
                                                        </div>
                                                    </div>
                                                    <div class="col">
                                                        <div class="card-body">
                                                            <div class="form-group">
                                                                <label

                                                                    for="c_set_score_1">{{ $scores[1]['set1_marks'] ==-1 ? 'Not Started' : ($scores[1]['set1_marks']) }}</label>

                                                            </div>

                                                        </div>
                                                    </div>
                                                    <div class="col">
                                                        <div class="card-body">
                                                            <form action="" method="post">
                                                                @method('PATCH')
                                                                @csrf
                                                                <input type="hidden" name="id"
                                                                    value="{{ $scores[1]['score_id'] }}">
                                                                <input type="hidden" name="set1_marks"
                                                                    value="{{ $scores[1]['set1_marks'] + 1 }}">
                                                                <button type="submit"
                                                                    class="btn btn-primary btn-lg">+</button>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Set 2</td>
                                            <td>
                                                <div class="row">
                                                    <div class="col">
                                                        <div class="card-body">
                                                            <form action="" method="post">
                                                                @method('PATCH')
                                                                @csrf
                                                                <input type="hidden" name="id"
                                                                    value="{{ $scores[1]['score_id'] }}">
                                                                <input type="hidden" name="set2_marks"
                                                                    value="{{ $scores[1]['set2_marks'] - 1 }}">
                                                                <button type="submit"
                                                                    class="btn btn-primary btn-lg">-</button>
                                                            </form>
                                                        </div>
                                                    </div>
                                                    <div class="col">
                                                        <div class="card-body">
                                                            <div class="form-group">
                                                                <label

                                                                    for="c_set_score_1">{{ $scores[1]['set2_marks'] ==-1 ? 'Not Started' : ($scores[1]['set2_marks']) }}</label>

                                                            </div>

                                                        </div>
                                                    </div>
                                                    <div class="col">
                                                        <div class="card-body">
                                                            <form action="" method="post">
                                                                @method('PATCH')
                                                                @csrf
                                                                <input type="hidden" name="id"
                                                                    value="{{ $scores[1]['score_id'] }}">
                                                                <input type="hidden" name="set2_marks"
                                                                    value="{{ $scores[1]['set2_marks'] + 1 }}">
                                                                <button type="submit"
                                                                    class="btn btn-primary btn-lg">+</button>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Set 3</td>
                                            <td>
                                                <div class="row">
                                                    <div class="col">
                                                        <div class="card-body">
                                                            <form action="" method="post">
                                                                @method('PATCH')
                                                                @csrf
                                                                <input type="hidden" name="id"
                                                                    value="{{ $scores[1]['score_id'] }}">
                                                                <input type="hidden" name="set3_marks"
                                                                    value="{{ $scores[1]['set3_marks'] - 1 }}">
                                                                <button type="submit"
                                                                    class="btn btn-primary btn-lg">-</button>
                                                            </form>
                                                        </div>
                                                    </div>
                                                    <div class="col">
                                                        <div class="card-body">
                                                            <div class="form-group">

                                                                <label for="c_set_score_1">{{ $scores[1]['set3_marks'] ==-1 ? 'Not Started' : ($scores[1]['set3_marks']) }}</label>

                                                            </div>

                                                        </div>
                                                    </div>
                                                    <div class="col">
                                                        <div class="card-body">
                                                            <form action="" method="post">
                                                                @method('PATCH')
                                                                @csrf
                                                                <input type="hidden" name="id"
                                                                    value="{{ $scores[1]['score_id'] }}">
                                                                <input type="hidden" name="set3_marks"
                                                                    value="{{ $scores[1]['set3_marks'] + 1 }}">
                                                                <button type="submit"
                                                                    class="btn btn-primary btn-lg">+</button>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- /.form -->
                </div>
                <div class="row justify-content-center">
                    <div class="card">
                        <table class="table">
                            <thead>
                                <th>University</th>
                                <th>Sets Won</th>
                            </thead>
                            <tr>
                                <td>
                                    <table class="table">
                                        <tr>
                                            <td><img src="{{ $uni_1->img_url }}" alt="" width="40px">&nbsp;
                                                &nbsp;</td>
                                            <td>
                                                <h1 class="card-title"> <b>{{ $uni_1->name }}</b> </h1>
                                            </td>
                                        </tr>
                                    </table>
                                </td>
                                <td>
                                    <div class="row">
                                        <div class="col">
                                            <div class="card-body">
                                                <form action="" method="post">
                                                    @method('PATCH')
                                                    @csrf
                                                    <input type="hidden" name="id"
                                                        value="{{ $scores[0]['score_id'] }}">
                                                    <input type="hidden" name="sets_won"
                                                        value="{{ $scores[0]['sets_won'] - 1 }}">
                                                    <button type="submit" class="btn btn-primary btn-lg">-</button>
                                                </form>
                                            </div>
                                        </div>
                                        <div class="col">
                                            <div class="card-body">
                                                <div class="form-group">
                                                    <label for="sets_won">{{ $scores[0]['sets_won'] }}</label>
                                                </div>

                                            </div>
                                        </div>
                                        <div class="col">
                                            <div class="card-body">
                                                <form action="" method="post">
                                                    @method('PATCH')
                                                    @csrf
                                                    <input type="hidden" name="id"
                                                        value="{{ $scores[0]['score_id'] }}">
                                                    <input type="hidden" name="sets_won"
                                                        value="{{ $scores[0]['sets_won'] + 1 }}">
                                                    <button type="submit" class="btn btn-primary btn-lg">+</button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <table>
                                        <tr>
                                            <td><img src="{{ $uni_2->img_url }}" alt="" width="40px">&nbsp;
                                                &nbsp;</td>
                                            <td>
                                                <h1 class="card-title"> <b>{{ $uni_2->name }}</b> </h1>
                                            </td>
                                        </tr>
                                    </table>
                                </td>
                                <td>
                                    <div class="row">
                                        <div class="col">
                                            <div class="card-body">
                                                <form action="" method="post">
                                                    @method('PATCH')
                                                    @csrf
                                                    <input type="hidden" name="id"
                                                        value="{{ $scores[1]['score_id'] }}">
                                                    <input type="hidden" name="sets_won"
                                                        value="{{ $scores[1]['sets_won'] - 1 }}">
                                                    <button type="submit" class="btn btn-primary btn-lg">-</button>
                                                </form>
                                            </div>
                                        </div>
                                        <div class="col">
                                            <div class="card-body">
                                                <div class="form-group">
                                                    <label for="sets_won">{{ $scores[1]['sets_won'] }}</label>
                                                </div>

                                            </div>
                                        </div>
                                        <div class="col">
                                            <div class="card-body">
                                                <form action="" method="post">
                                                    @method('PATCH')
                                                    @csrf
                                                    <input type="hidden" name="id"
                                                        value="{{ $scores[1]['score_id'] }}">
                                                    <input type="hidden" name="sets_won"
                                                        value="{{ $scores[1]['sets_won'] + 1 }}">
                                                    <button type="submit" class="btn btn-primary btn-lg">+</button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
    </div>


    </div><!-- /.container-fluid -->
    </section>

    </div>
@endsection
