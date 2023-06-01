@extends('templates/default')

@section('container')
<div class="row">
    <div class="col-lg-6">
        <form action="{{route('status.post')}}" method="post">
            @csrf
            <div class="form-group mb-2">
                <textarea class="form-control {{$errors->has('status') ?' is-invalid' : ''}}" name="status" placeholder="Что нового" rows="3"></textarea>

                @if ($errors->has('status'))

                <span class="help-block text-danger">
                    {{ $errors->first('status')}}
                </span>

                @endif

            </div>
            <button type="submit" class="btn btn-dark">Опубликовать</button>
        </form>
    </div>
</div>
<div class="row">
    <div class="col-lg-6"><hr>

        @if (!$statuses->count())

            <p>Пока нет ни одной записи на стене :(</p>

        @else
            @foreach ($statuses as $status)
                <div id="statuses">
                    <div class="media" id="media">
                        <div class="line-media-body">
                            <a class="me-3" href="{{route('profile.index', ['username' => $status->user->username])}}">
                                <img class="media-object rounded" src="{{$status->user->getAvatarUrl()}}" alt="{{$status->user->getNameOrUsername()}}">
                            </a>
                            <h4>
                                <a href="{{route('profile.index', ['username' => $status->user->username])}}">{{$status->user->getNameOrUsername()}}</a>
                            </h4>
                        </div>
                        <div class="media-body ms-5">
                            <p>{{$status->body}}</p>
                            <ul class="list-inline">
                                <li class="list-inline-item">{{$status->created_at->diffForHumans()}}</li>
                                @if ($status->user->id!==Auth::user()->id)
                                    
                                <li class="list-inline-item">
                                    <a href="{{route('status.like', ['statusId' => $status->id])}}">Лaйк</a>
                                </li>
                                    
                                @endif

                                <li class="list-inline-item">
                                    {{$status->likes->count()}} {{Str::plural('like', $status->likes->count())}}
                                </li>

                                @if ($status->user->id==Auth::user()->id)
                                    
                                <li class="list-inline-item">
                                    <a class="btn btn-dark btn-sm" href="{{route('status.delete', ['statusId' => $status->id])}}">Удалить</a>
                                </li>
                                    
                                @endif
                            </ul>
            
                            @foreach ($status->replies as $reply)
                            
                            <div class="media">
                                <div class="line-media-body">
                                    <a class="me-3" href="{{route('profile.index', ['username' => $reply->user->username])}}">
                                        <img class="media-object rounded" src="{{$reply->user->getAvatarUrl()}}" alt="{{$reply->user->getNameOrUsername()}}">
                                    </a>
                                    <h4>
                                        <a href="{{route('profile.index', ['username' => $reply->user->username])}}">{{$reply->user->getNameOrUsername()}}</a>
                                    </h4>
                                </div>
                                <div class="media-body">
                                    <p>{{$reply->body}}</p>
                                    <ul class="list-inline">
                                        <li class="list-inline-item">{{$reply->created_at->diffForHumans()}}</li>
                                    @if ($reply->user->id!==Auth::user()->id)
                                    
                                    <li class="list-inline-item">
                                        <a href="{{route('status.like', ['statusId' => $reply->id])}}">Лaйк</a>
                                    </li>
                
                                    @endif

                                    <li class="list-inline-item">
                                        {{$reply->likes->count()}} {{Str::plural('like', $reply->likes->count())}}
                                    </li>
                                    
                                    @if ($reply->user->id==Auth::user()->id)
                                    
                                    <li class="list-inline-item">
                                        <a class="btn btn-dark btn-sm" href="{{route('status.delete', ['statusId' => $reply->id])}}">Удалить</a>
                                    </li>
                                    
                                @endif
                                    </ul>
                                </div>
                            </div>
                </div>
      
                @endforeach

                <form method="POST" action="{{route('status.reply', ['statusId' => $status->id])}}" class="mb-4">
                @csrf
                    <div class="form-group mb-2">
                        <textarea name="reply-{{$status->id}}" class="form-control {{$errors->has("reply-{$status->id}") ?' is-invalid' : ''}}" placeholder="Прокомментировать" rows="3"></textarea>

                        @if ($errors->has("reply-{$status->id}"))

                        <span class="help-block text-danger">
                            {{ $errors->first("reply-{$status->id}")}}
                        </span>

                        @endif

                    </div>
                    <input type="submit" class="btn btn-dark btn-sm" value="Oтветить">
                </form>
            </div>
        </div>
            @endforeach

            {{-- {{$statuses->links()}} --}}
            <div id="show-more">
                <button id="show" type="button" class="btn btn-dark mb-5">Показать все</button>
            </div>
            
        @endif

    </div>
</div>

@endsection
{{-- аякс --}}
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.0/jquery.min.js"></script>

<script type='text/javascript'>
    var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
    $(document).ready(function() 
    {
        $('#show').click(function(e) 
        {
            $.ajax(
            {
                method: "GET",
                url: "/showmore",
                dataType: "json",

                success: function(response) 
                {
                    showmore(response);
                    console.log(response);
                },
                error: function(er) 
                {
                    console.log(er);
                }
            });
        });
    });

        function showmore(response)
        {
            var len = 0;
            // $('#statuses').empty();

            if(response['data'] != null)
            {
                len = response['data'].length;
            }

            if(len > 0)
            {
                for(var i=0; i<len; i++)
                {
                var user_id = response['data'][i].user_id;
                var parent_id = response['data'][i].parent_id;
                var body = response['data'][i].body;
                var created_at = response['data'][i].created_at;

                // var status = "<div>привет</div>";

                var status = "<div class=media id=media>"+
                                "<div class=line-media-body>"+
                                    "<a class=me-3 href=http://mysite.loc/user/pupa>"+
                                        "<img class=media-object rounded src=https://www.gravatar.com/avatar/13d12c8c7125d25f7f0434e56522191a?d=mp&amp;s=50 alt=pupa>"+
                                    "</a>"+
                                    "<h4>"+
                                        "<a href=http://mysite.loc/user/pupa>pupa</a>"
                                    "</h4>"
                                "</div>"
                                "<div class=media-body ms-5>"
                                    "<p>я пупа всем привет</p>"+
                                    "<ul class=list-inline>"+
                                        "<li class=list-inline-item>1 hour ago</li>"+
                                                                
                                            "<li class=list-inline-item>"+
                                                "<a href=http://mysite.loc/status/9/like>Лaйк</a>"+
                                            "</li>"+
                                            
                                                            "<li class=list-inline-item>"+
                                            "0 likes"+
                                        "</li>"+
                                                        "</ul>"+

                                    
                                    "<form method=POST action=http://mysite.loc/status/9/reply class=mb-4>"+
                                    "<input type=hidden name=_token value=483ZCPYyEeAprFz2xcz8VHUhGVdsZwRj3KKOeYq8>"+                    "<div class=form-group mb-2>"+
                                            "<textarea name=reply-9 class=form-control  placeholder=Прокомментировать rows=3></textarea>"+

                                            
                                        "</div>"+
                                        "<input type=submit class=btn btn-dark btn-sm value=Oтветить>"+
                                    "</form>"+
                                "</div>"+
                            "</div>";

                $("#statuses").append(status);
                }
            }
            else
            {
                var status = "пошел нафик ошибка";

                $("#statuses").append(status);
            }
        }
        
</script>