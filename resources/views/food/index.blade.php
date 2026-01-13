<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Eyüp Sultan Menu</title>
    <link rel="icon" href="{{ asset('logo.png') }}" type="image/png">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Inter', sans-serif; }
    </style>
</head>
<body class="bg-slate-50 text-slate-900 antialiased selection:bg-orange-500 selection:text-white">
    <div class="min-h-screen">
        <!-- Hero Section -->
        <header class="relative overflow-hidden bg-slate-900 py-24 sm:py-32">
            <x-public-navbar />
            <div class="absolute inset-0 bg-slate-900/60 z-10"></div>
            <div class="absolute inset-0 bg-[url('https://images.unsplash.com/photo-1504674900247-0877df9cc836?auto=format&fit=crop&q=80')] bg-cover bg-center"></div>
            <div class="relative mx-auto max-w-7xl px-6 lg:px-8 text-center z-20">
                <div class="text-center mb-16">
                    <h1 class="text-4xl font-extrabold tracking-tight text-white sm:text-5xl md:text-6xl mb-4 drop-shadow-md">
                        <span class="block text-white">Notre Menu</span>
                    </h1>
                    <p class="max-w-2xl mx-auto text-xl text-slate-100 drop-shadow-sm">
                        Découvrez nos plats délicieux, préparés avec passion.
                    </p>
                </div>
            </div>
        </header>

        <main class="mx-auto max-w-7xl px-6 lg:px-8 py-12">
            <div class="space-y-12">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                @if($search)
                    @foreach($foodItems as $item)
                        <x-food-item-card :item="$item" :show-category="true" />
                    @endforeach
                    
                    @if($foodItems->isEmpty())
                         <div class="col-span-full text-center py-12">
                            <p class="text-slate-500 text-lg">Aucun résultat trouvé pour "{{ $search }}"</p>
                            <a href="{{ route('home') }}" class="mt-4 inline-block text-orange-600 hover:text-orange-700 font-medium">Voir tout le menu</a>
                        </div>
                    @endif

                @else
                    @foreach($categories as $category)
                        <a href="{{ route('category.show', $category) }}" class="group relative bg-white rounded-xl shadow-sm hover:shadow-lg transition-all duration-300 overflow-hidden border border-slate-100 flex flex-col h-full transform hover:-translate-y-1">
                            @if($category->image)
                                <div class="aspect-w-16 aspect-h-9 bg-gray-200 overflow-hidden h-48">
                                    <img src="{{ Str::startsWith($category->image, 'http') ? $category->image : Storage::temporaryUrl($category->image, now()->addMinutes(60)) }}" alt="{{ $category->name }}" class="h-full w-full object-cover object-center group-hover:scale-105 transition-transform duration-500">
                                </div>
                            @else
                                <div class="h-48 bg-orange-100 flex items-center justify-center">
                                    <svg class="w-16 h-16 text-orange-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                    </svg>
                                </div>
                            @endif
                            <div class="p-6 flex-1 flex flex-col">
                                <h2 class="text-2xl font-bold tracking-tight text-slate-900 mb-3 group-hover:text-orange-600 transition-colors">{{ $category->name }}</h2>
                                @if($category->description)
                                    <p class="text-slate-600 line-clamp-3 mb-4 flex-1">{{ $category->description }}</p>
                                @endif
                                <div class="mt-auto pt-4 flex items-center text-orange-600 font-medium group-hover:translate-x-1 transition-transform">
                                    Voir le menu
                                    <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                                    </svg>
                                </div>
                            </div>
                        </a>
                    @endforeach
                @endif
            </div>
        </main>

        <footer class="bg-white border-t border-slate-200 mt-auto">
            <div class="mx-auto max-w-7xl px-6 py-12 md:flex md:items-center md:justify-between lg:px-8">
                <div class="flex justify-center space-x-6 md:order-2">
                    @if(isset($companySettings))
                        @if($companySettings->facebook_url)
                            <a href="{{ $companySettings->facebook_url }}" class="text-slate-400 hover:text-blue-600 transition-colors" target="_blank" rel="noopener noreferrer">
                                <span class="sr-only">Facebook</span>
                                <svg class="h-6 w-6" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                                    <path fill-rule="evenodd" d="M22 12c0-5.523-4.477-10-10-10S2 6.477 2 12c0 4.991 3.657 9.128 8.438 9.878v-6.987h-2.54V12h2.54V9.797c0-2.506 1.492-3.89 3.777-3.89 1.094 0 2.238.195 2.238.195v2.46h-1.26c-1.243 0-1.63.771-1.63 1.562V12h2.773l-.443 2.89h-2.33v6.988C18.343 21.128 22 16.991 22 12z" clip-rule="evenodd" />
                                </svg>
                            </a>
                        @endif
                        @if($companySettings->instagram_url)
                            <a href="{{ $companySettings->instagram_url }}" class="text-slate-400 hover:text-pink-600 transition-colors" target="_blank" rel="noopener noreferrer">
                                <span class="sr-only">Instagram</span>
                                <svg class="h-6 w-6" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                                    <path fill-rule="evenodd" d="M12.315 2c2.43 0 2.784.013 3.808.06 1.064.049 1.791.218 2.427.465a4.902 4.902 0 011.772 1.153 4.902 4.902 0 011.153 1.772c.247.636.416 1.363.465 2.427.048 1.067.06 1.407.06 4.123v.08c0 2.643-.012 2.987-.06 4.043-.049 1.064-.218 1.791-.465 2.427a4.902 4.902 0 01-1.153 1.772 4.902 4.902 0 01-1.772 1.153c-.636.247-1.363.416-2.427.465-1.067.048-1.407.06-4.123.06h-.08c-2.643 0-2.987-.012-4.043-.06-1.064-.049-1.791-.218-2.427-.465a4.902 4.902 0 01-1.772-1.153 4.902 4.902 0 01-1.153-1.772c-.247-.636-.416-1.363-.465-2.427-.047-1.024-.06-1.379-.06-3.808v-.63c0-2.43.013-2.784.06-3.808.049-1.064.218-1.791.465-2.427a4.902 4.902 0 011.153-1.772A4.902 4.902 0 015.468 2.9c.636-.247 1.363-.416 2.427-.465C8.901 2.013 9.256 2 11.685 2h.63zm-.081 1.802h-.468c-2.456 0-2.784.011-3.807.058-.975.045-1.504.207-1.857.344-.467.182-.8.398-1.15.748-.35.35-.566.683-.748 1.15-.137.353-.3.882-.344 1.857-.047 1.023-.058 1.351-.058 3.807v.468c0 2.456.011 2.784.058 3.807.045.975.207 1.504.344 1.857.182.466.399.8.748 1.15.35.35.683.566 1.15.748.353.137.882.3 1.857.344 1.054.048 1.37.058 4.041.058h.08c2.597 0 2.917-.01 3.825-.058.976-.045 1.505-.207 1.858-.344.466-.182.8-.398 1.15-.748.35-.35.566-.683.748-1.15.137-.353.3-.882.344-1.857.048-1.055.058-1.37.058-4.041v-.08c0-2.597-.01-2.917-.058-3.825-.045-.976-.207-1.505-.344-1.858a3.097 3.097 0 00-.748-1.15 3.098 3.098 0 00-1.15-.748c-.353-.137-.882-.3-1.857-.344-1.023-.047-1.351-.058-3.807-.058zM12 6.865a5.135 5.135 0 110 10.27 5.135 5.135 0 010-10.27zm0 1.802a3.333 3.333 0 100 6.666 3.333 3.333 0 000-6.666zm5.338-3.205a1.2 1.2 0 110 2.4 1.2 1.2 0 010-2.4z" clip-rule="evenodd" />
                                </svg>
                            </a>
                        @endif
                        @if($companySettings->tiktok_url)
                            <a href="{{ $companySettings->tiktok_url }}" class="text-slate-400 hover:text-black transition-colors" target="_blank" rel="noopener noreferrer">
                                <span class="sr-only">TikTok</span>
                                <svg class="h-6 w-6" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                                    <path d="M19.59 6.69a4.83 4.83 0 0 1-3.77-4.25V2h-3.45v13.67a2.89 2.89 0 0 1-5.2 1.74 2.89 2.89 0 0 1 2.31-4.64 2.93 2.93 0 0 1 .88.13V9.4a6.84 6.84 0 0 0-1-.05A6.33 6.33 0 0 0 5 20.1a6.34 6.34 0 0 0 10.86-4.43v-7a8.16 8.16 0 0 0 4.77 1.52v-3.4a4.85 4.85 0 0 1-1-.1z"/>
                                </svg>
                            </a>
                        @endif
                    @endif
                </div>
                <div class="mt-8 md:order-1 md:mt-0">
                    <div class="flex justify-center md:justify-start space-x-6 mb-4">
                        <a href="{{ route('contact') }}" class="text-sm text-slate-500 hover:text-orange-600 transition-colors">Contactez-nous</a>

                    </div>
                    <p class="text-center md:text-left text-xs leading-5 text-gray-500">&copy; {{ date('Y') }} Eyüp Sultan Menu. All rights reserved.</p>
                </div>
            </div>
        </footer>
    </div>
</body>
</html>
