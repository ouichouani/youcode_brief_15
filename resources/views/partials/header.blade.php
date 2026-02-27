<header class="sticky top-0 z-30 bg-white/70 backdrop-blur-xl border-b border-slate-200/60 px-6 py-3">
    <div class="flex items-center justify-between">
        <div class="flex items-center gap-4">
            <button id="sidebar-toggle" class="md:hidden p-2 text-slate-500">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path></svg>
            </button>
            <h2 class="text-sm font-semibold text-slate-400 uppercase tracking-widest hidden md:block">System Overview</h2>
        </div>

        <div class="flex items-center space-x-5">
            <div class="flex flex-col text-right hidden sm:block">
                <span class="text-sm font-bold text-slate-900">{{ Auth::user()->name }}</span>
                <span class="text-xs text-indigo-600 font-medium">Reputation: {{ number_format($avg_rate ?? 0, 1) }}</span>
            </div>
            <div class="w-10 h-10 rounded-xl bg-indigo-600 flex items-center justify-center text-white shadow-lg shadow-indigo-200">
                {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
            </div>
        </div>
    </div>
</header>