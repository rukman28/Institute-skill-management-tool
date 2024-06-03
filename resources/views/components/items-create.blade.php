@props([
    'path',
    'name',
    'skillCategories'
])


<form method="POST" action="{{route($path)}}" class="max-w-sm mx-auto">
    @csrf
    <div class="mb-5">
        @if($errors->has('name'))
            <label for="name" class="block mb-2 text-sm font-medium text-red-700 dark:text-red-500">Name</label>
            <input type="text" id="name" name="name" class="bg-red-50 border border-red-500 text-red-900
            placeholder-red-700 text-sm rounded-lg focus:ring-red-500 dark:bg-gray-700 focus:border-red-500 block w-full p-2.5 dark:text-red-500 dark:placeholder-red-500 dark:border-red-500"
            value="{{old('name')}}">
            <p class="mt-2 text-sm text-red-600 dark:text-red-500"><span class="font-medium">Oops!</span> {{$errors->first('name')}}!</p>
        @else

            <label for="name" class="input_box_label">{{ucfirst($name)}} Name</label>
            <input type="text" id="name" name="name" value="{{old('name')}}" class="input_box" />

        @endif

    </div>

    @isset($skillCategories)

    <div>
        <select
          name="skillcategory"
          id="skillcategory"
          class="mt-1.5 w-full input_box rounded-lg border-gray-300 text-gray-700 sm:text-sm" >
            <option value="">Please select</option>
        @foreach ($skillCategories as $skillcategory )

                <option value="{{$skillcategory->id}}">{{$skillcategory->name}}</option>
        @endforeach
        </select>
      </div>
    @endisset

    <div class="pt-4">
        <button type="submit" class="btn_blue">Submit</button>

    </div>
  </form>
