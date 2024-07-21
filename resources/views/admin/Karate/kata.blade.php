@section('head')
  <link rel="stylesheet" href="{{ asset('karate/index.css') }}">
@endsection

<a href="{{ route('index.events') }}" class="goback-btn">Go Back</a>
<h1>Karate (Kata) Score Form</h1>
<div class="p-2">
  <div class="top">
  @foreach($scores as $score)
  <div class="top-left">
      <img class="team-image" src="{{ asset($score->university_img) }}" alt="{{ $score->university_name }}" class="team-image"> 
      <h2>Score related to the team name :{{$score->university_name}}</h2>
      <form action="" method="POST">
          @csrf
          @method('PUT')
          <input type="hidden" name="score_id" value="{{ $score->score_id }}">
          <input type="hidden" name="event_id" value="{{ $event->event_id }}">
          <input type="number" name="score" placeholder="Enter Score" required>
          <h2>Enter Weight class for Event name: {{$event->name}}</h2>
          <input type="number" name="weight_class" placeholder="Enter Weight class" required>
          <button type="submit">Submit</button>
      </form>
  </div>
  @endforeach
  </div>
  <div class="bottom">
    <h2>Score related to this Event name: {{$event->name}}</h2>
    <table>
    <thead>
        <tr>
          <th>Score ID</th>
          <th>Event ID</th>
          <th>University ID</th>
          <th>Weightclass</th>
          <th>Score</th>
          <th>Points</th>
        </tr>
      </thead>
      <tbody>
        @foreach($scores as $score)
          <tr>
            <td>{{ $score->score_id }}</td>
            <td>{{ $score->event_id }}</td>
            <td>{{$score->university_name}}</td>
            <td>{{ $score->weight_class }}</td>
            <td>{{ $score->score }}</td>
            <td>{{ $score->points }}</td>
          </tr>
        @endforeach
      </tbody>
    </table>
    <b><small>*For a particular Event ID make sure to have the same Weightclass value for both Score IDs</small></b>
  </div >
</div>