{{--@if($errors->any())--}}
{{--    <div class="alert alert-danger">--}}
{{--      @foreach($errors->all() as $error)--}}
{{--          <p>{{$error}}</p>--}}
{{--      @endforeach--}}
{{--    </div>--}}
{{--@endif--}}

@if($errors->any())
    @foreach($errors->getMessages() as $this_error)
        <p style="color: red;">{{$this_error[0]}}</p>
    @endforeach
@endif