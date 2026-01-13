<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Stats Grid -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
                <!-- Categories Stat -->
                <div class="bg-white overflow-hidden shadow-sm rounded-xl border border-slate-100 p-6 flex items-center">
                    <div class="p-4 bg-orange-100 rounded-lg text-orange-600 mr-4">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path></svg>
                    </div>
                    <div>
                        <div class="text-slate-500 text-sm font-medium">Total Catégories</div>
                        <div class="text-3xl font-bold text-slate-800">{{ $categoriesCount }}</div>
                    </div>
                </div>

                <!-- Food Items Stat -->
                <div class="bg-white overflow-hidden shadow-sm rounded-xl border border-slate-100 p-6 flex items-center">
                    <div class="p-4 bg-orange-100 rounded-lg text-orange-600 mr-4">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path></svg>
                    </div>
                    <div>
                        <div class="text-slate-500 text-sm font-medium">Total Articles</div>
                        <div class="text-3xl font-bold text-slate-800">{{ $foodItemsCount }}</div>
                    </div>
                </div>

                <!-- Latest Activity Stat -->
                <div class="bg-white overflow-hidden shadow-sm rounded-xl border border-slate-100 p-6 flex items-center">
                    <div class="p-4 bg-orange-100 rounded-lg text-orange-600 mr-4">
                         <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    </div>
                    <div>
                        <div class="text-slate-500 text-sm font-medium">Derniers Ajouts</div>
                        <div class="text-sm font-bold text-slate-800 mt-1">Voir ci-dessous</div>
                    </div>
                </div>
            </div>

            <!-- Latest Items Table -->
            <div class="bg-white overflow-hidden shadow-sm rounded-xl border border-slate-100">
                <div class="p-6 border-b border-slate-100">
                    <h3 class="text-lg font-bold text-slate-800">Derniers Articles Ajoutés</h3>
                </div>
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-slate-200">
                        <tbody class="bg-white divide-y divide-slate-200">
                            @foreach($latestItems as $item)
                            <tr class="hover:bg-slate-50">
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-slate-900 font-bold">
                                    {{ $item->name }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-slate-500">
                                    {{ $item->category->name }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-slate-500">
                                    {{ $item->created_at->format('d/m/Y') }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                    <span class="text-orange-600 font-bold">{{ $item->price }} DA</span>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
