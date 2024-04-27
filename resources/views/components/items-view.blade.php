
@props([
    'items',
    'pathDelete',
    'pathCreate',
    'button1_path',
    'button2_path',
    'button1_name',
    'button2_name'

])

<div class="relative overflow-x-auto shadow-md sm:rounded-lg">
    <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
            <tr>
                <th scope="col" class="px-6 py-3">
                    Name
                </th>
                <th scope="col" class="px-6 py-3 flex justify-center items-center">
                    Action
                </th>
            </tr>
        </thead>
        <tbody>

            @forelse ($items as $item )

            <tr class="odd:bg-white odd:dark:bg-gray-900 even:bg-gray-50 even:dark:bg-gray-800 border-b dark:border-gray-700">
                <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                   {{$item->name}}
                </th>
                <td class="px-6 py-4 flex justify-center items-center">
                    @isset($button1_name)
                    <a href="{{route($button1_path,$item)}}" class="btn_blue">{{$button1_name}}</a>
                    @endisset
                    @isset($button2_name)
                    <a href="{{route($button2_path,$item)}}" class="btn_green">{{$button2_name}}</a>
                    @endisset

                    @isset($pathDelete)

                    <form method="POST" action="{{route($pathDelete,$item)}}" class="btn_red">
                        @csrf
                        @method('DELETE')
                        <button type="submit">Delete</button>
                    </form>
                    @endisset
                </td>
            </tr>
            @empty
            <div>

                <div id="alert-border-1" class="flex items-center p-4 mb-4 text-blue-800 border-t-4 border-blue-300 bg-blue-50 dark:text-blue-400 dark:bg-gray-800 dark:border-blue-800" role="alert">
                    <svg class="flex-shrink-0 w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                      <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z"/>
                    </svg>
                    <div class="ms-3 text-sm font-medium">
                        There are no records to show!.
                     </div>
                    <button type="button" class="ms-auto -mx-1.5 -my-1.5 bg-blue-50 text-blue-500 rounded-lg focus:ring-2 focus:ring-blue-400 p-1.5 hover:bg-blue-200 inline-flex items-center justify-center h-8 w-8 dark:bg-gray-800 dark:text-blue-400 dark:hover:bg-gray-700" data-dismiss-target="#alert-border-1" aria-label="Close">
                      <span class="sr-only">Dismiss</span>
                      <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                      </svg>
                    </button>
                </div>

            </div>
            @endforelse
        </tbody>
    </table>
</div>
@if($items->count())
    {{$items->links()}}
@endif
@isset($pathCreate)
<div class="p-4">

    <a href="{{route($pathCreate)}}" class="btn_dark">Add New</a>
</div>

@endisset
