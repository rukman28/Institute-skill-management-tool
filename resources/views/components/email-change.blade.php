
@auth('sysadmin')
<form method="POST" action="{{route('sysadmin.institutes.email_change',$institute)}}" class="max-w-sm mx-auto">

@elseif ('institute')
<form method="POST" action="{{route('institutes.email_change',$institute)}}" class="max-w-sm mx-auto">

@endauth

    @csrf
    @method('PUT')

    <div class="mb-5">
    @if($errors->has('email'))

        <label for="email" class="block mb-2 text-sm font-medium text-red-700 dark:text-red-500">Your New email</label>
        <input type="email" id="email" name="email" class="bg-red-50 border border-red-500 text-red-900 placeholder-red-700 text-sm rounded-lg focus:ring-red-500
        dark:bg-gray-700 focus:border-red-500 block w-full p-2.5 dark:text-red-500 dark:placeholder-red-500 dark:border-red-500"
       required value="{{old('email')}}">
        <p class="mt-2 text-sm text-red-600 dark:text-red-500"><span class="font-medium">Oops!</span> {{$errors->first('email')}}!</p>

      @else

        <label for="email" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Your New email</label>
        <input type="email" name="email" id="email" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 dark:shadow-sm-light" placeholder="name@example.com" required />

      @endif
    </div>
    <button type="submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Update</button>
  </form>
