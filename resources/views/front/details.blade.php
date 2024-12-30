@extends('layouts.app')

@section('content')
    <header class="flex flex-col items-center gap-[50px] mt-[70px]">
        <div id="Headline" class="max-w-[1130px] mx-auto flex flex-col gap-4 items-center">
            <p class="w-fit text-[#A3A6AE]">{{ $articleNews->created_at->format('M d, Y') }} •
                {{ $articleNews->category->name }}</p>
            <h1 id="Title" class="font-bold text-[46px] leading-[60px] text-center two-lines">{{ $articleNews->name }}
            </h1>
            <div class="flex items-center justify-center gap-[70px]">
                <a id="Author" href="{{ route('front.author', $articleNews->author->slug) }}" class="w-fit h-fit">
                    <div class="flex items-center gap-3">
                        <div class="w-10 h-10 rounded-full overflow-hidden">
                            <img src="{{ asset('storage/' . $articleNews->author->avatar) }}"
                                class="object-cover w-full h-full" alt="avatar">
                        </div>
                        <div class="flex flex-col">
                            <p class="font-semibold text-sm leading-[21px]">{{ $articleNews->author->name }}</p>
                            <p class="text-xs leading-[18px] text-[#A3A6AE]">{{ $articleNews->author->occupation }}</p>
                        </div>
                    </div>
                </a>
            </div>
        </div>
        <div class="w-full h-[500px] flex shrink-0 overflow-hidden">
            <img src="{{ asset('storage/' . $articleNews->thumbnail) }}" class="object-cover w-full h-full"
                alt="cover thumbnail">
        </div>
    </header>
    <section id="Article-container" class="max-w-[1130px] mx-auto flex gap-20 mt-[50px]">
        <article id="Content-wrapper">
            {!! $articleNews->content !!}
        </article>
        <div class="side-bar flex flex-col w-[300px] shrink-0 gap-10">
            <div class="ads flex flex-col gap-3 w-full">
                <a href="{{ $squareads1->link }}" target="_blank">
                    <img src="{{ asset('storage/' . $squareads1->thumbnail) }}" class="object-contain w-full h-full"
                        alt="ads" />
                </a>
                <p class="font-medium text-sm leading-[21px] text-[#A3A6AE] flex gap-1">
                    Our Advertisement <a href="#" class="w-[18px] h-[18px]"><img
                            src="{{ asset('assets/images/icons/message-question.svg') }}" alt="icon" /></a>
                </p>
            </div>
            <div id="More-from-author" class="flex flex-col gap-4">
                <p class="font-bold">More From Author</p>
                @forelse($author_news as $news)
                    <a href="{{ route('front.details', $news->slug) }}" class="card-from-author">
                        <div
                            class="rounded-[20px] ring-1 ring-[#EEF0F7] p-[14px] flex gap-4 hover:ring-2 hover:ring-[#FF6B18] transition-all duration-300">
                            <div class="w-[70px] h-[70px] flex shrink-0 overflow-hidden rounded-2xl">
                                <img src="{{ asset('storage/' . $news->thumbnail) }}" class="object-cover w-full h-full"
                                    alt="thumbnail">
                            </div>
                            <div class="flex flex-col gap-[6px]">
                                <p class="line-clamp-2 font-bold">{{ substr($news->name, 0, 30) }}
                                    {{ strlen($news->name) > 30 ? '...' : '' }}</p>
                                <p class="text-xs leading-[18px] text-[#A3A6AE]">{{ $news->created_at->format('M d, Y') }}
                                    • {{ $news->category->name }}</p>
                            </div>
                        </div>
                    </a>
                @empty
                    <p>There is no news in this author</p>
                @endforelse
            </div>
            <div class="ads flex flex-col gap-3 w-full">
                <a href="{{ $squareads2->link }}" target="_blank">
                    <img src="{{ asset('storage/' . $squareads2->thumbnail) }}" class="object-contain w-full h-full"
                        alt="ads" />
                </a>
                <p class="font-medium text-sm leading-[21px] text-[#A3A6AE] flex gap-1">
                    Our Advertisement <a href="#" class="w-[18px] h-[18px]"><img
                            src="{{ asset('assets/images/icons/message-question.svg') }}" alt="icon" /></a>
                </p>
            </div>
        </div>
    </section>
    <section id="Advertisement" class="max-w-[1130px] mx-auto flex justify-center mt-[70px]">
        <div class="flex flex-col gap-3 shrink-0 w-fit">
            <a href="{{ $bannerads->link }}" target="_blank">
                <div class="w-[900px] h-[120px] flex shrink-0 border border-[#EEF0F7] rounded-2xl overflow-hidden">
                    <img src="{{ asset('storage/' . $bannerads->thumbnail) }}" class="object-cover w-full h-full"
                        alt="ads" />
                </div>
            </a>
            <p class="font-medium text-sm leading-[21px] text-[#A3A6AE] flex gap-1">
                Our Advertisement <a href="#" class="w-[18px] h-[18px]"><img
                        src="{{ asset('assets/images/icons/message-question.svg') }}" alt="icon" /></a>
            </p>
        </div>
    </section>
    <section id="Up-to-date" class="w-full flex justify-center mt-[70px] py-[50px] bg-[#F9F9FC]">
        <div class="max-w-[1130px] mx-auto flex flex-col gap-[30px]">
            <div class="flex justify-between items-center">
                <h2 class="font-bold text-[26px] leading-[39px]">
                    Other News You <br />
                    Might Be Interested
                </h2>
            </div>
            <div class="grid grid-cols-3 gap-[30px]">
                @forelse($articles as $article)
                    <a href="details.html" class="card">
                        <div
                            class="flex flex-col gap-4 p-[26px_20px] transition-all duration-300 ring-1 ring-[#EEF0F7] hover:ring-2 hover:ring-[#FF6B18] rounded-[20px] overflow-hidden bg-white">
                            <div class="thumbnail-container h-[200px] relative rounded-[20px] overflow-hidden">
                                <div
                                    class="badge absolute left-5 top-5 bottom-auto right-auto flex p-[8px_18px] bg-white rounded-[50px]">
                                    <p class="text-xs leading-[18px] font-bold">{{ $article->category->name }}</p>
                                </div>
                                <img src="{{ asset('storage/' . $article->thumbnail) }}" alt="thumbnail photo"
                                    class="w-full h-full object-cover" />
                            </div>
                            <div class="flex flex-col gap-[6px]">
                                <h3 class="text-lg leading-[27px] font-bold">{{ substr($article->name, 0, 70) }}
                                    {{ strlen($article->name) > 70 ? '...' : '' }}</h3>
                                <p class="text-sm leading-[21px] text-[#A3A6AE]">
                                    {{ $article->created_at->format('M d, Y') }}
                                </p>
                            </div>
                        </div>
                    </a>
                @empty
                    <p>Kosong</p>
                @endforelse
            </div>
        </div>
    </section>
@endsection
