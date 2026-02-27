<aside id="sidebar" class="fixed inset-y-0 left-0 z-40 w-64 bg-slate-900 transition-transform duration-300 transform -translate-x-full md:translate-x-0 md:relative flex flex-col">
    <div class="p-8 flex items-center gap-3">
        <div class="w-8 h-8 bg-indigo-500 rounded-lg shadow-lg shadow-indigo-500/30 flex items-center justify-center text-white font-black italic">C</div>
        <span class="text-xl font-bold text-white tracking-tight">ColocHub</span>
    </div>

    <nav class="flex-1 px-6 space-y-1">
        <a href="/" class="flex items-center gap-3 px-4 py-3 text-white bg-white/10 rounded-xl border border-white/5 transition">
            <svg class="w-5 h-5 text-indigo-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"></path></svg>
            <span class="font-medium text-sm">Dashboard</span>
        </a>

        <a href="/requests" class="flex items-center gap-3 px-4 py-3 text-slate-400 hover:text-white hover:bg-slate-800 rounded-xl transition">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>
            <span class="font-medium text-sm">Invitations</span>
        </a>

        <a href="/colocations" class="flex items-center gap-3 px-4 py-3 text-slate-400 hover:text-white hover:bg-slate-800 rounded-xl transition">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-2m-2 0H5m2 0h10m-2 8v3m0-3h3m-3 0h-3m-3 0v3m0-3h3m-3 0h-3"></path></svg>
            <span class="font-medium text-sm">Colocations</span>
        </a>
    </nav>

    <div class="p-6 border-t border-slate-800">
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button class="w-full flex items-center gap-3 px-4 py-3 text-slate-400 hover:text-white hover:bg-rose-500/10 rounded-xl transition group">
                <svg class="w-5 h-5 group-hover:text-rose-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path></svg>
                <span class="text-sm">Sign Out</span>
            </button>
        </form>
    </div>
</aside>