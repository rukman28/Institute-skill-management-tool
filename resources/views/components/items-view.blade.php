
@props([
    'items',
    'path'
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

                    <a href="#" class="btn_green">view</a>

                    <form method="POST" action="{{route($path,$item)}}" class="btn_red">
                        @csrf
                        @method('DELETE')
                        <button type="submit">Delete</button>
                    </form>
                </td>
            </tr>
            @empty
                <div>
                    There are no records to show!.
                </div>
            @endforelse
        </tbody>
    </table>
</div>
@if($items->count())
    {{$items->links()}}
@endif
