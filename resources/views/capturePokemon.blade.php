<x-app-layout>
    <x-slot name="header">
        Capture a pokemon
    </x-slot>

    <div class=" max-w-md mx-auto mt-6 px-6 py-4">
        <form class="flex flex-col flex-wrap" action="{{route('capturePokemon')}}" method="POST">
            @csrf
            <x-label>Name</x-label>
            <x-input name="pokemonName" type="text" required/>

            <x-button class=" mt-5 w px-4">
                Capture
            </x-button>
        </form>

    </div>

</x-app-layout>
