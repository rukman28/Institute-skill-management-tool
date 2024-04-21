
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
                    There are no records to show!.
                </div>
            @endforelse
        </tbody>
    </table>
</div>
@if($items->count())
    {{$items->links()}}
@endif
@isset($pathCreate)
<a href="{{route($pathCreate)}}" class="btn_dark">Add New</a>

@endisset
