@extends('layout')

@section('content')
    <div class="container">
        <div class="card">
            <div class="card-header">
                Articles <small>({{ $cards->count() }})</small>
            </div>
            <div class="card-body">
                <form action="{{ url('search') }}" method="get">
                    <div class="form-group">
                        <input
                                type="text"
                                name="q"
                                class="form-control"
                                placeholder="Search..."
                                value="{{ request('q') }}"
                        />
                    </div>
                </form>
                @forelse ($cards as $card)
                    <article class="mb-3">
                        <h2>{{ $card->name}}</h2>

                        <p class="m-0">{{ $card->cardSet }}</body>
                        <p class="m-0">{{ $card->text }}</body>
                        <img src="{{ $card->img }}">

                        <div>
                            {{--@foreach ($card->tags as $tag)--}}
                                {{--<span class="badge badge-light">{{ $tag}}</span>--}}
                            {{--@endforeach--}}
                        </div>
                    </article>
                @empty
                    <p>No articles found</p>
                @endforelse
            </div>
        </div>
    </div>
@endsection
