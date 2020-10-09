<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | The following language lines contain the default error messages used by
    | the validator class. Some of these rules have multiple versions such
    | as the size rules. Feel free to tweak each of these messages here.
    |
    */

    'accepted' => ' :attribute deve ser aceito.',
    'active_url' => ' :attribute não é uma URL válida.',
    'after' => ' :attribute deve ser uma data após :date.',
    'after_or_equal' => ' :attribute deve ser uma data igual ou após :date.',
    'alpha' => ' :attribute só deve conter letras.',
    'alpha_dash' => ' :attribute só deve conter letras, números e travessões e undelines.',
    'alpha_num' => ' :attribute só deve conter letras e números.',
    'array' => ' :attribute deve ser um array.',
    'before' => ' :attribute deve ser uma data antes de :date.',
    'before_or_equal' => ' :attribute deve ser uma data igual ou antes de :date.',
    'between' => [
        'numeric' => ' :attribute deve estar entre :min e :max.',
        'file' => ' :attribute deve estar entre :min e :max kilobytes.',
        'string' => ' :attribute deve estar entre :min e :max caracteres.',
        'array' => ' :attribute deve estar entre :min e :max itens.',
    ],
    'boolean' => 'O campo :attribute deve ser verdadeiro ou falso.',
    'confirmed' => 'A confirmação :attribute não combina.',
    'date' => 'O :attribute não é uma data válida.',
    'date_equals' => ' :attribute deve ser uma data igual a :date.',
    'date_format' => ' :attribute não combina com o formato :format.',
    'different' => ' :attribute e :other devem ser diferentes.',
    'digits' => ' :attribute deve ter :digits dígitos.',
    'digits_between' => ' :attribute deve ser entre :min e :max dígitos.',
    'dimensions' => ' :attribute tem uma imagem com dimensões inválidas.',
    'distinct' => 'O campo :attribute tem um valor duplicado.',
    'email' => ' :attribute deve ser um enderço de e-mail válido.',
    'ends_with' => ' :attribute deve terminar com alguns dos: :values',
    'exists' => ' :attribute inválido.',
    'file' => ' :attribute deve ser um arquivo.',
    'filled' => ' :attribute deve ser preenchido.',
    'gt' => [
        'numeric' => ' :attribute deve ser maior que :value.',
        'file' => ' :attribute deve ser maior que :value kilobytes.',
        'string' => ' :attribute deve ser maior que :value caracteres.',
        'array' => ' :attribute deve ter mais de :value itens.',
    ],
    'gte' => [
        'numeric' => ' :attribute deve ser maior ou igual a :value.',
        'file' => ' :attribute deve ser maior ou igual a :value kilobytes.',
        'string' => ' :attribute deve ser maior ou igual :value caracteres.',
        'array' => ' :attribute deve ter :value ou mais itens.',
    ],
    'image' => ' :attribute deve ser uma imagem.',
    'in' => 'O :attribute selecionado é inválido.',
    'in_array' => 'O campo :attribute não existe em :other.',
    'integer' => ' :attribute deve ser um inteiro.',
    'ip' => ' :attribute deve ter um endereço de IP válido.',
    'ipv4' => ' :attribute deve ter um endereço IPv4 válido.',
    'ipv6' => ' :attribute deve ter um enderço IPv6 válido.',
    'json' => ' :attribute deve ter um JSON válido.',
    'lt' => [
        'numeric' => ' :attribute deve ser menor que :value.',
        'file' => ' :attribute deve ser menor que :value kilobytes.',
        'string' => ' :attribute deve ser menor que :value caracteres.',
        'array' => ' :attribute deve ser menor que :value itens.',
    ],
    'lte' => [
        'numeric' => ' :attribute deve ser menor ou igual a :value.',
        'file' => ' :attribute deve ser menor ou igual a :value kilobytes.',
        'string' => ' :attribute deve ser menor ou igual a :value caracteres.',
        'array' => ' :attribute não deve ter mais que :value itens.',
    ],
    'max' => [
        'numeric' => ' :attribute não pode ser maior que :max.',
        'file' => ' :attribute não pode ser maior que :max kilobytes.',
        'string' => ' :attribute não pode ser maior que :max caracteres.',
        'array' => ' :attribute não pode ter mais que :max itens.',
    ],
    'mimes' => ' :attribute deve ser um arquivo do tipo: :values.',
    'mimetypes' => ' :attribute deve ser um arquivo do tipo: :values.',
    'min' => [
        'numeric' => ' :attribute deve ser pelo menos :min.',
        'file' => ' :attribute deve ter pelo menos :min kilobytes.',
        'string' => ' :attribute deve ter pelo menos :min caracteres.',
        'array' => ' :attribute deve ter pelo menos :min itens.',
    ],
    'not_in' => 'O :attribute selecionado é inválido.',
    'not_regex' => 'O formato :attribute é inválido.',
    'numeric' => ' :attribute deve ser um número.',
    'present' => ' :attribute deve ser preenchido.',
    'regex' => 'O formato de :attribute é inválido.',
    'required' => ' :attribute é necessário.',
    'required_if' => ' :attribute é necessário quand :other é :value.',
    'required_unless' => ' :attribute é necessário, a menos que :other esteja em :values.',
    'required_with' => ' :attribute é necessário quano :values está preenchido.',
    'required_with_all' => ' :attribute é necessário quando :values está preenchido.',
    'required_without' => ' :attribute é necessário quando :values não está preenchido.',
    'required_without_all' => ' :attribute é necessário quando nenhum dos :values está preenchido.',
    'same' => ' :attribute e :other devem combinar.',
    'size' => [
        'numeric' => ' :attribute deve ter :size.',
        'file' => ' :attribute deve ter :size kilobytes.',
        'string' => ' :attribute deve ter :size caracteres.',
        'array' => ' :attribute deve conter :size itens.',
    ],
    'starts_with' => ' :attribute deve começar com um dos: :values',
    'string' => ' :attribute deve ser uma string.',
    'timezone' => ' :attribute deve ser uma zona válida.',
    'unique' => ' :attribute já foi colocado.',
    'uploaded' => ' :attribute falhou no upload.',
    'url' => ' :attribute tem um formato inválido.',
    'uuid' => ' :attribute deve ser um UUID válido.',

    /*
    |--------------------------------------------------------------------------
    | Custom Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | Here you may specify custom validation messages for attributes using the
    | convention "attribute.rule" to name the lines. This makes it quick to
    | specify a specific custom language line for a given attribute rule.
    |
    */

    'custom' => [
        'attribute-name' => [
            'rule-name' => 'Está tudo certo!',
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Custom Validation Attributes
    |--------------------------------------------------------------------------
    |
    | The following language lines are used to swap our attribute placeholder
    | with something more reader friendly such as "E-Mail Address" instead
    | of "email". This simply helps us make our message more expressive.
    |
    */

    'attributes' => [
        'search-term' => 'Search term'
    ],

];
