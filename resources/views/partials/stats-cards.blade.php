@php
    $cards = [
        [
            'label' => 'Global Users',
            'value' => $total_users,
            'icon' => 'M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z',
            'color' => 'indigo'
        ],
        [
            'label' => 'Total Expenses',
            'value' => number_format($total_expense ?? 0, 0) . ' DH',
            'icon' => 'M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z',
            'color' => 'rose'
        ],
        [
            'label' => 'Settled Debt',
            'value' => number_format($total_payment ?? 0, 0) . ' DH',
            'icon' => 'M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z',
            'color' => 'emerald'
        ],
        [
            'label' => 'Reputation',
            'value' => number_format($avg_rate ?? 0, 1),
            'icon' => 'M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.783-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z',
            'color' => 'amber'
        ]
    ];
@endphp

@foreach($cards as $card)
    <div class="bg-white p-8 rounded-[2rem] border border-slate-100 shadow-sm hover:shadow-xl hover:shadow-indigo-500/5 transition-all duration-300 group">
        <div class="flex flex-col space-y-4">
            <div class="w-12 h-12 rounded-2xl bg-{{ $card['color'] }}-50 text-{{ $card['color'] }}-600 flex items-center justify-center group-hover:scale-110 transition-transform duration-300">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="{{ $card['icon'] }}"></path>
                </svg>
            </div>
            <div>
                <p class="text-sm font-bold text-slate-400 uppercase tracking-tighter">{{ $card['label'] }}</p>
                <h3 class="text-3xl font-black text-slate-900 mt-1">{{ $card['value'] }}</h3>
            </div>
        </div>
    </div>
@endforeach