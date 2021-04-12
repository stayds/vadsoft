@if(Auth::user()->roleid == 1)
    @include('partials.adminsidebar')
@elseif(Auth::user()->roleid == 2)
        @include('partials.superadmin')
@elseif(Auth::user()->roleid == 4)
    @include('partials.basic')
@else
@endif




