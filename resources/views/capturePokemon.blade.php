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

    <div class="max-w-max mx-auto bg-white rounded grid grid-cols-3 sm:grid-cols-4 lg:grid-cols-6 shadow-lg">
        @foreach($pokemons as $pokemon)
            <div class="flex flex-col flex-wrap
            rounded items-center m-4 duration-100 shadow-lg hover:shadow-gray-400">
                <button class="capitalize" onclick="copyPokemonName('{{$pokemon->name}}')">
                    <img class="w-40 h-40 p-4 duration-200 hover:p-0" src="{{$pokemon->image_url}}" alt="{{$pokemon->name}}">

                    <p class="m-auto ">{{$pokemon->name}}</p>
                </button>
            </div>
        @endforeach
    </div>

    <div class="flex flex-row mx-auto w-8 mt-4 pb-8">
        <div>
            <a href="{{ $paginate != 1 ? route('capturePokemonView', $paginate - 1) : ''}}">
                <x-button class="{{$paginate == 1 ? 'bg-gray-300 hover:bg-gray-300' : ''}}"> < </x-button>
            </a>
        </div>

        <div class="px-4 py-1 bg-gray-100">
            {{$paginate}}
        </div>


        <div>
            <a href="{{route('capturePokemonView', $paginate + 1)}}"> <x-button> > </x-button> </a>
        </div>
    </div>

    <x-slot name="script">
        <script>
            function copyPokemonName(pokemonName)
            {
                let input = document.getElementById('inputName');

                input.value = pokemonName.charAt(0).toUpperCase() + pokemonName.slice(1);

                windowToTop();
            }

            function windowToTop()
            {
                window.scrollTo({
                    top: -100,
                    left: 0,
                    behavior: 'smooth'
                });
            }
        </script>
    </x-slot>

</x-app-layout>
