@extends('layouts.app')

@section('title', 'Détails - '.$car->marque.' '.$car->modele)

@section('content')
<div class="min-h-screen main-bg py-4 sm:py-8 px-3 sm:px-4 lg:px-8">
    
    <div class="max-w-7xl mx-auto">
        
        {{-- Back Button --}}
        <div class="mb-4 sm:mb-6">
            <a href="{{ route('cars.index') }}" class="inline-flex items-center text-secondary hover:text-red-500 transition-colors group">
                <svg class="w-4 h-4 sm:w-5 sm:h-5 mr-2 transform group-hover:-translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
                </svg>
                <span class="text-sm sm:text-base">Retour à la liste</span>
            </a>
        </div>

        {{-- Main Container --}}
        <div class="bg-card rounded-2xl sm:rounded-3xl shadow-2xl overflow-hidden border-2 border-card">
            
            <div class="lg:flex">
                
                {{-- Left Side: Gallery --}}
                <div class="lg:w-3/5 p-4 sm:p-6 lg:p-8">
                    
                    @php
                        $images = is_string($car->images) ? json_decode($car->images, true) : ($car->images ?? []);
                        if (empty($images) && $car->image) {
                            $images = [$car->image];
                        }
                        if (empty($images)) {
                            $images = ['default.png'];
                        }
                        $imageCount = count($images);
                    @endphp

                    {{-- Main Slider --}}
                    <div class="relative mb-3 sm:mb-4">
                        <div class="swiper mainSwiper rounded-xl sm:rounded-2xl overflow-hidden shadow-2xl border-2 border-card">
                            <div class="swiper-wrapper">
                                @foreach($images as $index => $image)
                                    <div class="swiper-slide">
                                        <div class="relative aspect-video bg-card">
                                            <img src="{{ asset('uploads/cars/'.$image) }}" 
                                                 alt="{{ $car->marque }} {{ $car->modele }} - Photo {{ $index + 1 }}" 
                                                 class="w-full h-full object-cover cursor-pointer hover:scale-105 transition-transform duration-300"
                                                 onclick="openLightbox({{ $index }})">
                                            
                                            @if($index === 0)
                                            <div class="absolute top-3 sm:top-4 right-3 sm:right-4">
                                                <span class="px-2 sm:px-4 py-1 sm:py-2 rounded-full font-semibold text-xs sm:text-sm shadow-lg backdrop-blur-sm
                                                    @if($car->statut === 'Disponible') bg-green-500/90 text-white
                                                    @elseif($car->statut === 'En réparation') bg-yellow-500/90 text-white
                                                    @else bg-red-500/90 text-white @endif">
                                                    <span class="inline-block w-2 h-2 rounded-full bg-white mr-1 sm:mr-2 animate-pulse"></span>
                                                    {{ $car->statut }}
                                                </span>
                                            </div>
                                            @endif

                                            <div class="absolute bottom-3 sm:bottom-4 left-3 sm:left-4">
                                                <span class="px-2 sm:px-3 py-1 sm:py-1.5 rounded-full bg-black/70 backdrop-blur-sm text-white text-xs font-semibold shadow-lg">
                                                    {{ $index + 1 }} / {{ $imageCount }}
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                            
                            @if($imageCount > 1)
                            <div class="swiper-button-next !text-white !bg-red-600/80 !w-8 !h-8 sm:!w-12 sm:!h-12 !rounded-full hover:!bg-red-700 transition-all"></div>
                            <div class="swiper-button-prev !text-white !bg-red-600/80 !w-8 !h-8 sm:!w-12 sm:!h-12 !rounded-full hover:!bg-red-700 transition-all"></div>
                            @endif
                            
                            <div class="swiper-pagination"></div>
                        </div>
                    </div>

                    {{-- Thumbnails Slider --}}
                    @if($imageCount > 1)
                    <div class="swiper thumbsSwiper">
                        <div class="swiper-wrapper">
                            @foreach($images as $index => $image)
                                <div class="swiper-slide">
                                    <div class="relative aspect-video rounded-lg sm:rounded-xl overflow-hidden border-2 border-transparent hover:border-red-500 cursor-pointer transition-all duration-300">
                                        <img src="{{ asset('uploads/cars/'.$image) }}" 
                                             alt="Thumbnail {{ $index + 1 }}" 
                                             class="w-full h-full object-cover">
                                        
                                        <div class="absolute inset-0 bg-black/40 opacity-0 hover:opacity-100 transition-opacity flex items-center justify-center">
                                            <span class="text-white font-bold text-sm sm:text-lg">{{ $index + 1 }}</span>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                    @endif

                    <div class="mt-3 sm:mt-4 flex items-center justify-between text-xs sm:text-sm text-secondary">
                        <div class="flex items-center gap-2">
                            <svg class="w-4 h-4 sm:w-5 sm:h-5 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                            </svg>
                            <span>{{ $imageCount }} photo{{ $imageCount > 1 ? 's' : '' }}</span>
                        </div>
                        <span class="text-muted hidden sm:inline">Cliquez pour agrandir</span>
                    </div>

                </div>

                {{-- Right Side: Information --}}
                <div class="lg:w-2/5 p-4 sm:p-6 lg:p-8 bg-card border-t-2 lg:border-t-0 lg:border-l-2 border-card">
                    
                    {{-- Header --}}
                    <div class="mb-6 sm:mb-8">
                        <div class="flex items-center gap-3 mb-3">
                            <div class="w-10 h-10 sm:w-12 sm:h-12 bg-gradient-to-br from-red-600 to-red-900 rounded-xl flex items-center justify-center shadow-lg">
                                <svg class="w-5 h-5 sm:w-6 sm:h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 8h14M5 8a2 2 0 110-4h14a2 2 0 110 4M5 8v10a2 2 0 002 2h10a2 2 0 002-2V8m-9 4h4"/>
                                </svg>
                            </div>
                            <div>
                                <h1 class="text-2xl sm:text-3xl font-bold text-primary">{{ $car->marque }}</h1>
                                <p class="text-lg sm:text-xl text-red-400 font-medium">{{ $car->modele }}</p>
                            </div>
                        </div>
                    </div>

                    {{-- Details Grid --}}
                    <div class="space-y-4 sm:space-y-6 mb-6 sm:mb-8">
                        
                        {{-- Year & Mileage --}}
                        <div class="grid grid-cols-2 gap-3 sm:gap-4">
                            <div class="bg-gradient-to-br from-red-900/30 to-red-800/20 rounded-xl sm:rounded-2xl p-3 sm:p-4 border border-red-800/50">
                                <div class="flex items-center mb-2">
                                    <svg class="w-4 h-4 sm:w-5 sm:h-5 text-red-500 mr-1 sm:mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                    </svg>
                                    <span class="text-xs font-semibold text-secondary uppercase">Année</span>
                                </div>
                                <p class="text-xl sm:text-2xl font-bold text-primary">{{ $car->annee }}</p>
                            </div>

                            <div class="bg-gradient-to-br from-red-900/30 to-red-800/20 rounded-xl sm:rounded-2xl p-3 sm:p-4 border border-red-800/50">
                                <div class="flex items-center mb-2">
                                    <svg class="w-4 h-4 sm:w-5 sm:h-5 text-red-500 mr-1 sm:mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/>
                                    </svg>
                                    <span class="text-xs font-semibold text-secondary uppercase">Km</span>
                                </div>
                                <p class="text-lg sm:text-2xl font-bold text-primary">{{ number_format($car->kilometrage, 0, ',', ' ') }} <span class="text-xs sm:text-sm text-secondary">km</span></p>
                            </div>
                        </div>

                        {{-- Pricing --}}
                        <div class="bg-gradient-to-br from-red-900/30 to-red-800/20 rounded-xl sm:rounded-2xl p-4 sm:p-5 border border-red-800/50">
                            <div class="flex justify-between items-start mb-3">
                                <div>
                                    <p class="text-xs font-semibold text-secondary uppercase mb-1">Prix d'achat</p>
                                    <p class="text-lg sm:text-xl font-bold text-primary">{{ number_format($car->prix_achat, 2, ',', ' ') }} <span class="text-xs sm:text-sm text-secondary">DH</span></p>
                                </div>
                                <div class="text-right">
                                    <p class="text-xs font-semibold text-secondary uppercase mb-1">Prix de vente</p>
                                    <p class="text-lg sm:text-xl font-bold text-red-400">
                                        {{ $car->prix_vente ? number_format($car->prix_vente, 2, ',', ' ') . ' DH' : '-' }}
                                    </p>
                                </div>
                            </div>
                            @if($car->prix_vente && $car->prix_achat)
                                <div class="mt-3 pt-3 border-t border-red-800/50">
                                    <p class="text-xs text-secondary mb-1">Marge potentielle</p>
                                    <p class="text-base sm:text-lg font-bold {{ ($car->prix_vente - $car->prix_achat) >= 0 ? 'text-green-400' : 'text-red-400' }}">
                                        {{ number_format($car->prix_vente - $car->prix_achat, 2, ',', ' ') }} DH
                                    </p>
                                </div>
                            @endif
                        </div>

                        {{-- Additional Info --}}
                        <div class="space-y-3">
                            <div class="flex items-center p-3 sm:p-4 bg-card rounded-xl border border-card">
                                <svg class="w-4 h-4 sm:w-5 sm:h-5 text-red-400 mr-2 sm:mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z"/>
                                </svg>
                                <div>
                                    <p class="text-xs text-secondary font-semibold uppercase">Matricule</p>
                                    <p class="text-base sm:text-lg font-bold text-primary tracking-wider">
                                        {{ $car->matricule_part1 }}-{{ $car->matricule_part2 }}-{{ $car->matricule_part3 }}
                                    </p>
                                </div>
                            </div>

                            <div class="flex items-center p-3 sm:p-4 bg-card rounded-xl border border-card">
                                <svg class="w-4 h-4 sm:w-5 sm:h-5 text-red-400 mr-2 sm:mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                </svg>
                                <div>
                                    <p class="text-xs text-secondary font-semibold uppercase">Date d'achat</p>
                                    <p class="text-base sm:text-lg font-bold text-primary">
                                        {{ $car->date_dachat ? \Carbon\Carbon::parse($car->date_dachat)->format('d/m/Y') : '-' }}
                                    </p>
                                </div>
                            </div>
                        </div>

                    </div>

                    {{-- Action Buttons --}}
                    <div class="flex flex-col gap-2 sm:gap-3 pt-4 sm:pt-6 border-t border-card">
                        <a href="{{ route('cars.edit', $car) }}" 
                           class="bg-gradient-to-r from-red-600 to-red-800 text-white px-4 sm:px-6 py-2.5 sm:py-3 rounded-lg sm:rounded-xl text-center font-semibold hover:from-red-700 hover:to-red-900 transform hover:scale-105 transition-all duration-200 shadow-lg hover:shadow-red-500/50 flex items-center justify-center group text-sm sm:text-base">
                            <svg class="w-4 h-4 sm:w-5 sm:h-5 mr-2 group-hover:rotate-12 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                            </svg>
                            Modifier
                        </a>
                        
                        <form action="{{ route('cars.destroy', $car) }}" method="POST" 
                              onsubmit="return confirm('⚠️ Voulez-vous vraiment supprimer cette voiture ?\n\nCette action est irréversible.')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" 
                                    class="w-full bg-gradient-to-r from-gray-700 to-gray-900 text-white px-4 sm:px-6 py-2.5 sm:py-3 rounded-lg sm:rounded-xl font-semibold hover:from-gray-800 hover:to-black transform hover:scale-105 transition-all duration-200 shadow-lg hover:shadow-gray-900/50 flex items-center justify-center group border border-gray-700 text-sm sm:text-base">
                                <svg class="w-4 h-4 sm:w-5 sm:h-5 mr-2 group-hover:scale-110 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                </svg>
                                Supprimer
                            </button>
                        </form>
                    </div>

                </div>

            </div>

        </div>

    </div>
