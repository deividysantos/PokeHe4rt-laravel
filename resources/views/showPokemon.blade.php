<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="rounded p-8 shadow-sm sm:rounded-lg bg-white">
                <div class="py-2">
                    <x-auth-validation-errors class="mb-4 max-w-max mx-auto" :errors="$errors" />
                    <form class="flex flex-row justify-center" action="{{route('nicknamePokemon')}}" method="POST">
                        @csrf
                        <div>
                            <x-label for="nickname">Nickname</x-label>
                            @if($trainerPokemon->nickName != '')
                                <x-input id="nickname" name="nicknamePokemon" type="text" value="{{$trainerPokemon->nickName}}"/>
                            @else
                                <x-input id="nickname" name="nicknamePokemon" type="text" value="{{ucfirst($payload['name'])}}"/>
                            @endif

                            <input type="hidden" name="trainerPokemonId" value="{{$trainerPokemon->id}}">
                        </div>
                        <div class="ml-2 mt-6">
                            <button class="w-8 h-8" onclick="submit()"><x-iconpark-saveone-o/></button>
                        </div>
                    </form>
                </div>

                <img class="mx-auto w-40 h-40" src="{{$payload['image_url']}}" alt="{{$payload['name']}}">
                <div class="flex flex-row justify-evenly text-left flex-wrap">

                    <div class="bg-gray-100 rounded-lg w-40 mt-4 ml-2">
                        <h3 class="text-center bg-indigo-300 rounded-lg py-2">Types</h3>
                            <div class="p-2">
                                @foreach($payload['types'] as $type)
                                    <p class="capitalize">{{$type}}</p>
                                @endforeach
                            </div>
                    </div>

                    <div class="bg-gray-100 rounded-lg w-40 mt-4 ml-2">
                        <h3 class="text-center bg-indigo-300 rounded-lg py-2">Abilities</h3>
                        <div class="p-2">
                            @foreach($payload['abilities'] as $ability)
                                <p class="capitalize">{{$ability}}</p>
                            @endforeach
                        </div>
                    </div>

                    <div class="bg-gray-100 rounded-lg w-40 mt-4 ml-2">
                        <h3 class="text-center bg-indigo-300 rounded-lg py-2">Atributes</h3>
                        <div class="p-2">
                            <p>Height: {{$payload['height']}}</p>
                            <p>Weight: {{$payload['weight']}}</p>
                        </div>

                    </div>

                    <div class="bg-gray-100 rounded-lg w-40 mt-4 ml-2">
                        <h3 class="text-center bg-indigo-300 rounded-lg py-2">Satus</h3>
                        <div class="p-2">
                            @foreach($payload['stats'] as $stat => $value)
                                <p class="capitalize">{{$stat}}: {{$value}}</p>
                            @endforeach
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
