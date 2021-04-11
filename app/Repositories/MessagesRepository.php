<?php

namespace App\Repositories;

use App\Models\Message;

class MessagesRepository
{
    public function paginated()
    {
        return Message::query()
            ->whereDoesntHave('parent')
            ->with(['replies', 'author'])
            ->orderBy('created_at', 'DESC')
            ->paginate(25);
    }
}