</div>

{{-- Lightbox Modal --}}
<div id="lightbox" class="fixed inset-0 z-50 hidden bg-black/95 backdrop-blur-sm">
    <div class="absolute top-3 sm:top-4 right-3 sm:right-4 z-50">
        <button onclick="closeLightbox()" class="bg-red-600 hover:bg-red-700 text-white p-2 sm:p-3 rounded-full transition-all duration-200 transform hover:scale-110">
            <svg class="w-5 h-5 sm:w-6 sm:h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
            </svg>
        </button>
    </div>

    <div class="swiper lightboxSwiper h-full">
        <div class="swiper-wrapper">
            @foreach($images as $index => $image)
                <div class="swiper-slide flex items-center justify-center p-4 sm:p-8">
                    <img src="{{ asset('uploads/cars/'.$image) }}" 
                         alt="{{ $car->marque }} {{ $car->modele }} - Photo {{ $index + 1 }}" 
                         class="max-h-full max-w-full object-contain rounded-xl sm:rounded-2xl shadow-2xl">
                </div>
            @endforeach
        </div>
        
        @if($imageCount > 1)
        <div class="swiper-button-next !text-white !bg-red-600/80 !w-10 !h-10 sm:!w-14 sm:!h-14 !rounded-full hover:!bg-red-700 transition-all after:!text-xl sm:after:!text-2xl"></div>
        <div class="swiper-button-prev !text-white !bg-red-600/80 !w-10 !h-10 sm:!w-14 sm:!h-14 !rounded-full hover:!bg-red-700 transition-all after:!text-xl sm:after:!text-2xl"></div>
        @endif
        
        <div class="absolute bottom-4 sm:bottom-8 left-1/2 transform -translate-x-1/2 bg-black/50 backdrop-blur-sm px-4 sm:px-6 py-2 sm:py-3 rounded-full text-white font-semibold text-sm sm:text-base">
            <span id="current-slide">1</span> / <span id="total-slides">{{ $imageCount }}</span>
        </div>
    </div>
