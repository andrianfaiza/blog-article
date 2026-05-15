<x-app-layout>
    <form action="{{route('artikel.store')}}" method="POST">
        @csrf
        
        @include('artikel._form')
    </form>
</x-app-layout>