<x-VisitorLayout :news="$news">
    <x-slot name="title"> {{ $news->title }} | Investing BD</x-slot>

    <x-slot name="links">
        <script type="module" src="{{ asset('js/editor.js') }}"></script>
    </x-slot>

    <div class="grid md:grid-cols-4 my-4 gap-4">
        <main class="col-span-4 sm:col-span-3">
            <article>
                <x-visitor.news-details :news="$news"></x-visitor.news-details>
            </article>
        </main>
        <aside class="col-span-4 sm:col-span-1">
            <x-visitor.sidebar></x-visitor.sidebar>
        </aside>
    </div>
</x-VisitorLayout>
