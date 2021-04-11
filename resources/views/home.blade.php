@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">

                @if (Route::currentRouteName() != 'home')
                    <a class="btn btn-primary mb-3" href="{{ route('home') }}">Go Back</a>
                @endif

                @if (session('status'))
                    <div class="card">
                        <div class="card-header">{{ __('Dashboard') }}</div>
                        <div class="card-body">
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        </div>
                    </div>
                @endif

                @include('components.forms.messageForm', [ 'message' => $message ?? null, 'inReplyTo' => $inReplyTo ?? null
                ])

                {{ $messages->links() }}

                @foreach ($messages as $message)
                    @include('components.message', [ 'message' => $message ])
                @endforeach

                {{ $messages->links() }}
            </div>
        </div>
    </div>
@endsection
