@php
    $role = auth()->user()->role->name;
    return redirect()->route($role . '.dashboard');
@endphp
