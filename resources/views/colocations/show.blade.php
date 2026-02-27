<x-app-layout>
    <div class="max-w-full mx-auto py-8 px-8">
        
        <div class="mb-10 flex flex-col md:flex-row md:items-center justify-between gap-6">
            <div class="flex items-center gap-5">
                <a href="/dashboard" class="p-3 bg-white border border-slate-200 rounded-2xl hover:bg-slate-50 transition shadow-sm group">
                    <svg class="w-5 h-5 text-slate-400 group-hover:text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                    </svg>
                </a>
                <div>
                    <h1 class="text-4xl font-black text-slate-900 tracking-tight">{{ $colocation->name }}</h1>
                    <p class="text-xs font-bold text-indigo-600 uppercase tracking-widest mt-1">Workspace Management</p>
                </div>
            </div>
            
            <div class="flex items-center gap-3 bg-white p-2 rounded-2xl border border-slate-100 shadow-sm">
                <span class="px-4 py-2 text-[10px] font-black text-slate-400 border-r border-slate-100 uppercase">ID: #{{ str_pad($colocation->id, 4, '0', STR_PAD_LEFT) }}</span>
                <span class="px-4 py-2 text-[10px] font-black text-emerald-500 uppercase tracking-tighter flex items-center gap-2">
                    <span class="w-2 h-2 bg-emerald-500 rounded-full animate-pulse"></span> Verified
                </span>
            </div>
        </div>

        <div class="flex flex-col lg:flex-row items-start gap-8">
            
            <div class="w-full lg:flex-1 space-y-6">
                <div class="bg-white rounded-[2rem] border border-slate-200 shadow-sm overflow-hidden">
                    
                    <div class="px-8 py-5 border-b border-slate-100 flex items-center justify-between">
                        <h3 class="text-base font-semibold text-slate-900">Residents & Financial History</h3>
                        <div class="flex gap-2">
                             <span class="text-[11px] font-medium text-slate-500 bg-slate-100 px-4 py-1 rounded-lg">
                                {{ $colocation->users->count() }} Total Records
                            </span>
                        </div>
                    </div>

                    <div class="divide-y divide-slate-50">
                        @foreach($colocation->users as $member)
                        @php
                            // Fetch specific membership status for this colocation
                            $membership = $member->memberships->where('colocation_id', $colocation->id)->first();
                            $isKicked = ($membership && $membership->status === 'invalid');
                            
                            $expenseSum = $member->expenses_sum_amount ?? 0;
                            $paymentSum = $member->payments_sum_amount ?? 0;
                            $isAdminMember = ($member->id === $colocation->owner);
                        @endphp
                        
                        <div class="flex items-center justify-between p-6 transition-all {{ $isKicked ? 'bg-slate-50/50 opacity-70' : 'hover:bg-slate-50/30' }}">
                            
                            <div class="flex items-center gap-4 w-[35%]">
                                <div class="relative flex-shrink-0">
                                    @if($member->image)
                                        <img src="{{ asset('storage/' . $member->image) }}" 
                                             class="w-12 h-12 rounded-xl object-cover ring-1 ring-slate-100 {{ $isKicked ? 'grayscale' : '' }}">
                                    @else
                                        <div class="w-12 h-12 rounded-xl flex items-center justify-center text-sm font-bold shadow-sm 
                                            {{ $isAdminMember ? 'bg-slate-900 text-white' : ($isKicked ? 'bg-slate-200 text-slate-500' : 'bg-indigo-50 text-indigo-600') }}">
                                            {{ strtoupper(substr($member->name, 0, 1)) }}
                                        </div>
                                    @endif

                                    @if($isAdminMember)
                                        <div class="absolute -top-1 -right-1 bg-amber-400 w-3 h-3 rounded-full border-2 border-white"></div>
                                    @endif
                                </div>
                                <div class="truncate">
                                    <div class="flex items-center gap-2">
                                        <h4 class="text-sm font-semibold text-slate-900 truncate">{{ $member->name }}</h4>
                                        @if($isKicked)
                                            <span class="text-[9px] font-bold bg-rose-100 text-rose-600 px-1.5 py-0.5 rounded uppercase">Former</span>
                                        @endif
                                    </div>
                                    <p class="text-xs text-slate-500 truncate">{{ $member->email }}</p>
                                </div>
                            </div>

                            <div class="flex-1 flex items-center justify-end gap-12 px-12">
                                <div class="text-right">
                                    <p class="text-[10px] font-medium text-slate-400 uppercase tracking-widest mb-0.5">Total Spent</p>
                                    <p class="text-sm font-semibold text-slate-700">{{ number_format($expenseSum, 0) }} DH</p>
                                </div>
                                <div class="text-right">
                                    <p class="text-[10px] font-medium text-slate-400 uppercase tracking-widest mb-0.5">Total Settled</p>
                                    <p class="text-sm font-semibold text-slate-700">{{ number_format($paymentSum, 0) }} DH</p>
                                </div>
                            </div>

                            <div class="w-32 flex justify-end gap-2">
                                @if($isAdmin && $member->id !== auth()->id() && !$isKicked)
                                    <form action="{{ route('memberships.kick') }}" method="POST" class="inline" onsubmit="return confirm('Are you sure you want to kick this member? Their data will be preserved but they will lose access.');"> 
                                        @csrf @method('PATCH')
                                        <input type="hidden" name="colocation_id" value="{{ $colocation->id }}">
                                        <input type="hidden" name="member_id" value="{{ $member->id }}">
                                        <button class="flex items-center gap-2 px-3 py-1.5 text-xs font-medium text-slate-400 hover:text-rose-600 hover:bg-rose-50 rounded-lg transition-all border border-transparent hover:border-rose-100">
                                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path></svg>
                                            Kick
                                        </button>
                                    </form>
                                @endif
                                
                                <button class="p-2 text-slate-400 hover:text-indigo-600 hover:bg-indigo-50 rounded-lg transition-all">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
                                </button>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>

            <div class="w-full lg:w-[400px] space-y-6">
                @if($isAdmin)
                <div class="bg-slate-900 rounded-[2rem] p-8 text-white shadow-xl border border-slate-800">
                    <h3 class="text-lg font-bold mb-1">Invite Member</h3>
                    <p class="text-slate-500 text-[10px] font-bold mb-6 uppercase tracking-widest">Add new residents</p>
                    
                    <form action="{{ route('requests.store') }}" method="POST" class="space-y-4">
                        @csrf
                        <input type="hidden" name="colocation_id" value="{{ $colocation->id }}">
                        <input type="email" name="email" required
                            class="w-full bg-white/5 border-white/10 rounded-2xl px-5 py-4 text-white placeholder-slate-600 focus:ring-2 focus:ring-indigo-500 focus:bg-white/10 transition-all font-medium text-sm"
                            placeholder="email@example.com">
                        <button class="w-full py-4 bg-indigo-600 hover:bg-indigo-700 text-white rounded-2xl font-bold transition-all active:scale-95 text-xs uppercase tracking-widest">
                            Send Invitation
                        </button>
                    </form>
                </div>
                @endif

                <div class="bg-white rounded-[2rem] p-8 border border-slate-200 shadow-sm">
                    <div class="flex items-center justify-between mb-6">
                        <h3 class="text-[11px] font-bold text-slate-400 uppercase tracking-widest">Pending Invites</h3>
                        <span class="px-2 py-0.5 rounded-md bg-amber-50 text-amber-600 text-[10px] font-bold border border-amber-100">{{ $pendingRequests->count() }}</span>
                    </div>
                    
                    <div class="space-y-3">
                        @forelse($pendingRequests as $req)
                        <div class="flex items-center justify-between p-4 bg-slate-50/50 rounded-2xl border border-slate-100">
                            <div class="truncate">
                                <p class="text-sm font-bold text-slate-800 truncate">{{ $req->users->name ?? 'Guest' }}</p>
                                <p class="text-[10px] text-slate-400 font-medium truncate italic">{{ $req->users->email ?? 'Waiting for signup' }}</p>
                            </div>
                            @if($isAdmin)
                                <form action="{{ route('requests.destroy', $req->id) }}" method="POST">
                                    @csrf @method('DELETE')
                                    <button class="text-slate-300 hover:text-rose-500 transition-colors p-1">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                                    </button>
                                </form>
                            @endif
                        </div>
                        @empty
                        <p class="text-center py-6 text-[10px] font-bold text-slate-300 uppercase tracking-widest italic">No active invites</p>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>