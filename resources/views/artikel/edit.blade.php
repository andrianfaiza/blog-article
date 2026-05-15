<x-app-layout>
    <form action="{{route('artikel.update', $artikel->id)}}" method="post">
        @csrf
        @method('PUT')

        @include('artikel._form')
    </form>
</x-app-layout>