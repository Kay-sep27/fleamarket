@extends('layouts.app')

@section('content')
    <h1>{{ $item->name }}</h1>
    <p>￥{{ number_format($item->price) }}</p>
    <p>{{ $item->description }}</p>

    <a href="{{ route('items.edit', $item->id) }}">編集</a>
@endsection