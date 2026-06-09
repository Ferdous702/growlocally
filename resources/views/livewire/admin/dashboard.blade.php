<div>
    <div class="grid grid-cols-1 gap-6 sm:grid-cols-2 lg:grid-cols-4">
        @php
            $cards = [
                ['label' => 'Services',          'count' => $stats['services'],     'route' => 'admin.services',             'color' => 'bg-blue-500'],
                ['label' => 'Portfolios',         'count' => $stats['portfolios'],   'route' => 'admin.portfolios',           'color' => 'bg-violet-500'],
                ['label' => 'Testimonials',       'count' => $stats['testimonials'], 'route' => 'admin.testimonials',         'color' => 'bg-emerald-500'],
                ['label' => 'Contact Inquiries',  'count' => $stats['inquiries'],    'route' => 'admin.contacts',             'color' => 'bg-orange-500'],
            ];
        @endphp

        @foreach ($cards as $card)
            <a href="{{ route($card['route']) }}"
               class="group flex items-center gap-4 rounded-xl bg-white p-6 shadow-sm ring-1 ring-gray-100 transition hover:shadow-md">
                <div class="flex h-12 w-12 flex-shrink-0 items-center justify-center rounded-lg {{ $card['color'] }}">
                    <span class="text-xl font-bold text-white">{{ $card['count'] }}</span>
                </div>
                <div>
                    <p class="text-2xl font-bold text-gray-900">{{ $card['count'] }}</p>
                    <p class="text-sm text-gray-500">{{ $card['label'] }}</p>
                </div>
            </a>
        @endforeach
    </div>

    <div class="mt-8 rounded-xl bg-white p-6 shadow-sm ring-1 ring-gray-100">
        <h2 class="mb-4 text-base font-semibold text-gray-900">Quick Actions</h2>
        <div class="flex flex-wrap gap-3">
            <a href="{{ route('admin.services') }}" class="rounded-lg bg-slate-900 px-4 py-2 text-sm font-medium text-white transition hover:bg-slate-700">Add Service</a>
            <a href="{{ route('admin.portfolios') }}" class="rounded-lg bg-slate-900 px-4 py-2 text-sm font-medium text-white transition hover:bg-slate-700">Add Portfolio</a>
            <a href="{{ route('admin.testimonials') }}" class="rounded-lg bg-slate-900 px-4 py-2 text-sm font-medium text-white transition hover:bg-slate-700">Add Testimonial</a>
            <a href="{{ route('admin.contacts') }}" class="rounded-lg border border-gray-300 px-4 py-2 text-sm font-medium text-gray-700 transition hover:bg-gray-50">View Inquiries</a>
        </div>
    </div>
</div>
