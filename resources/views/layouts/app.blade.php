<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'TokoKu')</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=DM+Serif+Display:ital@0;1&family=DM+Sans:opsz,wght@9..40,300;9..40,400;9..40,500;9..40,600&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        :root {
            --cream: #FAF7F2;
            --ink: #1C1917;
            --pine: #1A3D2B;
            --pine-mid: #2D5A3D;
            --pine-light: #EAF2EC;
            --pine-accent: #3E7B52;
            --gold: #C9972C;
            --gold-light: #FDF3DC;
            --slate: #64748B;
            --border: #E5E0D8;
            --white: #FFFFFF;
        }
        body { font-family: 'DM Sans', sans-serif; background: var(--cream); color: var(--ink); }
        h1,h2,h3,.serif { font-family: 'DM Serif Display', serif; }
    </style>
</head>

<body>

<div class="flex min-h-screen">

    {{-- ══ SIDEBAR ══ --}}
    <aside class="w-60 shrink-0 hidden md:flex flex-col"
           style="background:var(--pine); color:#fff; position:sticky; top:0; height:100vh;">

        {{-- Logo --}}
        <div class="px-6 py-6 border-b border-white/10">
            <div class="serif text-2xl tracking-wide text-white">TokoKu</div>
            <div class="text-xs mt-0.5" style="color:rgba(255,255,255,0.45);">Sistem Kasir</div>
        </div>

        {{-- Nav --}}
        <nav class="flex-1 px-3 py-4 text-sm overflow-y-auto">

            {{-- Grup: Utama --}}
            <div class="px-3 mb-1.5">
                <span class="text-xs font-semibold uppercase tracking-widest"
                      style="color:rgba(255,255,255,0.25);">Utama</span>
            </div>

            @php
                $mainItems = [
                    ['route' => 'dashboard',    'label' => 'Dashboard', 'icon' => 'M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6'],
                    ['route' => 'produk.index', 'label' => 'Produk',    'icon' => 'M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4'],
                ]
            @endphp

            <div class="space-y-0.5 mb-4">
            @foreach($mainItems as $item)
            @php $active = request()->routeIs($item['route']) || request()->routeIs($item['route'].'.*') @endphp
            <a href="{{ route($item['route']) }}"
               class="flex items-center gap-3 px-3 py-2.5 rounded-lg transition-all duration-150"
               style="{{ $active ? 'background:rgba(255,255,255,0.15); color:#fff;' : 'color:rgba(255,255,255,0.6);' }}">
                <svg class="w-4 h-4 shrink-0" fill="none" viewBox="0 0 24 24"
                     stroke="currentColor" stroke-width="1.8">
                    <path stroke-linecap="round" stroke-linejoin="round" d="{{ $item['icon'] }}"/>
                </svg>
                <span class="font-medium">{{ $item['label'] }}</span>
                @if($active)<span class="ml-auto w-1.5 h-1.5 rounded-full bg-white/70"></span>@endif
            </a>
            @endforeach
            </div>

            {{-- Divider --}}
            <div class="border-t border-white/10 mb-4"></div>

            {{-- Grup: Penjualan --}}
            <div class="px-3 mb-1.5">
                <span class="text-xs font-semibold uppercase tracking-widest"
                      style="color:rgba(255,255,255,0.25);">Penjualan</span>
            </div>

            @php
                $salesItems = [
                    [
                        'route'  => 'transaksi.create',
                        'label'  => 'Kasir',
                        'badge'  => 'POS',
                        'icon'   => 'M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z',
                        'exact'  => true,
                    ],
                    [
                        'route'  => 'transaksi.index',
                        'label'  => 'Riwayat Transaksi',
                        'badge'  => null,
                        'icon'   => 'M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01',
                        'exact'  => false,
                    ],
                ]
            @endphp

            <div class="space-y-0.5">
            @foreach($salesItems as $item)
            @php
                $active = $item['exact']
                    ? request()->routeIs($item['route'])
                    : request()->routeIs($item['route']) || request()->routeIs($item['route'].'.*');
            @endphp
            <a href="{{ route($item['route']) }}"
               class="flex items-center gap-3 px-3 py-2.5 rounded-lg transition-all duration-150"
               style="{{ $active ? 'background:rgba(255,255,255,0.15); color:#fff;' : 'color:rgba(255,255,255,0.6);' }}">
                <svg class="w-4 h-4 shrink-0" fill="none" viewBox="0 0 24 24"
                     stroke="currentColor" stroke-width="1.8">
                    <path stroke-linecap="round" stroke-linejoin="round" d="{{ $item['icon'] }}"/>
                </svg>
                <span class="font-medium flex-1">{{ $item['label'] }}</span>
                @if($item['badge'])
                    <span class="text-xs font-bold px-1.5 py-0.5 rounded-md"
                          style="background:rgba(255,255,255,0.15); color:rgba(255,255,255,0.8); font-size:10px;">
                        {{ $item['badge'] }}
                    </span>
                @elseif($active)
                    <span class="w-1.5 h-1.5 rounded-full bg-white/70"></span>
                @endif
            </a>
            @endforeach
            </div>

        </nav>

        {{-- Bottom --}}
        {{-- Logout --}}
        <form method="POST" action="{{ route('logout') }}" class="px-3 mt-2">
            @csrf

            <button type="submit"
                class="flex items-center gap-3 w-full px-3 py-2.5 rounded-lg transition-all duration-150
                text-red-300 hover:text-white hover:bg-red-500/20">

                <svg class="w-4 h-4 shrink-0" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor" stroke-width="1.8">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a2 2 0 01-2 2H6a2 2 0 01-2-2V7a2 2 0 012-2h5a2 2 0 012 2v1" />
                </svg>

                <span class="font-medium">Logout</span>
            </button>
        </form>

        <div class="px-6 py-4 border-t border-white/10">
            <div class="text-xs" style="color:rgba(255,255,255,0.35);">
                {{ now()->translatedFormat('d F Y') }}
            </div>
        </div>
    </aside>

    {{-- ══ MAIN ══ --}}
    <div class="flex-1 flex flex-col min-w-0">

        {{-- Topbar --}}
        <header class="bg-white border-b px-6 py-4 flex items-center justify-between sticky top-0 z-10"
                style="border-color:var(--border);">
            <h1 class="serif text-xl" style="color:var(--ink);">@yield('page-title')</h1>
            <div class="flex items-center gap-3">
                <span class="text-xs px-3 py-1.5 rounded-full font-medium"
                      style="background:var(--pine-light); color:var(--pine);">
                    @auth
                        @php
                            $role = auth()->user()->role;

                            $color = match($role) {
                                'admin' => ['bg' => '#DCFCE7', 'text' => '#166534'],
                                'kasir' => ['bg' => '#FEF3C7', 'text' => '#92400E'],
                                default => ['bg' => '#E5E7EB', 'text' => '#374151'],
                            };
                        @endphp

                        <span class="text-xs px-3 py-1.5 rounded-full font-semibold"
                            style="background: {{ $color['bg'] }}; color: {{ $color['text'] }}">
                            {{ ucfirst($role) }}
                        </span>
                        @endauth
                </span>
            </div>
        </header>

        {{-- Flash --}}
        @if(session('success'))
        <div class="mx-6 mt-4 px-4 py-3 rounded-xl text-sm font-medium flex items-center gap-2"
             style="background:var(--pine-light); color:var(--pine);">
            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
            {{ session('success') }}
        </div>
        @endif

        <main class="flex-1 p-6">
            @yield('content')
        </main>

    </div>
</div>

</body>
</html>