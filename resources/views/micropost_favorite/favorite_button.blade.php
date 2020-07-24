@if (Auth::user()->is_favorite($micropost->id))
    {{-- お気に入りから外すボタンのフォーム --}}
    {!! Form::open(['route' => ['micropost.unfavorite', $micropost->id], 'method' => 'delete']) !!}
        {!! Form::submit('Unfavorite', ['class' => "btn btn-danger btn-block inline-block"]) !!}
    {!! Form::close() !!}
@else
    {{-- お気に入り追加のフォーム --}}
    {!! Form::open(['route'=>['micropost.favorite', $micropost->id]]) !!}
        {!! Form::submit('Favorite', ['class' => "btn btn-primary btn-block inline-block"]) !!}
    {!! Form::close() !!}
@endif
