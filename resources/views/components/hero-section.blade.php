@props([
    'title' => 'Default Title',
    'subtitle' => 'Default Subtitle description goes here.',
    'videoUrl' => '',
    'posterUrl' => ''
])

<section class="relative min-h-[90vh] flex items-center justify-center px-6 lg:px-12 overflow-hidden">
    
    <!-- Background Video Container -->
    <div class="absolute inset-0 z-0 overflow-hidden bg-zinc-950">
        @if($videoUrl)
            <video 
                autoplay 
                muted 
                loop 
                playsinline 
                preload="auto"
                poster="{{ $posterUrl }}"
                class="absolute inset-0 w-full h-full object-cover opacity-40 scale-105 filter blur-[1px]"
            >
                <source src="{{ $videoUrl }}" type="video/mp4">
                Your browser does not support the video tag.
            </video>
        @endif
        
        <!-- Dark Gradient Overlay for Readability -->
        <div class="absolute inset-0 bg-gradient-to-t from-zinc-950 via-zinc-950/70 to-transparent"></div>
        <div class="absolute inset-0 bg-radial-gradient from-transparent via-zinc-950/50 to-zinc-950"></div>
    </div>

    <!-- Hero Content & Layout -->
    <div class="relative z-10 max-w-4xl mx-auto text-center space-y-8 py-20">
        
        <!-- Badge / Pill -->
        <div class="inline-flex items-center gap-2 px-3.5 py-1.5 rounded-full bg-white/10 backdrop-blur-md border border-white/10 text-xs font-medium text-indigo-300">
            <span class="flex h-2 w-2 rounded-full bg-indigo-400 animate-pulse"></span>
            v3.0 Released — Explore what's new
        </div>

        <!-- Headline -->
        <h1 class="text-4xl sm:text-6xl lg:text-7xl font-extrabold tracking-tight leading-[1.1] text-white">
            {!! $title !!}
        </h1>

        <!-- Subtitle -->
        <p class="max-w-2xl mx-auto text-lg sm:text-xl text-zinc-300 font-normal leading-relaxed">
            {{ $subtitle }}
        </p>

        <!-- Interactive CTAs -->
        <div class="flex flex-col sm:flex-row items-center justify-center gap-4 pt-4">
            <a href="{{ route('register') }}" class="w-full sm:w-auto inline-flex items-center justify-center rounded-xl bg-indigo-600 px-7 py-3.5 text-sm font-semibold text-white shadow-lg shadow-indigo-600/30 hover:bg-indigo-500 hover:scale-[1.02] active:scale-[0.98] transition-all">
                Get Started Free
            </a>
            
            <a href="#features" class="w-full sm:w-auto inline-flex items-center justify-center gap-2 rounded-xl bg-white/5 backdrop-blur-md border border-white/10 px-7 py-3.5 text-sm font-semibold text-white hover:bg-white/10 hover:border-white/20 transition-all">
                <svg class="w-4 h-4 text-zinc-400" fill="currentColor" viewBox="0 0 24 24"><path d="M8 5v14l11-7z"/></svg>
                Watch Demo
            </a>
        </div>

        <!-- Social Proof / Micro Metrics -->
        <div class="pt-12 border-t border-white/10 flex flex-wrap items-center justify-center gap-8 text-xs text-zinc-400">
            <div class="flex items-center gap-2">
                <span class="font-bold text-white text-sm">4.9/5</span> Rating across 2,000+ reviews
            </div>
            <div class="hidden sm:block text-zinc-700">•</div>
            <div class="flex items-center gap-2">
                <span class="font-bold text-white text-sm">99.99%</span> Uptime guarantee
            </div>
            <div class="hidden sm:block text-zinc-700">•</div>
            <div class="flex items-center gap-2">
                <span class="font-bold text-white text-sm">50k+</span> Active developers
            </div>
        </div>

    </div>
</section>