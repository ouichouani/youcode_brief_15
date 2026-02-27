<x-app-layout>
    <div class="mb-10">
        <h1 class="text-4xl font-black text-slate-900 tracking-tight">System Statistics</h1>
        <p class="text-slate-500 mt-2 text-lg">Real-time overview of your finances and housing network.</p>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8 mb-12">
        @include('partials.stats-cards')
    </div>

    <div class="bg-white rounded-[2rem] border border-slate-200 shadow-xl shadow-slate-200/40 overflow-hidden">
        <div class="px-10 py-8 border-b border-slate-50 flex items-center justify-between bg-white">
            <div>
                <h3 class="text-xl font-bold text-slate-900">Active Colocations</h3>
                <p class="text-sm text-slate-400 font-medium mt-1">Click on a row to view workspace details</p>
            </div>

            {{-- /// --}}
            @if ( $membershipe != 'invalid') 
                <a href="colocations/create" class="px-6 py-3 bg-indigo-600 text-white rounded-2xl font-bold shadow-lg shadow-indigo-200 hover:bg-indigo-700 hover:-translate-y-0.5 transition-all active:scale-95">
                    create colocation
                </a> 
            @endif
        </div>
        
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-slate-50/50 text-slate-400 text-[11px] uppercase tracking-[0.2em] font-bold">
                        <th class="px-10 py-5">Colocation Name</th>
                        <th class="px-10 py-5">Status</th>
                        <th class="px-10 py-5 text-right">Reference ID</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100">
                    @forelse ($colocations as $colocation)
                        <tr onclick="window.location='{{ url('colocations/' . $colocation->id) }}'" 
                            class="group cursor-pointer hover:bg-indigo-50/40 transition-all duration-200">
                            
                            <td class="px-10 py-6">
                                <div class="flex items-center gap-4">
                                    <div class="w-12 h-12 rounded-2xl bg-slate-100 text-slate-500 font-black flex items-center justify-center group-hover:bg-white group-hover:text-indigo-600 group-hover:shadow-sm transition-all border border-transparent group-hover:border-slate-100">
                                        {{ strtoupper(substr($colocation->name, 0, 1)) }}
                                    </div>
                                    <div>
                                        <span class="block font-bold text-slate-800 group-hover:text-indigo-600 transition-colors">{{ $colocation->name }}</span>
                                        <span class="text-xs text-slate-400 font-medium italic">Owner email :  {{ $colocation->owner_user->email ?? 'N/A' }}</span>
                                    </div>
                                </div>
                            </td>
                            
                            <td class="px-10 py-6">
                                @if($colocation->status === 'active')
                                    <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-bold bg-emerald-50 text-emerald-600 border border-emerald-100">
                                        <span class="w-1.5 h-1.5 rounded-full bg-emerald-500 animate-pulse"></span>
                                        Active
                                    </span>
                                @else
                                    <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-bold bg-slate-100 text-slate-500">
                                        {{ ucfirst($colocation->status) }}
                                    </span>
                                @endif
                            </td>

                            <td class="px-10 py-6 text-right">
                                <span class="text-slate-300 font-mono text-sm group-hover:text-indigo-300 transition-colors">
                                    REF-{{ str_pad($colocation->id, 4, '0', STR_PAD_LEFT) }}
                                </span>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="3" class="px-10 py-20 text-center">
                                <div class="flex flex-col items-center">
                                    <div class="w-20 h-20 bg-slate-50 rounded-full flex items-center justify-center mb-4">
                                        <svg class="w-10 h-10 text-slate-200" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2-2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path></svg>
                                    </div>
                                    <h4 class="text-slate-900 font-bold">No spaces found</h4>
                                    <p class="text-slate-400 text-sm">You aren't a member of any colocation yet.</p>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</x-app-layout>