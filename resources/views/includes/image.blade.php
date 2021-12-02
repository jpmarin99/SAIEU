
<div class="card">
    <div class="card-header">
        <div class="col-md-12">
            <div class="row">
                @if($image->user->image)
                    <div class="col-md-2">
                        <img src="{{$image->user->image }}" alt="" class="col-md-12 mx-auto rounded-circle" style="max-width:60px;">
                    </div>
                @endif
                <div class="col-md-10">
                    <a href="{{action('UserController@profile',['id' => $image->user_id])}}"> {{$image->user->name}} </a>
                    <span style="color: #cca;">

                    </span>
                </div>
            </div>
        </div>
    </div>
    <div class="main_image">
        <div class="card-body">
            <a href="{{action('ImageController@show',['id' => $image->id])}}"><img src="{{$image->image}}" alt="" class="col-md-12"></a>
            <br>
            <br>
            <div class="col-md-12">
                <div class="row">
                    <div class="col-md-10"><span style="color:#A0ADC2;">{{'@'.$image->user->name}}</span><br></div>
                    <div class="col-md-2 float-right">
                        @php
                            $is_liked = false
                        @endphp
                        @foreach ($image->likes as $like)
                            @if($like->user_id == Auth::user()->user_id)
                                @php
                                    $is_liked = true
                                @endphp
                            @else
                                @php
                                    $is_liked = false
                                @endphp
                            @endif
                        @endforeach

                        @if($is_liked == true)
                            <img   class="like" src="{{asset('images/like.png')}}" data-id="{{$image->id}}" alt="" style="max-width: 20px">
                        @else
                            <img class="dislike" src="{{asset('images/unlike.png')}}" data-id="{{$image->id}}" alt="" style="max-width: 20px">
                        @endif
                        <span  id="contador" data-value="({{count($image->likes)}})" style="color:#A0ADC2;" > ({{count($image->likes)}}) </span>

                    </div>

                </div>

                <p>{{$image->body}}</p>
                <div class="col-md-12">
                    <p style="color:#949393; font-size: 14px;" class="float-right"> Creado el: {{$image->created_at}}</p>
                    <br>
                </div>
                <br><br>
                <div class="col-md-12">
                    <a href="{{action('ImageController@show',['id' => $image->id])}}" class="btn btn-primary col-md-12 float-center">Comentarios ({{count($image->comments)}})</a>
                </div>
                <br>
            </div>


        </div>
    </div>


    {{-- <img src="{{url('user.image',['filename' => Auth::user()->image])}}" alt="" class="col-md-12" > --}}

</div>
<br>
