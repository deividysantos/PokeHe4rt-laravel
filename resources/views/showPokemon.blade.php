<x-app-layout>
    <div class="text-center mx-auto mt-40  w-ful h-full bg-indigo-100">
        <div class="border-4 border-indigo-100">
            <div class="py-2">
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
                    <div class="ml-2">
                        <button class="w-8 h-8" onclick="submit()"><x-iconpark-saveone-o class=" pt-6"/></button>
                    </div>
                </form>
            </div>
            <img class="mx-auto w-40 h-40" src="{{$payload['image_url']}}" alt="{{$payload['name']}}">
        </div>
        <div class="flex flex-row justify-evenly text-left">
            <div class="">
                <h3 >Types: </h3>
                @foreach($payload['types'] as $type)
                    <p class="capitalize ml-3">{{$type}}</p>
                @endforeach
            </div>
            <div>
                <p>Height: {{$payload['height']}}</p>
                <p>Weight: {{$payload['weight']}}</p>
            </div>
            <div>
                <h3>Abilities: </h3>
                <div>
                    @foreach($payload['abilities'] as $ability)
                        <p class="capitalize ml-3">{{$ability}}</p>
                    @endforeach
                </div>
            </div>
            <div>
                <h3>Stats:</h3>
                <div>
                    @foreach($payload['stats'] as $stat => $value)
                        <p class="capitalize ml-3">{{$stat}}: {{$value}}</p>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
