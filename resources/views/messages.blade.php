@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto h-[calc(100vh-100px)] py-6 px-4 flex gap-6">
    
    <!-- LEFT SIDE: Contact List -->
    <div class="w-1/3 min-w-[300px] bg-white rounded-3xl border border-gray-100 shadow-sm flex flex-col overflow-hidden">
        <div class="p-6 border-b border-gray-100">
            <h2 class="text-2xl font-black text-gray-900">Chats</h2>
        </div>
        
        <!-- Contacts scroll area -->
        <div class="flex-1 overflow-y-auto p-3 space-y-2">
            @forelse($contacts as $contact)
                @php 
                    $isActive = isset($activeContact) && $activeContact->id === $contact->id; 
                @endphp
                <a href="{{ route('messages.index', ['user_id' => $contact->id]) }}" class="flex items-center gap-4 p-4 rounded-2xl border transition-colors {{ $isActive ? 'bg-[#52c6be]/10 border-[#52c6be]/20' : 'hover:bg-gray-50 border-transparent' }}">
                    <div class="w-12 h-12 rounded-full {{ $isActive ? 'bg-white text-[#52c6be] shadow-sm' : 'bg-gray-100 text-gray-500' }} flex items-center justify-center font-bold text-lg uppercase">
                        {{ substr($contact->first_name, 0, 1) }}
                    </div>
                    <div class="flex-1 overflow-hidden">
                        <h4 class="font-bold {{ $isActive ? 'text-gray-900' : ($contact->unread_count > 0 ? 'text-gray-900 text-lg' : 'text-gray-700') }} truncate">{{ $contact->first_name }} {{ $contact->last_name }}</h4>
                    </div>
                    @if($contact->unread_count > 0 && !$isActive)
                        <div class="w-3 h-3 bg-red-500 rounded-full shadow-sm"></div>
                    @endif
                </a>
            @empty
                <div class="text-center text-gray-400 p-4">No conversations yet.</div>
            @endforelse
        </div>
    </div>

    <!-- RIGHT SIDE: Chat Box -->
    <div class="flex-1 bg-white rounded-3xl border border-gray-100 shadow-sm flex flex-col overflow-hidden">
        
        @if(isset($activeContact))
            <!-- Chat Header -->
            <div class="px-6 py-5 border-b border-gray-100 flex items-center justify-between bg-white z-10">
                <div class="flex items-center gap-4">
                    <div class="w-10 h-10 rounded-full bg-[#52c6be]/10 flex items-center justify-center text-[#52c6be] font-bold uppercase">
                        {{ substr($activeContact->first_name, 0, 1) }}
                    </div>
                    <div>
                        <h3 class="font-bold text-lg text-gray-900">{{ $activeContact->first_name }} {{ $activeContact->last_name }}</h3>
                    </div>
                </div>
            </div>
             
            <!-- Chat History -->
            <div id="chat-messages" class="flex-1 overflow-y-auto p-6 space-y-4 bg-gray-50/50">
                @forelse($messages as $msg)
                    @if($msg->sender_id === auth()->id())
                        <!-- Outgoing Message -->
                        <div class="flex justify-end">
                            <div class="bg-[#52c6be] text-white p-4 rounded-2xl rounded-tr-sm max-w-[70%] shadow-sm shadow-[#52c6be]/20">
                                {{ $msg->content }}
                            </div>
                        </div>
                    @else
                        <!-- Incoming Message -->
                        <div class="flex justify-start">
                            <div class="bg-white border border-gray-100 text-gray-800 p-4 rounded-2xl rounded-tl-sm max-w-[70%] shadow-sm">
                                {{ $msg->content }}
                            </div>
                        </div>
                    @endif
                @empty
                    <div class="text-center text-gray-400 py-10">Say hello! 👋</div>
                @endforelse
            </div>
             
            <!-- Message Input -->
            <div class="p-4 bg-white border-t border-gray-100">
                <div class="flex items-center gap-3">
                    <input type="text" id="message-input" placeholder="Message {{ $activeContact->first_name }}..." class="flex-1 px-6 py-4 rounded-full bg-gray-50 border border-gray-100 focus:bg-white focus:border-[#52c6be] focus:ring-4 focus:ring-[#52c6be]/10 outline-none transition-all font-medium text-gray-700" onkeypress="handleKeyPress(event)">
                    <button onclick="sendMessage()" class="bg-[#52c6be] text-white p-4 rounded-full shadow-lg shadow-[#52c6be]/20 hover:bg-[#3fad9e] hover:-translate-y-0.5 transition-all">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-6 h-6 -ml-1">
                            <path d="M3.478 2.404a.75.75 0 0 0-.926.941l2.432 7.905H13.5a.75.75 0 0 1 0 1.5H4.984l-2.432 7.905a.75.75 0 0 0 .926.94 60.519 60.519 0 0 0 18.445-8.986.75.75 0 0 0 0-1.218A60.517 60.517 0 0 0 3.478 2.404Z" />
                        </svg>
                    </button>
                </div>
            </div>
        @else
            <!-- No Conversation Selected -->
            <div class="flex-1 flex flex-col items-center justify-center bg-gray-50/50 p-6 text-center">
                <div class="w-20 h-20 bg-gray-100 rounded-full flex items-center justify-center text-gray-300 mb-4 shadow-inner">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-10 h-10">
                      <path stroke-linecap="round" stroke-linejoin="round" d="M8.625 9.75a.375.375 0 11-.75 0 .375.375 0 01.75 0zm0 0H8.25m4.125 0a.375.375 0 11-.75 0 .375.375 0 01.75 0zm0 0H12m4.125 0a.375.375 0 11-.75 0 .375.375 0 01.75 0zm0 0h-.375m-13.5 3.01c0 1.6 1.123 2.994 2.707 3.227 1.087.16 2.185.283 3.293.369V21l4.076-4.076a1.526 1.526 0 011.037-.443 48.282 48.282 0 005.68-.494h.02a3.002 3.002 0 002.818-2.885c.024-.269.048-.538.07-.807.027-.33.052-.656.074-.984.093-1.396.14-2.81.14-4.25s-.047-2.854-.14-4.25c-.022-.328-.047-.654-.074-.984a51.642 51.642 0 00-.07-.807A3.002 3.002 0 0018.068 2.5h-.02a48.282 48.282 0 00-5.68-.494 1.526 1.526 0 01-1.037.443L7.255 6.526v2.96c-1.108.086-2.206.209-3.293.369-1.584.233-2.707 1.626-2.707 3.228v.677z" />
                    </svg>
                </div>
                <h3 class="text-xl font-bold text-gray-900 mb-1">Your Messages</h3>
                <p class="text-gray-500">Select a conversation from the sidebar to chat.</p>
            </div>
        @endif
    </div>
