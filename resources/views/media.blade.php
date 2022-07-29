{{-- string --}}
@foreach ($cars as $key=>$car)
<p>{{ $loop -> index+1}}.{{ $car }}</p>
@endforeach
