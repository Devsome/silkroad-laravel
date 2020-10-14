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

    'accepted' => 'El :attribute debe ser aceptado.',
    'active_url' => 'El :attribute no es un URL válido.',
    'after' => 'El :attribute debe ser una fecha posterior a :date.',
    'after_or_equal' => 'El :attribute debe ser una fecha posterior o igual a :date.',
    'alpha' => 'El :attribute solo puede contener letras.',
    'alpha_dash' => 'El :attribute solo puede contener letras, números, guiones y guiones bajos.',
    'alpha_num' => 'El :attribute solo puede contener letras y números.',
    'array' => 'El :attribute debe ser un array.',
    'before' => 'El :attribute debe ser una fecha previa a :date.',
    'before_or_equal' => 'El :attribute debe ser una fecha previa o igual a :date.',
    'between' => [
        'numeric' => 'El :attribute debe estar entre :min y :max.',
        'file' => 'El :attribute debe estar entre :min y :max kilobytes.',
        'string' => 'El :attribute debe estar entre :min y :max caracteres.',
        'array' => 'El :attribute debe tener entre :min y :max items.',
    ],
    'boolean' => 'El campo :attribute debe ser verdadero (true) o falso (false).',
    'confirmed' => 'La confirmación :attribute no coincide.',
    'date' => 'El :attribute no es una fecha válida.',
    'date_equals' => 'La :attribute debe ser una fecha igual a :date.',
    'date_format' => 'La :attribute no coincide con el formato :format.',
    'different' => 'El :attribute y :other deben ser diferentes.',
    'digits' => 'El :attribute debe ser :digits dígitos.',
    'digits_between' => 'El :attribute debe tener entre :min y :max dígitos.',
    'dimensions' => 'La :attribute tiene dimensiones de imágenes inválidas.',
    'distinct' => 'El campo :attribute tiene un valor duplicado.',
    'email' => 'El :attribute debe ser una dirección de correo electrónico válida.',
    'ends_with' => 'el :attribute debe terminar con uno de los siguientes: :values',
    'exists' => 'El :attribute seleccionado no es válido.',
    'file' => 'El :attribute debe ser un archivo.',
    'filled' => 'El campo :attribute debe tener un valor.',
    'gt' => [
        'numeric' => 'El :attribute debe ser mayor que :value.',
        'file' => 'El :attribute debe ser mayor a :value kilobytes.',
        'string' => 'El :attribute debe ser mayor a :value caracteres.',
        'array' => 'El :attribute debe tener más de :value items.',
    ],
    'gte' => [
        'numeric' => 'El :attribute debe ser mayor o igual que :value.',
        'file' => 'El :attribute debe ser mayor o igual a :value kilobytes.',
        'string' => 'El :attribute debe ser mayor o igual a :value caracteres.',
        'array' => 'El :attribute debe tener :value items o más.',
    ],
    'image' => 'El :attribute debe ser una imagen.',
    'in' => 'El :attribute seleccionado no es válido.',
    'in_array' => 'El campo :attribute no existe en :other.',
    'integer' => 'El :attribute debe ser un entero.',
    'ip' => 'La :attribute debe ser una dirección IP válida.',
    'ipv4' => 'La :attribute debe ser una dirección IPv4 válida.',
    'ipv6' => 'La :attribute debe ser una dirección IPv6 válida.',
    'json' => 'El :attribute debe ser una string JSON válida.',
    'lt' => [
        'numeric' => 'El :attribute debe ser menor que :value.',
        'file' => 'El :attribute debe ser menor a :value kilobytes.',
        'string' => 'El :attributedebe tener menos de :value caracteres.',
        'array' => 'El :attribute debe tener menos de :value items.',
    ],
    'lte' => [
        'numeric' => 'El :attribute debe ser menor o igual que :value.',
        'file' => 'El :attribute debe ser menor o igual a :value kilobytes.',
        'string' => 'El :attribute debe ser menor o igual a :value caracteres.',
        'array' => 'El :attribute no debe tener más de :value items.',
    ],
    'max' => [
        'numeric' => 'El :attribute no debe ser mayor a :max.',
        'file' => 'El :attribute no debe ser mayor a :max kilobytes.',
        'string' => 'El :attribute no debe ser mayor a :max caracteres.',
        'array' => 'El :attribute no debe tener más de :max items.',
    ],
    'mimes' => 'El :attribute debe ser un archivo de tipo: :values.',
    'mimetypes' => 'El :attribute debe ser un archivo de tipo: :values.',
    'min' => [
        'numeric' => 'El :attribute debe ser al menos :min.',
        'file' => 'El :attribute debe ser al menos :min kilobytes.',
        'string' => 'El :attribute debe tener al menos :min caracteres.',
        'array' => 'El :attribute debe tener al menos :min items.',
    ],
    'not_in' => 'El :attribute seleccionado no es válido.',
    'not_regex' => 'El formato :attribute no es válido.',
    'numeric' => 'El :attribute debe ser un número.',
    'present' => 'El campo :attribute debe estar presente.',
    'regex' => 'El formato :attribute no es válido.',
    'required' => 'El campo :attribute se requiere.',
    'required_if' => 'El campo :attribute se requiere cuando :other es :value.',
    'required_unless' => 'El campo :attribute se requiere a menos que :other esté en :values.',
    'required_with' => 'El campo :attribute se requiere cuando :values está presente.',
    'required_with_all' => 'El campo :attribute se requiere cuando :values están presentes.',
    'required_without' => 'El campo :attribute se requiere cuando :values no está presente.',
    'required_without_all' => 'El campo :attribute se requiere cuando ninguno de :values están presentes.',
    'same' => 'El :attribute y :other deben coincidir.',
    'size' => [
        'numeric' => 'El :attribute debe ser :size.',
        'file' => 'El :attribute debe ser :size kilobytes.',
        'string' => 'El :attribute debe ser :size caracteres.',
        'array' => 'El :attribute debe contener :size items.',
    ],
    'starts_with' => 'El :attribute debe iniciar con uno de los siguientes: :values',
    'string' => 'El :attribute debe ser una string.',
    'timezone' => 'El :attribute debe ser una zona válida.',
    'unique' => 'El :attribute ya ha sido ocupado.',
    'uploaded' => 'El :attribute no se pudo subir.',
    'url' => 'El formato :attribute no es válido.',
    'uuid' => 'el :attribute debe ser un UUID válido.',

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
            'rule-name' => 'custom-message',
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
        'search-term' => 'Término de búsqueda'
    ],

];
