<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Contactez-nous - Restau Menu</title>
    <link rel="icon" href="{{ asset('logo.png') }}" type="image/png">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>body { font-family: 'Inter', sans-serif; }</style>
</head>
<body class="bg-slate-50 text-slate-900 antialiased selection:bg-orange-500 selection:text-white">
    <div class="min-h-screen flex flex-col">
        <!-- Hero -->
        <header class="bg-slate-900 py-12 relative overflow-hidden">
             <x-public-navbar />
            <div class="mx-auto max-w-7xl px-6 lg:px-8 text-center mt-12">
                <h1 class="text-3xl font-extrabold text-white sm:text-4xl">Contactez-nous</h1>
            </div>
        </header>

        <main class="mx-auto max-w-2xl px-6 py-16 flex-1 w-full relative">
            
            <div class="grid grid-cols-1 gap-8 text-center">
                
                @if($companySettings)
                    <!-- WhatsApp Action -->
                    @if($companySettings->phone)
                        <div class="bg-green-50 rounded-2xl p-8 border border-green-100 shadow-sm">
                            <h2 class="text-xl font-bold text-green-900 mb-4">Besoin d'aide immédiate ?</h2>
                            <p class="text-green-700 mb-6">Contactez-nous directement sur WhatsApp pour toute commande ou question.</p>
                            <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $companySettings->phone) }}" target="_blank" class="inline-flex items-center justify-center bg-green-500 hover:bg-green-600 text-white font-bold py-4 px-8 rounded-full shadow-lg hover:shadow-xl transition-all transform hover:-translate-y-1 w-full sm:w-auto">
                                <svg class="w-6 h-6 mr-3" fill="currentColor" viewBox="0 0 24 24"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413Z"/></svg>
                                Discuter sur WhatsApp
                            </a>
                        </div>
                    @endif

                    <div class="bg-white rounded-2xl p-8 shadow-sm border border-slate-100 flex flex-col space-y-6">
                        @if($companySettings->address)
                            <div>
                                <h3 class="font-bold text-slate-900">Adresse</h3>
                                <p class="text-slate-600">{{ $companySettings->address }}</p>
                            </div>
                        @endif

                        @if($companySettings->phone)
                            <div>
                                <h3 class="font-bold text-slate-900">Téléphone</h3>
                                <p class="text-slate-600">{{ $companySettings->phone }}</p>
                            </div>
                        @endif

                        @if($companySettings->email)
                            <div>
                                <h3 class="font-bold text-slate-900">Email</h3>
                                <p class="text-slate-600">{{ $companySettings->email }}</p>
                            </div>
                        @endif
                    </div>
                @else
                    <p class="text-slate-500">Informations de contact non disponibles pour le moment.</p>
                @endif

            </div>
        </main>
        
        <!-- Reuse Footer Logic (Simplified) -->
        <footer class="bg-white border-t border-slate-200 mt-auto py-8 text-center text-sm text-slate-500">
            &copy; {{ date('Y') }} Restau Menu. All rights reserved.
        </footer>
    </div>
</body>
</html>
