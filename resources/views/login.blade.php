@extends('layouts.app')


@section('content')
<form action="{{ route('login') }}" method="POST" class="flex flex-col gap-8 w-fit p-5 bg-gray-300 rounded-xl">
    @csrf
    <input type="email" name="email" class="input" placeholder="your email">
    <input type="password" name="password" class="input" placeholder="your password">

    <button type="submit" class="btn">submit</button>
</form>
@endsection