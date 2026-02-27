<x-app-layout>
    <div class="max-w-4xl mx-auto py-10">
        <div class="mb-10 flex items-center justify-between">
            <div>
                <h1 class="text-4xl font-black text-slate-900 tracking-tight">Establish Space</h1>
                <p class="text-slate-500 mt-2 text-lg">Set up a new colocation and define your expense categories.</p>
            </div>
            <a href="/dashboard" class="text-sm font-bold text-slate-400 hover:text-indigo-600 transition flex items-center gap-2">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
                Back to Dashboard
            </a>
        </div>

        <form action="{{ route('colocations.store') }}" method="POST" id="colocation-form">
            @csrf
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                
                <div class="lg:col-span-2 space-y-6">
                    <div class="bg-white p-8 rounded-[2rem] border border-slate-200 shadow-xl shadow-slate-200/40">
                        <h3 class="text-xl font-bold text-slate-900 mb-6 flex items-center gap-2">
                            <span class="w-8 h-8 rounded-lg bg-indigo-100 text-indigo-600 flex items-center justify-center text-sm">1</span>
                            General Information
                        </h3>

                        <div class="space-y-4">
                            <div>
                                <label for="name" class="block text-sm font-bold text-slate-700 mb-2 uppercase tracking-wide">Colocation Name</label>
                                <input type="text" name="name" id="name" required
                                    class="w-full px-5 py-4 bg-slate-50 border-none rounded-2xl focus:ring-2 focus:ring-indigo-500 transition-all placeholder-slate-400 font-medium"
                                    placeholder="e.g. Sunny Palm Villa">
                            </div>

                            <div class="grid grid-cols-2 gap-4">
                                <div>
                                    <label class="block text-sm font-bold text-slate-400 mb-2 uppercase tracking-wide">Owner</label>
                                    <div class="px-5 py-4 bg-slate-100 text-slate-500 rounded-2xl font-bold text-sm border border-slate-200/50 cursor-not-allowed">
                                        {{ Auth::user()->name }}
                                    </div>
                                </div>
                                <div>
                                    <label class="block text-sm font-bold text-slate-400 mb-2 uppercase tracking-wide">Initial Status</label>
                                    <div class="px-5 py-4 bg-emerald-50 text-emerald-600 rounded-2xl font-bold text-sm border border-emerald-100 flex items-center gap-2">
                                        <span class="w-2 h-2 bg-emerald-500 rounded-full animate-pulse"></span>
                                        Active
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="lg:col-span-1">
                    <div class="bg-white p-8 rounded-[2rem] border border-slate-200 shadow-xl shadow-slate-200/40 h-full">
                        <div class="flex items-center justify-between mb-6">
                            <h3 class="text-xl font-bold text-slate-900">Categories</h3>
                            <button type="button" id="add-category" 
                                class="w-8 h-8 rounded-full bg-indigo-600 text-white flex items-center justify-center hover:bg-indigo-700 transition shadow-lg shadow-indigo-200">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
                            </button>
                        </div>
                        
                        <p class="text-xs text-slate-400 mb-4 font-medium italic">Define expense types.</p>

                        <div id="category-container" class="space-y-3">
                            <div class="category-row group relative">
                                <input type="text" name="categories[]" required
                                    class="w-full px-4 py-3 bg-slate-50 border border-slate-100 rounded-xl focus:ring-2 focus:ring-indigo-500 transition-all font-medium text-sm"
                                    placeholder="Category Name">
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="mt-10 flex items-center justify-end gap-4">
                <button type="reset" class="px-8 py-4 text-slate-400 font-bold hover:text-slate-600 transition">Discard</button>
                <button type="submit" class="px-10 py-4 bg-slate-900 text-white rounded-2xl font-bold shadow-2xl shadow-slate-300 hover:bg-black hover:-translate-y-1 transition-all active:scale-95">
                    Launch Colocation
                </button>
            </div>
        </form>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const container = document.getElementById('category-container');
            const addButton = document.getElementById('add-category');

            addButton.addEventListener('click', () => {
                const div = document.createElement('div');
                div.className = 'category-row flex items-center gap-2 mt-2';
                div.innerHTML = `
                    <input type="text" name="categories[]" required
                        class="w-full px-4 py-3 bg-slate-50 border border-slate-100 rounded-xl focus:ring-2 focus:ring-indigo-500 transition-all font-medium text-sm"
                        placeholder="Category Name">
                    <button type="button" class="remove-category text-rose-500 p-1">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                    </button>
                `;
                container.appendChild(div);

                div.querySelector('.remove-category').addEventListener('click', () => div.remove());
            });
        });
    </script>
</x-app-layout>