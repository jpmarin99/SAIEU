<div class="col-md-12">
    @if(Auth::user()->image)
        <img src="{{ Auth::user()->image}}" alt="" class="col-md-12 rounded-circle" >
    @else
        @php
            echo "+"
        @endphp
    @endif
</div>
