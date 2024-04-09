@auth('sysadmin')
<form method="POST" action="{{isset($institute) ? route('sysadmin.institutes.update',$institute) : route('sysadmin.institutes.store')}}" class="max-w-sm mx-auto">

@elseif ('institute')
<form method="POST" action="{{isset($institute) ? route('institutes.update',$institute) : route('institutes.store')}}" class="max-w-sm mx-auto">

@endauth

    @csrf
    @isset($institute)

    @method('PUT')
    @endisset

    <div class="mb-5">
      <label for="name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Name</label>
      <input type="text" id="name" name="name"
      @isset($institute)
      value="{{$institute->name}}" readonly
      @endisset
        class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 dark:shadow-sm-light" required />
    </div> <div class="mb-5">
      <label for="email" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Email</label>
      <input type="email" id="email" name="email"
      @isset($institute)
      value="{{$institute->email}}"
      @endisset
      class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 dark:shadow-sm-light" required />
    </div>
    </div> <div class="mb-5">
      <label for="text" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Address</label>
      <input type="text" id="text" name="address"
      @isset($institute)
      value="{{$institute->address}}"
      @endisset
      class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 dark:shadow-sm-light" required />
    </div>

    @empty($institute)

        </div> <div class="mb-5">
        <label for="password" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Password</label>
        <input type="password" id="password" name="password" placeholder="Enter new password"
        class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 dark:shadow-sm-light" required />
        </div>
        </div> <div class="mb-5">
        <label for="password_confirmation" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Password</label>
        <input type="password" id="password_confirmation" name="password_confirmation" placeholder="Password confirmation"
        class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 dark:shadow-sm-light" required />
        </div>
    @endempty
    <button type="submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800 ">
      {{isset($institute) ? 'Update' : 'Add'}}</button>
      @isset($institute)
            @auth('sysadmin')
            <a href="{{route('sysadmin.institutes.password_change_create',$institute)}}" class="btn_red">Password</a>
            @elseif('institute')
            <a href="{{route('institutes.password_change_create',$institute)}}" class="btn_red">Password</a>
            @endauth
      @endisset
      @isset($institute)
            @auth('sysadmin')
            <a href="{{route('sysadmin.institutes.email_change_create',$institute)}}" class="btn_yellow">Email</a>

            @elseif ('institute')
            <a href="{{route('institutes.email_change_create',$institute)}}" class="btn_yellow">Email</a>

            @endauth
      @endisset
  </form>
