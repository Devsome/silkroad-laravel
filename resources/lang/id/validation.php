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

    'accepted' => ':attribute harus diterima.',
    'active_url' => ':attribute URL tidak valid.',
    'after' => ':attribute tanggal harus setelah :date.',
    'after_or_equal' => ':attribute harus tanggal setelah atau sama dengan :date.',
    'alpha' => ':attribute hanya boleh berisi huruf.',
    'alpha_dash' => ':attribute hanya boleh berisi huruf, angka, tanda hubung, dan garis bawah.',
    'alpha_num' => ':attribute hanya boleh berisi huruf dan angka.',
    'array' => ':attribute harus berupa larik.',
    'before' => ':attribute tanggal harus setelah :date.',
    'before_or_equal' => ':attribute harus tanggal setelah atau sama dengan :date.',
    'between' => [
        'numeric' => ':attribute harus di antara :min dan :max.',
        'file' => ':attribute harus di antara :min dan :max kilobytes.',
        'string' => ':attribute harus di antara :min dan :max karakter.',
        'array' => ':attribute harus ada di antara :min dan :max items.',
    ],
    'boolean' => ':attributebidang harus benar atau salah.',
    'confirmed' => ':attribute konfirmasi tidak cocok.',
    'date' => ':attribute bukan tanggal yang valid.',
    'date_equals' => ':attribute harus tanggal yang sama dengan :date.',
    'date_format' => ':attribute tidak sesuai dengan format :format.',
    'different' => ':attribute dan :other harus berbeda.',
    'digits' => ':attribute harusnya :digits digits.',
    'digits_between' => ':attribute harus di antara :min dan :max digit.',
    'dimensions' => ':attribute memiliki dimensi gambar yang tidak valid.',
    'distinct' => ':attribute bidang memiliki nilai duplikat.',
    'email' => ':attribute Harus alamat surel yang valid.',
    'ends_with' => ':attribute harus diakhiri dengan salah satu dari berikut ini: :values',
    'exists' => ':attribute yang dipilih tidak valid.',
    'file' => ':attribute harus berupa berkas.',
    'filled' => ':attribute bidang harus memiliki nilai.',
    'gt' => [
        'numeric' => ':attribute harus lebih besar dari :value.',
        'file' => ':attribute harus lebih besar dari :value kilobytes.',
        'string' => ':attribute harus lebih besar dari :value karakter.',
        'array' => ':attribute harus memiliki lebih dari :value items.',
    ],
    'gte' => [
        'numeric' => ' :attribute harus lebih besar dari atau sama dengan :value.',
        'file' => ' :attribute harus lebih besar dari atau sama dengan :value kilobytes.',
        'string' => ' :attribute harus lebih besar dari atau sama dengan :value karakter.',
        'array' => ' :attribute harus memiliki :value item atau lebih.',
    ],
    'image' => ' :attribute harus berupa gambar.',
    'in' => ' :attribute yang dipilih tidak valid.',
    'in_array' => ' :attribute ini tidak ada :other.',
    'integer' => ':attribute harus berupa angka.',
    'ip' => ':attribute harus berupa alamat IP valid.',
    'ipv4' => ':attribute harus berupa alamat IPv4 valid.',
    'ipv6' => ':attribute harus berupa alamat IPv6 vali.',
    'json' => ':attribute harus JSON string yang valid.',
    'lt' => [
        'numeric' => ':attribute harus kurang dari :value.',
        'file' => ':attribute harus kurang dari :value kilobytes.',
        'string' => ':attribute harus kurang dari :value karakter.',
        'array' => ':attribute harus memiliki kurang dari :value item.',
    ],
    'lte' => [
        'numeric' => ':attribute harus kurang dari atau sama dengan :value.',
        'file' => ':attribute harus kurang dari atau sama dengan :value kilobytes.',
        'string' => ':attribute harus kurang dari atau sama dengan :value character.',
        'array' => ':attribute harus tidak memiliki lebih dari :value item.',
    ],
    'max' => [
        'numeric' => ':attribute mungkin tidak lebih dari :max.',
        'file' => ':attribute mungkin tidak lebih dari :max kilobytes.',
        'string' => ':attribute mungkin tidak lebih dari :max karakter.',
        'array' => ':attribute mungkin tidak lebih dari :max item.',
    ],
    'mimes' => ':attribute harus berupa file bertipe: :values.',
    'mimetypes' => ':attribute harus berupa file bertipe: :values.',
    'min' => [
        'numeric' => ':attribute setidaknya harus :min.',
        'file' => ':attribute setidaknya harus :min kilobytes.',
        'string' => ':attribute setidaknya harus :min karakter.',
        'array' => ':attribute setidaknya harus memiliki :min item.',
    ],
    'not_in' => ':attribute yang dipilih tidak valid.',
    'not_regex' => ':attribute format tidak valid.',
    'numeric' => ':attribute harus berupa angka.',
    'present' => ':attribute bagan harus ditampilkan.',
    'regex' => ':attribute format tidak valid.',
    'required' => ':attribute bidang harus diisi.',
    'required_if' => ':attribute bidang harus diisi ketika :other adalah :value.',
    'required_unless' => ':attribute bidang harus diisi kecuali :other di dalam :values.',
    'required_with' => ':attribute bidang harus diisi ketika :values ditampilkan.',
    'required_with_all' => ':attribute bidang harus diisi ketika :values menampilkan.',
    'required_without' => ':attribute bidang harus diisi ketika :values tidak ditampilkan.',
    'required_without_all' => ':attribute bidang harus diisi ketika tidak ada :values yang ditampilkan.',
    'same' => ':attribute dan :other harus cocok.',
    'size' => [
        'numeric' => ':attribute harusnya :size.',
        'file' => ':attribute harusnya :size kilobytes.',
        'string' => ':attribute harusnya :size karakter.',
        'array' => ':attribute harus mengandung :size items.',
    ],
    'starts_with' => ':attribute harus dimulai dengan salah satu dari berikut ini: :values',
    'string' => ':attribute harusnya string.',
    'timezone' => ':attribute harusnya zona valid.',
    'unique' => ':attribute sudah diambil.',
    'uploaded' => ':attribute gagal diunggah.',
    'url' => ':attribute format tidak valid.',
    'uuid' => ':attribute harusnya valid UUID.',

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
        'search-term' => 'Aturan Cari'
    ],

];
