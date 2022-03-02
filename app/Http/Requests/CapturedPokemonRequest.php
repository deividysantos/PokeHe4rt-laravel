<?php

namespace App\Http\Requests;

use App\Exceptions\PokemonNameNotExist;
use App\Services\Contract\IPokemonService;
use Illuminate\Foundation\Http\FormRequest;

class CapturedPokemonRequest extends FormRequest
{
    public function __construct(
        private IPokemonService $pokemonService,
    )
    {
        parent::__construct();
    }


    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules():array
    {
        return [
            'pokemonName' => ['required', 'max:55', 'string']
        ];
    }

    public function withValidator($validator)
    {
        $validator->after(function($validator) {

            try {
                $pokemonName = $validator->getData()['pokemonName'];

                if(is_numeric($pokemonName))
                    throw new PokemonNameNotExist('The pokemon "'. $pokemonName . '" not exist!');

                $this->pokemonService->getDataPokemon($validator->getData()['pokemonName']);
            }catch (PokemonNameNotExist $e)
            {
                $validator
                    ->errors()
                    ->add('pokemonName',
                        $e->getMessage()
                    );
            }
        });

    }
}
