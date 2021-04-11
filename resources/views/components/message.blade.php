<div class="card mb-3">
    <img height="250" src="{{ Storage::url($message->attachment) }}" class="card-img-top" alt="attachment"
        style="object-fit: cover;">
    <div class="card-body">
        <p class="card-text">{{ $message->text }}</p>
        <p class="card-text"><small class="text-muted">Created {{ $message->created_at->diffForHumans() }} by
                {{ $message->author->email }}</small></p>
    </div>
    <div class="card-footer">
        <a href="{{ route('reply', [$message->id]) }}" class="btn btn-primary">Reply</a>
        @if ($message->replies->isEmpty() && Auth::id() == $message->id)
            <a href="{{ route('edit', [$message->id]) }}" class="btn btn-primary">Edit</a>
        @endif
    </div>
</div>

@if (!$message->replies->isEmpty())
    <div class="pl-5">
        @foreach ($message->replies as $reply)
            @include('components.message', ['message' => $reply])
        @endforeach
    </div>
@endif
