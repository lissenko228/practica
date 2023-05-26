@if (Session::has('info'))
    <div class="alert alert-dark" role="alert">
        {{Session::get('info')}}
    </div>
    
@endif