@props([
    'path',
    'name'
])
{{$errors}}

<form method="POST" action="{{route($path)}}" class="max-w-sm mx-auto">
    @csrf
    <div class="mb-5">
      <label for="name" class="input_box_label">{{ucfirst($name)}} Name</label>
      <input type="text" id="name" name="name" class="input_box" />
    </div>
    <button type="submit" class="btn_blue">Submit</button>
  </form>