</div>

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
<script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>

<script>
    const imageCount = {{ $imageCount }};
    let thumbsSwiper = null;
    if (imageCount > 1) {
        thumbsSwiper = new Swiper('.thumbsSwiper', {
            spaceBetween: 10,
            slidesPerView: 3,
            freeMode: true,
            watchSlidesProgress: true,
            breakpoints: {
                640: { slidesPerView: 4 },
                1024: { slidesPerView: 4 },
            }
        });
    }

    const mainSwiper = new Swiper('.mainSwiper', {
        spaceBetween: 10,
        navigation: imageCount > 1 ? {
            nextEl: '.swiper-button-next',
            prevEl: '.swiper-button-prev',
        } : false,
        pagination: {
            el: '.swiper-pagination',
            clickable: true,
        },
        thumbs: thumbsSwiper ? { swiper: thumbsSwiper } : undefined,
        autoplay: imageCount > 1 ? { delay: 5000, disableOnInteraction: false } : false,
    });

    let lightboxSwiper;
    function openLightbox(index) {
        document.getElementById('lightbox').classList.remove('hidden');
        document.body.style.overflow = 'hidden';
        if (!lightboxSwiper) {
            lightboxSwiper = new Swiper('.lightboxSwiper', {
                navigation: imageCount > 1 ? {
                    nextEl: '.swiper-button-next',
                    prevEl: '.swiper-button-prev',
                } : false,
                keyboard: { enabled: true },
                on: {
                    slideChange: function () {
                        updateCounter(this.activeIndex + 1, imageCount);
                    },
                },
            });
        }
        lightboxSwiper.slideTo(index);
        updateCounter(index + 1, imageCount);
    }

    function closeLightbox() {
        document.getElementById('lightbox').classList.add('hidden');
        document.body.style.overflow = '';
    }

    function updateCounter(current, total) {
        document.getElementById('current-slide').textContent = current;
        document.getElementById('total-slides').textContent = total;
    }

    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape') closeLightbox();
    });

    document.getElementById('lightbox').addEventListener('click', function(e) {
        if (e.target === this) closeLightbox();
    });
</script>

<style>
    @keyframes pulse {
        0%, 100% { opacity: 1; }
        50% { opacity: .5; }
    }
    .animate-pulse {
        animation: pulse 2s cubic-bezier(0.4, 0, 0.6, 1) infinite;
    }
    .swiper-button-next::after, .swiper-button-prev::after {
        font-size: 18px !important;
        font-weight: bold;
    }
    @media (min-width: 640px) {
        .swiper-button-next::after, .swiper-button-prev::after {
            font-size: 20px !important;
        }
    }
    .swiper-pagination-bullet {
        background: white !important;
    }
    .swiper-pagination-bullet-active {
        background: #dc2626 !important;
    }
    .thumbsSwiper .swiper-slide-thumb-active {
        border-color: #dc2626 !important;
    }
</style>
@endsection