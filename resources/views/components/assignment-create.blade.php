@props([
    'parentItem',
    'parentItemName',
    'itemName',
    'items',
    'pathAssign'

])

{{$errors}}


<form method="POST" action="{{route($pathAssign,$parentItem)}}" class="w-1/2 p-4 mx-auto text-center">
    @csrf

    <h3 class="mb-4 font-semibold text-gray-900 dark:text-white">{{$itemName}}</h3>
    <ul class="w-48 text-sm font-medium text-gray-900 bg-white border border-gray-200 rounded-lg dark:bg-gray-700 dark:border-gray-600 dark:text-white">
        @forelse ($items as $item)
        <li class="w-full border-b border-gray-200 rounded-t-lg dark:border-gray-600">
            <div class="flex items-center ps-3">
                <input id="vue-checkbox" type="checkbox" name="checked_ids[]" value="{{$item->id}}" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500">
                <label for="vue-checkbox" class="w-full py-3 ms-2 text-sm font-medium text-gray-900 dark:text-gray-300">{{$item->name}}</label>
            </div>
        </li>
        @empty
            There is no records to show
        @endforelse

    </ul>
    @if($items->count())
    {{$items->links()}}
@endif

    <button type="submit" class="btn_blue">Submit</button>
</form>






