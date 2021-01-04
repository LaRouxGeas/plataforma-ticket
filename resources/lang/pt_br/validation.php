<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | As seguintes linhas contem mensagens de errors em pt-br usado pela
    | classe validator, Algumas tem multiplas versoes, exemplo é o size
    | no arquivo lang/en/validation. Algumas mensagens ainda não foram
    | traduzidas/escritas. Sinta-se livre para motificar ou criar novas,
    | mas lembre-se de que outros podem estar usando essas mensagens.
    |
    */

    // 'accepted'             => 'The :attribute must be accepted.',
    // 'active_url'           => 'The :attribute is not a valid URL.',
    // 'after'                => 'The :attribute must be a date after :date.',
    // 'after_or_equal'       => 'The :attribute must be a date after or equal to :date.',
    'alpha'                => 'O :attribute só aceita letras.',
    'alpha_dash'           => 'O :attribute só aceita letras, números e traço.',
    'alpha_num'            => 'O :attribute só aceita letras e números.',
    'alpha_spaces'         => 'O :attribute só aceita letras e espaço.',
    // 'array'                => 'The :attribute must be an array.',
    // 'before'               => 'The :attribute must be a date before :date.',
    // 'before_or_equal'      => 'The :attribute must be a date before or equal to :date.',
    'between'              => [
        'numeric' => 'O :attribute deve estar entre :min e :max.',
        'file'    => 'O :attribute deve estar entre :min e :max kilobytes.',
        'string'  => 'O :attribute deve estar entre :min e :max caracters.',
        'array'   => 'O :attribute deve estar entre :min e :max itens.',
    ],
    // 'boolean'              => 'The :attribute field must be true or false.',
    'cpf'                  => 'O :attribute não é um CPF válido.',
    // 'confirmed'            => 'The :attribute confirmation does not match.',
    'date'                 => 'O :attribute não é uma data válida.',
    'date_format'          => 'O :attribute não está no formato válido de data, formato :format.',
    'ddd'                  => 'O :attribute não contem um DDD válido',
    'different'            => 'O :attribute e :other devem ser diferentes.',
    // 'digits'               => 'The :attribute must be :digits digits.',
    // 'digits_between'       => 'The :attribute must be between :min and :max digits.',
    // 'dimensions'           => 'The :attribute has invalid image dimensions.',
    // 'distinct'             => 'The :attribute field has a duplicate value.',
    'email'                => 'O :attribute deve ser um email válido.',
    'exists'               => 'O :attribute selecionado é inválido.',
    // 'file'                 => 'The :attribute must be a file.',
    // 'filled'               => 'The :attribute field must have a value.',
    // 'image'                => 'The :attribute must be an image.',
    // 'in'                   => 'The selected :attribute is invalid.',
    // 'in_array'             => 'The :attribute field does not exist in :other.',
    // 'integer'              => 'The :attribute must be an integer.',
    // 'ip'                   => 'The :attribute must be a valid IP address.',
    // 'json'                 => 'The :attribute must be a valid JSON string.',
    'max'                  => [
        'numeric' => 'O :attribute não pode ser maior que :max.',
        'file'    => 'O :attribute não pode ser maior que :max kilobytes.',
        'string'  => 'O :attribute não pode ter mais que :max caracters.',
        'array'   => 'O :attribute não pode ter mais que :max itens.',
    ],
    // 'mimes'                => 'The :attribute must be a file of type: :values.',
    // 'mimetypes'            => 'The :attribute must be a file of type: :values.',
    // 'min'                  => [
    //     'numeric' => 'The :attribute must be at least :min.',
    //     'file'    => 'The :attribute must be at least :min kilobytes.',
    //     'string'  => 'The :attribute must be at least :min characters.',
    //     'array'   => 'The :attribute must have at least :min items.',
    // ],
    // 'not_in'               => 'The selected :attribute is invalid.',
    'nna'                  => 'O :attribute não permite NA.',
    'numeric'              => 'O :attribute deve ser um número.',
    'present'              => 'O :attribute deve estar presente.',
    // 'regex'                => 'The :attribute format is invalid.',
    'required'             => 'O :attribute é obrigatório.',
    // 'required_if'          => 'The :attribute field is required when :other is :value.',
    // 'required_unless'      => 'The :attribute field is required unless :other is in :values.',
    // 'required_with'        => 'The :attribute field is required when :values is present.',
    // 'required_with_all'    => 'The :attribute field is required when :values is present.',
    // 'required_without'     => 'The :attribute field is required when :values is not present.',
    // 'required_without_all' => 'The :attribute field is required when none of :values are present.',
    // 'same'                 => 'The :attribute and :other must match.',
    // 'size'                 => [
    //     'numeric' => 'The :attribute must be :size.',
    //     'file'    => 'The :attribute must be :size kilobytes.',
    //     'string'  => 'The :attribute must be :size characters.',
    //     'array'   => 'The :attribute must contain :size items.',
    // ],
    // 'string'               => 'The :attribute must be a string.',
    // 'timezone'             => 'The :attribute must be a valid zone.',
    'unique'               => 'O :attribute já esta sendo usado.',
    // 'uploaded'             => 'The :attribute failed to upload.',
    // 'url'                  => 'The :attribute format is invalid.',

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
    | The following language lines are used to swap attribute place-holders
    | with something more reader friendly such as E-Mail Address instead
    | of "email". This simply helps us make messages a little cleaner.
    |
    */

    'attributes' => [],

];
