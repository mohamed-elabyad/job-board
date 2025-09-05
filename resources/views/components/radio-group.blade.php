@props(['name', 'options', 'allOption' => false, 'value' => null])

@if ($allOption)
    <label for={{$name}} class="mb-1 flex items-center">
    <input type="radio" name="{{$name}}" value="" id={{$name}}
    @checked(! request($name))/>
    <span class="ml-2">All</span>
    </label>
@endif

@foreach ($options as $option)
    <label for="{{$option}}" class="mb-1 flex items-center">
    <input type="radio" name="{{$name}}" value="{{$option}}" id="{{$option}}"
    @checked($option === ($value ?? request($name)))/>
    <span class="ml-2">{{Str::ucfirst($option)}}</span>
</label>
@endforeach
<div>
    @error($name)
        <div class="mt-1 text-xs text-red-500">
            {{$message}}
        </div>
    @enderror
</div>
