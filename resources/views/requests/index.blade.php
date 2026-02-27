<x-app-layout>
    <div class="max-w-[1000px] mx-auto py-12 px-6">

        <div class="mb-10">
            <h1 class="text-2xl font-bold text-slate-900 tracking-tight">Invitations</h1>
            <p class="text-sm text-slate-500 mt-1">Manage your colocation requests and workspace access.</p>
        </div>

        @if ($isAlreadyInColocation)
            <div class="mb-8 p-4 bg-amber-50 border border-amber-100 rounded-2xl flex items-center gap-3">
                <svg class="w-5 h-5 text-amber-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
                <p class="text-sm font-medium text-amber-800">
                    You are currently a member of an active colocation. Leave your current one to accept new invites.
                </p>
            </div>
        @endif

        <div class="bg-white rounded-3xl border border-slate-200 shadow-sm overflow-hidden">
            <div class="divide-y divide-slate-50">
                @forelse($requests as $req)
                    <div class="p-6 flex items-center justify-between hover:bg-slate-50/30 transition-colors">

                        <div class="flex items-center gap-4">
                            <div
                                class="w-12 h-12 rounded-xl bg-indigo-50 flex items-center justify-center text-indigo-600 font-bold text-sm shadow-sm flex-shrink-0">
                                {{ strtoupper(substr($req->colocations->name, 0, 1)) }}
                            </div>
                            <div>
                                <h4 class="text-sm font-semibold text-slate-900">{{ $req->colocations->name }}</h4>
                                <p class="text-xs text-slate-500 font-medium">Invited by
                                    {{ $req->colocations->ownerUser->name ?? 'Admin' }}</p>
                            </div>
                        </div>

                        <div class="flex items-center gap-6">

                            @if ($req->status === 'pending')
                                <div class="flex items-center gap-3">
                                    {{-- Soft, rounded Decline button --}}
                                    <form action="{{ route('requests.reject', $req->id) }}" method="POST">
                                        @csrf @method('PATCH')
                                        <button type="submit"
                                            class="px-4 py-2 text-sm font-medium text-slate-500 hover:text-rose-600 hover:bg-rose-50 rounded-xl transition-all duration-200">
                                            Decline
                                        </button>
                                    </form>

                                    @if (!$isAlreadyInColocation)
                                        {{-- Prominent but clean Accept button --}}
                                        <form action="{{ "requests/$req->id/accept" }}" method="POST">
                                            @csrf @method('PATCH')
                                            <button type="submit"
                                                class="px-5 py-2 bg-indigo-600 hover:bg-indigo-700 text-white text-sm font-semibold rounded-xl shadow-md shadow-indigo-100 transition-all active:scale-95">
                                                Accept Invite
                                            </button>
                                        </form>
                                    @else
                                        <button disabled
                                            class="px-5 py-2 bg-slate-100 text-slate-400 text-sm font-semibold rounded-xl cursor-not-allowed border border-slate-200">
                                            Accept Invite
                                        </button>
                                    @endif
                                </div>
                            @else
                                <div class="flex items-center">
                                    @if ($req->status === 'accepted')
                                        <span
                                            class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full bg-emerald-100 text-emerald-700 text-xs font-semibold ring-1 ring-inset ring-emerald-200/50">
                                            <span class="w-1.5 h-1.5 rounded-full bg-emerald-500"></span>
                                            Joined
                                        </span>
                                    @else
                                        <span
                                            class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full bg-red-100 text-slate-600 text-xs font-semibold ring-1 ring-inset ring-slate-200/50">
                                            <span class="w-1.5 h-1.5 rounded-full bg-red-600"></span>
                                            Declined
                                        </span>
                                    @endif
                                </div>
                            @endif

                        </div>
                    </div>
                @empty
                    <div class="py-20 text-center">
                        <div
                            class="w-16 h-16 bg-slate-50 rounded-full flex items-center justify-center mx-auto mb-4 border border-slate-100">
                            <svg class="w-8 h-8 text-slate-300" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0a2 2 0 01-2 2H6a2 2 0 01-2-2m16 0V5a2 2 0 00-2-2H6a2 2 0 00-2 2v10m16 0a2 2 0 01-2 2H6a2 2 0 01-2-2">
                                </path>
                            </svg>
                        </div>
                        <p class="text-sm font-medium text-slate-400">No invitations found.</p>
                    </div>
                @endforelse
            </div>
        </div>
    </div>
</x-app-layout>
