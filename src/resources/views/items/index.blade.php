@extends('layouts.app')

@section('content')
    <div class="items-container">
        <h1 class="page-title">商品一覧</h1>

        <div class="item-list">
            @foreach ($items as $item)
                <div class="item-card">
                    <a href="{{ route('items.show', $item->id) }}">
                        @if ($item->image)
                            <img src="{{ asset('storage/' . $item->image) }}" alt="{{ $item->name }}" class="item-image">
                        @else
                            <img src="{{ asset('images/no-image.png') }}" alt="No Image" class="item-image">
                        @endif

                        <div class="item-info">
                            <h3 class="item-name">{{ $item->name }}</h3>
                            <p class="item-price">¥{{ number_format($item->price) }}</p>
                        </div>
                    </a>
                </div>
            @endforeach
        </div>
    </div>
@endsection