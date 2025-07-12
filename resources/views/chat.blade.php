<!-- filepath: resources/views/chat.blade.php -->
<x-app-layout>
    <x-slot name="header">
        <h1 class="text-2xl font-bold text-gray-800">Chat Room</h1>
    </x-slot>

    <div class="max-w-4xl mx-auto mt-6 bg-white rounded-lg shadow flex">
        <!-- Sidebar User List -->
        <div class="w-1/3 border-r p-4 bg-gray-50">
            <h2 class="font-semibold mb-4 text-gray-700">Daftar User</h2>
            <ul>
                @foreach($users as $user)
                    <li>
                        <a href="{{ route('chat.index', ['receiver_id' => $user->id]) }}"
                           class="block px-3 py-2 rounded mb-2 transition
                           {{ $receiver_id == $user->id ? 'bg-blue-100 text-blue-700 font-bold' : 'hover:bg-gray-100' }}">
                            {{ $user->name }}
                        </a>
                    </li>
                @endforeach
            </ul>
        </div>

        <!-- Chat Box & Info -->
        <div class="w-2/3 p-6 flex flex-col relative">
            @if(session('success'))
                <div class="mb-4 px-4 py-2 bg-green-100 text-green-800 rounded">
                    {{ session('success') }}
                </div>
            @endif

            <!-- Info User yang sedang di-chat -->
            @if($receiver_id)
                @php
                    $chatUser = $users->where('id', $receiver_id)->first();
                @endphp
                <div class="flex items-center gap-3 mb-4 border-b pb-3">
                    <div class="w-12 h-12 rounded-full bg-blue-100 flex items-center justify-center text-xl font-bold text-blue-700">
                        {{ strtoupper(substr($chatUser->name, 0, 2)) }}
                    </div>
                    <div>
                        <div class="font-semibold text-gray-800">{{ $chatUser->name }}</div>
                        <div class="text-xs text-gray-500">ID: {{ $chatUser->id }}</div>
                        <div class="text-xs text-gray-400">Sedang chat dengan Anda</div>
                    </div>
                </div>
            @endif

            <!-- Chat Messages Scrollable -->
            <div id="messages" class="mb-4 h-96 overflow-y-auto bg-gray-50 rounded p-4 border">
                @forelse($messages as $message)
                    <div class="mb-2 flex {{ $message->user_id == auth()->id() ? 'justify-end' : 'justify-start' }}">
                        <div class="max-w-xs px-3 py-2 rounded-lg
                            {{ $message->user_id == auth()->id() ? 'bg-blue-500 text-black' : 'bg-gray-200 text-gray-800' }}">
                            <span class="block text-xs font-semibold mb-1">
                                {{ $message->user->name ?? 'Anon' }}
                            </span>
                            <span>{{ $message->content }}</span>
                        </div>
                    </div>
                @empty
                    <div class="text-gray-500 text-center">Belum ada pesan.</div>
                @endforelse
            </div>

            @if($receiver_id)
                <form method="POST" action="{{ route('chat.send') }}" class="flex gap-2 mt-2">
                    @csrf
                    <input type="hidden" name="receiver_id" value="{{ $receiver_id }}">
                    <input type="text" name="content" required placeholder="Tulis pesan..."
                        class="flex-1 border rounded px-3 py-2 focus:outline-none focus:ring focus:border-blue-300" />
                    <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 transition">
                        Send
                    </button>
                </form>
              @if(Auth::user()->hasRole('Admin'))
                 <form method="POST" action="{{ route('chat.reset', $receiver_id) }}" class="mb-2 mt-2">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="bg-red-600 text-white px-3 py-1 rounded hover:bg-red-700 transition text-xs">
                        Reset Percakapan
                    </button>
                </form>
                @endif
                
            @else
                <div class="text-gray-400 text-center mt-4">Pilih user untuk memulai chat.</div>
            @endif

            <!-- Tips Chat -->
            <div class="absolute top-6 right-6 w-40 bg-black rounded-lg p-4 shadow hidden md:block">
                <div class="font-semibold text-white mb-2">Tips Chat</div>
                <ul class="text-xs text-gray-200 list-disc pl-4">
                    <li>Gunakan bahasa sopan</li>
                    <li>Pesan akan langsung terkirim</li>
                    <li>Scroll untuk melihat pesan lama</li>
                </ul>
            </div>
        </div>
    </div>
</x-app-layout>