</div>

@if(isset($activeContact))
<script>
    const chatContainer = document.getElementById('chat-messages');
    
    // Scroll to bottom immediately on load
    if (chatContainer) {
        chatContainer.scrollTop = chatContainer.scrollHeight;
    }

    function handleKeyPress(e) {
        if (e.key === 'Enter') {
            sendMessage();
        }
    }

    function sendMessage() {
        const input = document.getElementById('message-input');
        const content = input.value.trim();
        if (!content) return;
        
        fetch("{{ route('messages.store') }}", {
            method: "POST",
            headers: {
                "Content-Type": "application/json",
                "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').content
            },
            body: JSON.stringify({
                content: content,
                receiver_id: "{{ $activeContact->id }}",
                // Attempt to grab annonce_id from URL if provided, or default from first message
                annonce_id: "{{ request('annonce_id') ?? (optional($messages->first())->annonce_id ?? 1) }}"
            })
        }).then(res => res.json()).then(data => {
            input.value = "";
            
            // Append our message locally immediately
            const msgHtml = `
            <div class="flex justify-end">
                <div class="bg-[#52c6be] text-white p-4 rounded-2xl rounded-tr-sm max-w-[70%] shadow-sm shadow-[#52c6be]/20">
                    ${data.content}
                </div>
            </div>`;
            
            chatContainer.innerHTML += msgHtml;
            chatContainer.scrollTop = chatContainer.scrollHeight;
            
            // Remove the 'Say hello!' text if it's the first message!
            if(chatContainer.innerText.includes('Say hello!')) {
                chatContainer.firstElementChild.style.display = 'none';
            }
        });
    }

    // Connect to WebSocket using Echo to listen for incoming messages!
    document.addEventListener("DOMContentLoaded", () => {
        setTimeout(() => {
            if (window.Echo) {
                console.log("Listening on messages.{{ auth()->id() }}");
                window.Echo.private(`messages.{{ auth()->id() }}`)
                    .listen('MessageSent', (e) => {
                        // We only append it if it's from the person we are actively chatting with!
                        if (e.message.sender_id == "{{ $activeContact->id }}") {
                            const msgHtml = `
                            <div class="flex justify-start">
                                <div class="bg-white border border-gray-100 text-gray-800 p-4 rounded-2xl rounded-tl-sm max-w-[70%] shadow-sm">
                                    ${e.message.content}
                                </div>
                            </div>`;
                            
                            chatContainer.innerHTML += msgHtml;
                            chatContainer.scrollTop = chatContainer.scrollHeight;
                        }
                    });
            }
        }, 1000);
    });
</script>
@endif
@endsection
