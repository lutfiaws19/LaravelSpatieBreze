<x-app-layout>
    <x-slot name="header">
        <h1>Chat Room</h1>
    </x-slot>

@section('content')
<div class="container">
    @if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif

    <h2>Chat Room</h2>
    <div id="messages">
        @foreach($messages as $message)
            <div>
                <strong>{{ $message->user->name ?? 'Anon' }}:</strong>
                {{ $message->content }}
            </div>
        @endforeach
    </div>
    <!-- filepath: resources/views/chat.blade.php -->
<form method="GET" action="{{ route('chat.index') }}">
    <label for="receiver_id">Pilih User/Pelanggan:</label>
    <select name="receiver_id" id="receiver_id" onchange="this.form.submit()">
        <option value="">-- Pilih User --</option>
        @foreach($users as $user)
            <option value="{{ $user->id }}" {{ $receiver_id == $user->id ? 'selected' : '' }}>
                {{ $user->name }}
            </option>
        @endforeach
    </select>
</form>
   <form method="POST" action="{{ route('chat.send') }}">
    @csrf
    <input type="hidden" name="receiver_id" value="{{ $receiver_id }}">
    <input type="text" name="content" required>
    <button type="submit">Send</button>
</form>
</div>
</x-app-layout>