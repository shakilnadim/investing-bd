<x-VisitorLayout :news="$news">
    <x-slot name="title"> {{ $news->title }} | Investing BD</x-slot>

    <x-slot name="links">
        <script type="module" src="{{ asset('js/editor.js') }}"></script>
    </x-slot>

    <main>
        <article>
            <x-visitor.news-details :news="$news"></x-visitor.news-details>
        </article>
    </main>
</x-VisitorLayout>
