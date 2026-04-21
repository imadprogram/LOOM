@extends('layouts.app')

@section('content')
    <div class="max-w-7xl mx-auto py-4 px-4 flex overflow-hidden relative" style="height: calc(100vh - 80px);">

        <!-- LEFT SIDE: Contact List -->
        <div id="contacts-panel"
            class="bg-white rounded-l-2xl border-r border-gray-100 shadow-sm flex-col overflow-hidden z-20 transition-all duration-300 {{ isset($activeContact) ? 'hidden md:flex md:w-[340px] md:min-w-[300px]' : 'flex w-full md:w-[340px] md:min-w-[300px]' }}">

            <!-- Header with Search -->
            <div class="p-4 pb-2 border-b border-gray-50 flex-shrink-0">
                <div class="flex items-center justify-between mb-3">
                    <h2 class="text-xl font-bold text-gray-900">Messages</h2>
                    <span
                        class="text-xs font-semibold text-[#52c6be] bg-[#52c6be]/10 px-2.5 py-1 rounded-full">{{ $contacts->count() }}</span>
                </div>
                <div class="relative">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2"
                        stroke="currentColor" class="w-4 h-4 absolute left-3 top-1/2 -translate-y-1/2 text-gray-400">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="m21 21-5.197-5.197m0 0A7.5 7.5 0 1 0 5.196 5.196a7.5 7.5 0 0 0 10.607 10.607Z" />
                    </svg>
                    <input type="text" id="contact-search" placeholder="Search conversations..."
                        class="w-full pl-9 pr-4 py-2.5 rounded-xl bg-gray-50 border-0 text-sm focus:bg-white focus:ring-2 focus:ring-[#52c6be]/20 outline-none transition-all placeholder:text-gray-400">
                </div>
            </div>

            <!-- Contacts scroll area -->
            <div class="flex-1 overflow-y-auto py-2" id="contacts-list">
                @forelse($contacts as $contact)
                    @php
                        $isActive = isset($activeContact) && $activeContact->id === $contact->id;
                        $initials = strtoupper(substr($contact->first_name, 0, 1) . substr($contact->last_name, 0, 1));
                        $colors = [
                            '#52c6be',
                            '#6366f1',
                            '#f59e0b',
                            '#ef4444',
                            '#8b5cf6',
                            '#ec4899',
                            '#14b8a6',
                            '#f97316',
                        ];
                        $colorIndex = $contact->id % count($colors);
                        $avatarColor = $colors[$colorIndex];
                    @endphp
                    <a href="{{ route('messages.index', ['user_id' => $contact->id]) }}"
                        class="contact-item flex items-center gap-3 px-4 py-3 mx-2 rounded-xl transition-all {{ $isActive ? 'bg-[#52c6be]/8 border border-[#52c6be]/15' : 'hover:bg-gray-50 border border-transparent' }}"
                        data-name="{{ strtolower($contact->first_name . ' ' . $contact->last_name) }}">

                        <!-- Avatar -->
                        <div class="relative flex-shrink-0">
                            <div class="w-11 h-11 rounded-full flex items-center justify-center font-bold text-sm text-white shadow-sm"
                                style="background: linear-gradient(135deg, {{ $avatarColor }}, {{ $avatarColor }}cc)">
                                {{ $initials }}
                            </div>
                            @if ($contact->is_online)
                                <div
                                    class="absolute -bottom-0.5 -right-0.5 w-3.5 h-3.5 bg-green-400 rounded-full border-2 border-white">
                                </div>
                            @endif
                        </div>

                        <!-- Contact Info -->
                        <div class="flex-1 min-w-0">
                            <div class="flex items-center justify-between">
                                <h4
                                    class="font-semibold text-sm {{ $isActive ? 'text-gray-900' : ($contact->unread_count > 0 ? 'text-gray-900' : 'text-gray-700') }} truncate">
                                    {{ $contact->first_name }} {{ $contact->last_name }}</h4>
                                @if (isset($contact->last_message_time))
                                    <span
                                        class="text-[11px] {{ $contact->unread_count > 0 ? 'text-[#52c6be] font-semibold' : 'text-gray-400' }} flex-shrink-0 ml-2">{{ $contact->last_message_time }}</span>
                                @endif
                            </div>
                            <div class="flex items-center justify-between mt-0.5">
                                @if (isset($contact->last_message))
                                    <p
                                        class="text-xs {{ $contact->unread_count > 0 ? 'text-gray-600 font-medium' : 'text-gray-400' }} truncate pr-2">
                                        {{ $contact->last_message }}</p>
                                @else
                                    <p class="text-xs text-gray-300 italic">No messages yet</p>
                                @endif
                                @if ($contact->unread_count > 0 && !$isActive)
                                    <span
                                        class="flex-shrink-0 min-w-[20px] h-5 px-1.5 bg-[#52c6be] text-white text-[10px] font-bold rounded-full flex items-center justify-center shadow-sm">{{ $contact->unread_count }}</span>
                                @endif
                            </div>
                        </div>
                    </a>
                @empty
                    <div class="flex flex-col items-center justify-center py-12 px-4 text-center h-full">
                        <div class="w-14 h-14 bg-gray-50 rounded-full flex items-center justify-center mb-3">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                stroke="currentColor" class="w-7 h-7 text-gray-300">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M20.25 8.511c.884.284 1.5 1.128 1.5 2.097v4.286c0 1.136-.847 2.1-1.98 2.193-.34.027-.68.052-1.02.072v3.091l-3-3c-1.354 0-2.694-.055-4.02-.163a2.115 2.115 0 0 1-.825-.242m9.345-8.334a2.126 2.126 0 0 0-.476-.095 48.64 48.64 0 0 0-8.048 0c-1.131.094-1.976 1.057-1.976 2.192v4.286c0 .837.46 1.58 1.155 1.951m9.345-8.334V6.637c0-1.621-1.152-3.026-2.76-3.235A48.455 48.455 0 0 0 11.25 3c-2.115 0-4.198.137-6.24.402-1.608.209-2.76 1.614-2.76 3.235v6.226c0 1.621 1.152 3.026 2.76 3.235.577.075 1.157.14 1.74.194V21l4.155-4.155" />
                            </svg>
                        </div>
                        <p class="text-sm text-gray-400 font-medium">No conversations yet</p>
                    </div>
                @endforelse
            </div>
        </div>

        <!-- RIGHT SIDE: Chat Box -->
        <div id="chat-panel"
            class="flex-1 bg-white rounded-r-2xl shadow-sm flex-col overflow-hidden relative {{ isset($activeContact) ? 'flex' : 'hidden md:flex' }}">

            @if (isset($activeContact))
                @php
                    $activeInitials = strtoupper(
                        substr($activeContact->first_name, 0, 1) . substr($activeContact->last_name, 0, 1),
                    );
                    $activeColorIndex = $activeContact->id % 8;
                    $activeColors = [
                        '#52c6be',
                        '#6366f1',
                        '#f59e0b',
                        '#ef4444',
                        '#8b5cf6',
                        '#ec4899',
                        '#14b8a6',
                        '#f97316',
                    ];
                    $activeAvatarColor = $activeColors[$activeColorIndex];
                @endphp

                <!-- Chat Header -->
                <div
                    class="px-4 py-3 border-b border-gray-100 flex items-center justify-between bg-white z-10 flex-shrink-0">
                    <div class="flex items-center gap-3">
                        <a href="{{ route('messages.index') }}"
                            class="md:hidden p-2 -ml-2 hover:bg-gray-50 rounded-full transition-colors">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5"
                                stroke="currentColor" class="w-5 h-5 text-gray-500">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 19.5L8.25 12l7.5-7.5" />
                            </svg>
                        </a>
                        <div class="w-10 h-10 rounded-full flex items-center justify-center font-bold text-sm text-white shadow-sm"
                            style="background: linear-gradient(135deg, {{ $activeAvatarColor }}, {{ $activeAvatarColor }}cc)">
                            {{ $activeInitials }}
                        </div>
                        <div>
                            <h3 class="font-semibold text-sm text-gray-900 leading-tight">{{ $activeContact->first_name }}
                                {{ $activeContact->last_name }}</h3>
                            <p
                                class="text-[10px] {{ $activeContact->is_online ? 'text-green-500' : 'text-gray-400' }} font-bold uppercase tracking-wider flex items-center gap-1 mt-0.5">
                                <span
                                    class="w-1 h-1 {{ $activeContact->is_online ? 'bg-green-400 shadow-[0_0_5px_rgba(74,222,128,0.5)]' : 'bg-gray-300' }} rounded-full"></span>
                                {{ $activeContact->is_online ? 'Online' : 'Offline' }}
                            </p>
                        </div>
                    </div>
                    <div class="flex items-center gap-1">
                        <button class="p-2 hover:bg-gray-50 rounded-lg text-gray-400 transition-colors">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2"
                                stroke="currentColor" class="w-5 h-5">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="m11.25 11.25.041-.02a.75.75 0 0 1 1.063.852l-.708 2.836a.75.75 0 0 0 1.063.853l.041-.021M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0zm-9-3.75h.008v.008H12V8.25z" />
                            </svg>
                        </button>
                        <button class="p-2 hover:bg-gray-50 rounded-lg text-gray-400 transition-colors hidden sm:block">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2"
                                stroke="currentColor" class="w-5 h-5">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M12 6.75a.75.75 0 1 1 0-1.5.75.75 0 0 1 0 1.5ZM12 12.75a.75.75 0 1 1 0-1.5.75.75 0 0 1 0 1.5ZM12 18.75a.75.75 0 1 1 0-1.5.75.75 0 0 1 0 1.5Z" />
                            </svg>
                        </button>
                    </div>
                </div>

                <!-- Chat History -->
                <div id="chat-messages" class="flex-1 overflow-y-auto px-4 py-6 space-y-4 bg-[#f8fafb]">
                    @forelse($messages as $msg)
                        @php
                            $msgDate = $msg->created_at->format('Y-m-d');
                            $prevDate = isset($prevDate) ? $prevDate : null;
                            $showDate = $msgDate !== $prevDate;
                            $prevDate = $msgDate;
                        @endphp

                        @if ($showDate)
                            <div class="flex items-center justify-center my-6">
                                <span
                                    class="text-[10px] font-black uppercase tracking-widest text-gray-400 bg-white px-4 py-1.5 rounded-full shadow-sm border border-gray-100 italic">
                                    @if ($msgDate === now()->format('Y-m-d'))
                                        Today
                                    @elseif($msgDate === now()->subDay()->format('Y-m-d'))
                                        Yesterday
                                    @else
                                        {{ $msg->created_at->format('M j, Y') }}
                                    @endif
                                </span>
                            </div>
                        @endif

                        @if ($msg->sender_id === auth()->id())
                            <!-- Outgoing -->
                            <div class="flex justify-end mb-2 group">
                                <div class="flex flex-col items-end max-w-[85%] sm:max-w-[70%]">
                                    <div
                                        class="bg-[#52c6be] text-white px-4 py-3 rounded-2xl rounded-tr-none shadow-md shadow-[#52c6be]/10">
                                        <p class="text-[13px] leading-relaxed font-medium">{{ $msg->content }}</p>
                                    </div>
                                    <div class="flex items-center gap-1.5 mt-1 mr-1">
                                        <span
                                            class="text-[9px] font-bold text-gray-400 uppercase">{{ $msg->created_at->format('H:i') }}</span>
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                            stroke-width="3" stroke="currentColor" class="w-3 h-3 text-[#52c6be]">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="m4.5 12.75 6 6 9-13.5" />
                                        </svg>
                                    </div>
                                </div>
                            </div>
                        @else
                            <!-- Incoming -->
                            <div class="flex justify-start mb-2 group">
                                <div class="flex flex-col items-start max-w-[85%] sm:max-w-[70%]">
                                    <div
                                        class="bg-white border border-gray-100 text-gray-800 px-4 py-3 rounded-2xl rounded-tl-none shadow-sm">
                                        <p class="text-[13px] leading-relaxed font-medium">{{ $msg->content }}</p>
                                    </div>
                                    <span
                                        class="text-[9px] font-bold text-gray-400 uppercase mt-1 ml-1">{{ $msg->created_at->format('H:i') }}</span>
                                </div>
                            </div>
                        @endif
                    @empty
                        <div class="flex flex-col items-center justify-center h-full text-center">
                            <div class="w-16 h-16 bg-[#52c6be]/10 rounded-full flex items-center justify-center mb-4">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke-width="2" stroke="currentColor" class="w-8 h-8 text-[#52c6be]">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M8.625 12a3.375 3.375 0 1 1-6.75 0 3.375 3.375 0 0 1 6.75 0ZM8.625 12a3.375 3.375 0 1 1 6.75 0 3.375 3.375 0 0 1-6.75 0Zm7.875 0a3.375 3.375 0 1 1 6.75 0 3.375 3.375 0 0 1-6.75 0Z" />
                                </svg>
                            </div>
                            <p class="text-sm text-gray-500 font-black uppercase tracking-tight">No messages yet</p>
                        </div>
                    @endforelse
                </div>

                <!-- Message Input -->
                <div class="p-4 bg-white border-t border-gray-100 flex-shrink-0">
                    <div
                        class="flex items-center gap-3 bg-gray-50 rounded-2xl px-4 py-2 border border-gray-100 focus-within:bg-white focus-within:border-[#52c6be]/30 focus-within:ring-4 focus-within:ring-[#52c6be]/5 transition-all">
                        <input type="text" id="message-input" placeholder="Aa"
                            class="flex-1 bg-transparent border-0 focus:ring-0 outline-none text-sm text-gray-700 py-2"
                            onkeypress="handleKeyPress(event)">
                        <button onclick="sendMessage()"
                            class="bg-[#52c6be] text-white p-2.5 rounded-xl shadow-lg shadow-[#52c6be]/20 hover:bg-[#3fad9e] active:scale-95 transition-all">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"
                                class="w-5 h-5">
                                <path
                                    d="M3.478 2.404a.75.75 0 0 0-.926.941l2.432 7.905H13.5a.75.75 0 0 1 0 1.5H4.984l-2.432 7.905a.75.75 0 0 0 .926.94 60.519 60.519 0 0 0 18.445-8.986.75.75 0 0 0 0-1.218A60.517 60.517 0 0 0 3.478 2.404Z" />
                            </svg>
                        </button>
                    </div>
                </div>
            @else
                <!-- Empty State -->
                <div class="flex-1 flex flex-col items-center justify-center bg-[#f8fafb] p-8 text-center">
                    <div
                        class="w-24 h-24 bg-white rounded-3xl flex items-center justify-center mb-6 shadow-xl shadow-black/5 rotate-3">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor" class="w-12 h-12 text-[#52c6be]">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M7.5 8.25h9m-9 3h9m-9 3h9m-11.25-8.25h.008v.008h-.008V8.25Zm.375 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0ZM3.75 12h.008v.008H3.75V12Zm.375 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Zm-.375 3h.008v.008H3.75V15Zm.375 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Z" />
                        </svg>
                    </div>
                    <h3 class="text-xl font-black text-gray-900 mb-2">Select a conversation</h3>
                    <p class="text-sm text-gray-400 max-w-[260px] font-medium leading-relaxed">Choose someone from the list
                        to start chatting about Loom deals.</p>
                </div>
            @endif
        </div>
    </div>

    <script>
        @if (isset($activeContact))
            const chatContainer = document.getElementById('chat-messages');
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
                        annonce_id: {!! request('annonce_id') ?? (optional($messages->first())->annonce_id ?? 'null') !!}
                    })
                }).then(res => res.json()).then(data => {
                    input.value = "";
                    const timeStr = new Date().toLocaleTimeString('en-GB', {
                        hour: '2-digit',
                        minute: '2-digit'
                    });

                    const msgHtml = `
            <div class="flex justify-end mb-2 group animate-in fade-in slide-in-from-bottom-2 duration-300">
                <div class="flex flex-col items-end max-w-[85%] sm:max-w-[70%]">
                    <div class="bg-[#52c6be] text-white px-4 py-3 rounded-2xl rounded-tr-none shadow-md shadow-[#52c6be]/10">
                        <p class="text-[13px] leading-relaxed font-medium">${data.content}</p>
                    </div>
                    <div class="flex items-center gap-1.5 mt-1 mr-1">
                        <span class="text-[9px] font-bold text-gray-400 uppercase">${timeStr}</span>
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="3" stroke="currentColor" class="w-3 h-3 text-[#52c6be]">
                            <path stroke-linecap="round" stroke-linejoin="round" d="m4.5 12.75 6 6 9-13.5" />
                        </svg>
                    </div>
                </div>
            </div>`;

                    chatContainer.insertAdjacentHTML('beforeend', msgHtml);
                    chatContainer.lastElementChild.scrollIntoView({
                        behavior: 'smooth'
                    });
                });
            }

            // 1. WebSocket Listener for Live Receiving
            document.addEventListener("DOMContentLoaded", () => {
                setTimeout(() => {
                    if (window.Echo) {
                        window.Echo.private(`messages.{{ auth()->id() }}`).listen('MessageSent', (e) => {
                            // Only append if the incoming message is from the active contact we're chatting with
                            if (e.message.sender_id == "{{ $activeContact->id }}") {
                                const timeStr = new Date().toLocaleTimeString('en-GB', {
                                    hour: '2-digit',
                                    minute: '2-digit'
                                });

                                const incomingHtml = `
                                <div class="flex justify-start mb-2 group animate-in fade-in slide-in-from-bottom-2 duration-300">
                                    <div class="flex flex-col items-start max-w-[85%] sm:max-w-[70%]">
                                        <div class="bg-white border border-gray-100 text-gray-800 px-4 py-3 rounded-2xl rounded-tl-none shadow-sm">
                                            <p class="text-[13px] leading-relaxed font-medium">${e.message.content}</p>
                                        </div>
                                        <span class="text-[9px] font-bold text-gray-400 uppercase mt-1 ml-1">${timeStr}</span>
                                    </div>
                                </div>`;

                                chatContainer.insertAdjacentHTML('beforeend', incomingHtml);
                                chatContainer.lastElementChild.scrollIntoView({
                                    behavior: 'smooth'
                                });

                                // Hide "No messages yet" state if it's the first message
                                const emptyState = document.querySelector(
                                    '.flex.flex-col.items-center.justify-center.h-full');
                                if (emptyState) emptyState.style.display = 'none';
                            }
                        });
                    }
                }, 1000); // 1-second delay ensures Reverb/Pusher is fully initialized
            });
        @endif

        // Search functionality
        const searchInput = document.getElementById('contact-search');
        if (searchInput) {
            searchInput.addEventListener('input', function() {
                const query = this.value.toLowerCase();
                document.querySelectorAll('.contact-item').forEach(item => {
                    const name = item.dataset.name;
                    item.style.display = name.includes(query) ? 'flex' : 'none';
                });
            });
        }
    </script>

    <style>
        /* Hide scrollbar but keep functionality */
        .scrollbar-hide::-webkit-scrollbar {
            display: none;
        }

        .scrollbar-hide {
            -ms-overflow-style: none;
            scrollbar-width: none;
        }

        #chat-messages::-webkit-scrollbar {
            width: 6px;
        }

        #chat-messages::-webkit-scrollbar-track {
            background: transparent;
        }

        #chat-messages::-webkit-scrollbar-thumb {
            background: #e5e7eb;
            border-radius: 10px;
        }
    </style>
@endsection
