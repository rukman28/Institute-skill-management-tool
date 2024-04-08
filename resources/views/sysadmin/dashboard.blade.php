
<x-layout>
    <div>
        I am in the System Admin Dashboard
    </div>
    @if(Session::has('error'))
        <div>
            {{session::get('error')}}
        </div>

    @endif

    <div>{{Auth::guard('sysadmin')->user()->name}}</div>

    <a href="{{route('sysadmin.logout')}}">Logout</a>


</x-layout>


