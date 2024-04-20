@props([
    'path',
    'name',
    'skillCategories'
])
{{$errors}}

<form method="POST" action="{{route($path)}}" class="max-w-sm mx-auto">
    @csrf
    <div class="mb-5">
      <label for="name" class="input_box_label">{{ucfirst($name)}} Name</label>
      <input type="text" id="name" name="name" class="input_box" />
    </div>

    @isset($skillCategories)

    <div>
        <select
          name="skillcategory"
          id="skillcategory"
          class="mt-1.5 w-full input_box rounded-lg border-gray-300 text-gray-700 sm:text-sm"
        >
          <option value="">Please select</option>
          @forelse ($skillCategories as $skillcategory )

          <option value="{{$skillcategory->id}}">{{$skillcategory->name}}</option>

          @empty
            There is no Skill Categories to select..!
          @endforelse
        </select>
      </div>
    @endisset
    <button type="submit" class="btn_blue">Submit</button>
  </form>
