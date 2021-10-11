<x-VisitorLayout :news="$news">
    <x-slot name="title"> {{ $news->title }} | Investing BD</x-slot>
    <main>
        <article>
            <x-visitor.news-details :news="$news"></x-visitor.news-details>
        </article>
    </main>
</x-VisitorLayout>
