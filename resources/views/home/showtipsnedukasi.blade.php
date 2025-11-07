@extends('home.navbar')

@section('content')
<main class="min-h-screen bg-gray-50">
    <!-- Content Section -->
    <section class="py-12">
        <div class="container mx-auto px-4">
            <div class="max-w-4xl mx-auto">
                <div class="mb-8">
                    <a href="{{ route('home') }}" class="text-blue-600 hover:text-blue-800 text-sm font-medium transition flex items-center mb-4">
                        Kembali ke Beranda
                    </a>
                </div>

                <!-- Page Title -->
                <div class="mb-8">
                    <h1 class="text-4xl md:text-5xl font-bold text-gray-900 mb-4">
                        {{ $tip->judul_tipsnedukasi }}
                    </h1>
                </div>

                <!-- Featured Image -->
                @if($tip->image)
                <div class="mb-8 rounded-lg overflow-hidden shadow-lg">
                    <img src="{{ asset('storage/' . $tip->image) }}" 
                         alt="{{ $tip->judul_tipsnedukasi }}" 
                         class="w-full h-auto object-cover">
                </div>
                @endif

                <!-- Article Content -->
                <article class="bg-white rounded-lg shadow-sm p-8 md:p-12">
                    
                    <!-- Introduction -->
                    @if($tip->excerpt)
                    <div class="bg-blue-50 border-l-4 border-blue-500 p-6 mb-8">
                        <p class="text-lg text-gray-700 leading-relaxed">
                            {{ $tip->excerpt }}
                        </p>
                    </div>
                    @endif

                    <!-- Main Content -->
                    <div class="prose prose-lg max-w-none">
                        {!! $tip->konten_tipsnedukasi !!}
                    </div>

                    <!-- Tags -->
                    @if(isset($tip->tags) && count($tip->tags) > 0)
                    <div class="mt-8 pt-8 border-t border-gray-200">
                        <div class="flex flex-wrap gap-2">
                            <span class="text-gray-600 font-medium">Tags:</span>
                            @foreach($tip->tags as $tag)
                            <a href="{{ route('tips.tag', $tag->slug) }}" 
                               class="px-3 py-1 bg-gray-100 text-gray-700 text-sm rounded-full hover:bg-gray-200 transition">
                                #{{ $tag->name }}
                            </a>
                            @endforeach
                        </div>
                    </div>
                    @endif

                </article>

                <!-- Related Tips -->
                @if(isset($relatedTips) && count($relatedTips) > 0)
                <section class="mt-16">
                    <h2 class="text-3xl font-bold text-gray-900 mb-8">Tips Terkait</h2>
                    <div class="grid md:grid-cols-3 gap-6">
                        @foreach($relatedTips as $related)
                        <a href="{{ route('home.showtipsnedukasi', $related->id) }}" 
                           class="bg-white rounded-lg shadow-sm overflow-hidden hover:shadow-md transition group">
                            @if($related->image)
                            <img src="{{ asset('storage/' . $related->image) }}" 
                                 alt="{{ $related->judul_tipsnedukasi }}" 
                                 class="w-full h-48 object-cover group-hover:scale-105 transition duration-300">
                            @endif
                            <div class="p-6">
                                <h3 class="font-bold text-gray-900 mb-2 group-hover:text-blue-500 transition">
                                    {{ $related->judul_tipsnedukasi }}
                                </h3>
                                @if($related->excerpt)
                                <p class="text-gray-600 text-sm line-clamp-3">
                                    {{ $related->excerpt }}
                                </p>
                                @endif
                            </div>
                        </a>
                        @endforeach
                    </div>
                </section>
                @endif

            </div>
        </div>
    </section>
</main>

@endsection
