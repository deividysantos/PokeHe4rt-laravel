<x-app-layout>
    <x-slot name="header">
        Capture a pokemon
    </x-slot>

    <div id="pokemonName" class="max-w-md mx-auto mt-6 px-6 py-4">
        <x-auth-validation-errors class="mb-4" :errors="$errors" />
        <form class="flex flex-col flex-wrap" action="{{route('capturePokemon')}}" method="POST">
            @csrf
            <x-label>Name</x-label>
            <x-input id="inputName" name="pokemonName" type="text" required/>

            <x-button class=" mt-5 w px-4">
                Capture
            </x-button>
        </form>
    </div>

    <div class="max-w-max mx-auto bg-white rounded grid grid-cols-2 sm:grid-cols-4 lg:grid-cols-6">
        @foreach($pokemons as $pokemon)
            <div class="flex flex-col flex-wrap capitalize items-center ml-4 mt-4">
                <button onclick="copyPokemonName('{{$pokemon->name}}')">
                    <img class="w-32 h-32" src="{{$pokemon->image_url}}" alt="{{$pokemon->name}}">
                </button>


                <div class="flex flex-row flex-wrap justify-center">
                        <p>{{$pokemon->name}}</p>
                </div>
            </div>
        @endforeach
    </div>

    <div class="flex flex-row mx-auto w-8 mt-4 pb-8">
        <div>
            <a
                class="px-4 mr-4 {{$paginate == 1 ? 'bg-gray-200' : 'bg-white'}}" href="{{ $paginate != 1 ? route('capturePokemonView', $paginate - 1) : ''}}">
                <
            </a>
        </div>

        {{$paginate}}

        <div>
            <a class="px-4 ml-4 bg-white" href="{{route('capturePokemonView', $paginate + 1)}}"> > </a>
        </div>
    </div>

    <x-slot name="script">
        <script>
            function copyPokemonName(pokemonName)
            {
                let input = document.getElementById('inputName');

                input.value = pokemonName.charAt(0).toUpperCase() + pokemonName.slice(1);
            }
        </script>
    </x-slot>

</x-app-layout>
