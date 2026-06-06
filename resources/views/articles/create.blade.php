<x-app-layout>
    <form action="{{route('articles.store')}}" method="POST">
        @csrf
        
        @include('articles._form')
    </form>
</x-app-layout>
