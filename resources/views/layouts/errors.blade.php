@if(count($errors))
  <div class="card">
    <div class="">
      <ul>
        @foreach ($errors->all() as $error)
          <li>{{$error}}</li>
        @endforeach
      </ul>
    </div>
  </div>
@endif
