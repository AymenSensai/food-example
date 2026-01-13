@props(['item', 'showCategory' => false])

<div class="group relative bg-white rounded-xl shadow-sm hover:shadow-md transition-all duration-300 overflow-hidden border border-slate-100 flex flex-col h-full transform hover:-translate-y-1">
    @if($item->image)
        <div class="aspect-w-16 aspect-h-12 bg-gray-200 overflow-hidden h-56">
            <img src="{{ Str::startsWith($item->image, 'http') ? $item->image : Storage::temporaryUrl($item->image, now()->addMinutes(60)) }}" alt="{{ $item->name }}" class="h-full w-full object-cover object-center group-hover:scale-105 transition-transform duration-500">
        </div>
    @else
        <div class="h-56 bg-slate-100 flex items-center justify-center">
            <svg class="w-12 h-12 text-slate-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
            </svg>
        </div>
    @endif
    <div class="p-6 flex-1 flex flex-col">
        <div class="flex justify-between items-start mb-2">
            <h3 class="text-xl font-semibold text-slate-900 leading-tight group-hover:text-orange-600 transition-colors">
                {{ $item->name }}
            </h3>
            <p class="text-lg font-bold text-orange-600 space-x-1 whitespace-nowrap ml-4">
                <span>{{ $item->price }}</span>
                <span class="text-sm font-normal text-orange-500">DA</span>
            </p>
        </div>
        
        @if($showCategory && $item->category)
            <div class="mb-3">
                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-orange-50 text-orange-700">
                    {{ $item->category->name }}
                </span>
            </div>
        @endif

        @if($item->description)
            <p class="text-slate-500 line-clamp-3 mb-4 flex-1">{{ $item->description }}</p>
        @endif
    </div>
</div>
