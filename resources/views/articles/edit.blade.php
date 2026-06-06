<x-app-layout>
    <form action="{{route('articles.update', $article->id)}}" method="post">
        @csrf
        @method('PUT')

        @include('articles._form')
    </form>
</x-app-layout>
