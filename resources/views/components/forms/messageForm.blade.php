<div class="card mb-5">
    <div class="card-body">
        <h5 class="card-title">{{ $message ? 'Edit' : 'New' }} message</h5>
        <form method="POST" class="message-form" action="{{ route('messages.store') }}">
            <div class="mb-3">
                <label for="text" class="form-label">Text</label>
                <textarea name="text" class="form-control text-input" id="text" aria-describedby="textHelp">{{ $message ? $message->text : '' }}</textarea>
                <div id="textHelp" class="form-text">Text of your review</div>
                <div class="invalid-feedback"></div>
            </div>
            <div class="mb-3">
                <label for="attachment" class="form-label">Attachment</label>
                <input type="file" name="attachment" accept="image/*" class="form-control-file attachment-input"
                    id="attachment">
                <img width="200" {{ $message ? "src=" . Storage::url($message->attachment) : '' }} class="attachment-preview"></img>
                <div class="invalid-feedback"></div>
            </div>
            <input type="hidden" name="id" {{ $message ? "value={$message->id}" : '' }}>
            <input type="hidden" name="api_token" value="{{ Auth::user()->api_token }}" />
            <input type="hidden" name="parent_id" {{ $inReplyTo ? "value=$inReplyTo" : '' }} />
            <input type="hidden" name="user_id" value="{{ Auth::id() }}" />
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
</div>
