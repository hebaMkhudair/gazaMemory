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

    'accepted' => 'يجب قبول حقل :attribute.',
    'accepted_if' => 'يجب قبول حقل :attribute عندما يكون :other هو :value.',
    'active_url' => 'حقل :attribute يجب أن يكون رابط URL صحيح.',
    'after' => 'حقل :attribute يجب أن يكون تاريخ بعد :date.',
    'after_or_equal' => 'حقل :attribute يجب أن يكون تاريخ بعد أو مساوي :date.',
    'alpha' => 'حقل :attribute يجب أن يحتوي على أحرف فقط.',
    'alpha_dash' => 'حقل :attribute يجب أن يحتوي على أحرف وأرقام وشرطات وشرطات سفلية فقط.',
    'alpha_num' => 'حقل :attribute يجب أن يحتوي على أحرف وأرقام فقط.',
    'any_of' => 'حقل :attribute غير صالح.',
    'array' => 'حقل :attribute يجب أن يكون مصفوفة.',
    'ascii' => 'حقل :attribute يجب أن يحتوي على أحرف أبجدية رقمية أحادية البايت والرموز فقط.',
    'before' => 'حقل :attribute يجب أن يكون تاريخ قبل :date.',
    'before_or_equal' => 'حقل :attribute يجب أن يكون تاريخ قبل أو مساوي :date.',
    'between' => [
        'array' => 'حقل :attribute يجب أن يحتوي على ما بين :min و :max عنصر.',
        'file' => 'حقل :attribute يجب أن يكون بين :min و :max كيلوبايت.',
        'numeric' => 'حقل :attribute يجب أن يكون بين :min و :max.',
        'string' => 'حقل :attribute يجب أن يكون بين :min و :max أحرف.',
    ],
    'boolean' => 'حقل :attribute يجب أن يكون صحيح أو خطأ.',
    'can' => 'حقل :attribute يحتوي على قيمة غير مصرح بها.',
    'confirmed' => 'تأكيد حقل :attribute غير متطابق.',
    'contains' => 'حقل :attribute مفقود قيمة مطلوبة.',
    'current_password' => 'كلمة المرور غير صحيحة.',
    'date' => 'حقل :attribute يجب أن يكون تاريخ صحيح.',
    'date_equals' => 'حقل :attribute يجب أن يكون تاريخ مساوي :date.',
    'date_format' => 'حقل :attribute يجب أن يطابق الصيغة :format.',
    'decimal' => 'حقل :attribute يجب أن يحتوي على :decimal منزلة عشرية.',
    'declined' => 'حقل :attribute يجب أن يكون مرفوض.',
    'declined_if' => 'حقل :attribute يجب أن يكون مرفوض عندما يكون :other هو :value.',
    'different' => 'حقل :attribute و :other يجب أن يكونا مختلفين.',
    'digits' => 'حقل :attribute يجب أن يكون :digits أرقام.',
    'digits_between' => 'حقل :attribute يجب أن يكون بين :min و :max أرقام.',
    'dimensions' => 'حقل :attribute له أبعاد صورة غير صالحة.',
    'distinct' => 'حقل :attribute له قيمة مكررة.',
    'doesnt_contain' => 'حقل :attribute يجب أن لا يحتوي على أي من التالي: :values.',
    'doesnt_end_with' => 'حقل :attribute يجب أن لا ينتهي بأي من التالي: :values.',
    'doesnt_start_with' => 'حقل :attribute يجب أن لا يبدأ بأي من التالي: :values.',
    'email' => 'حقل :attribute يجب أن يكون عنوان بريد إلكتروني صحيح.',
    'encoding' => 'حقل :attribute يجب أن يكون مشفر في :encoding.',
    'ends_with' => 'حقل :attribute يجب أن ينتهي بأحد التالي: :values.',
    'enum' => 'قيمة :attribute المحددة غير صالحة.',
    'exists' => ':attribute المحدد غير صالح.',
    'extensions' => 'حقل :attribute يجب أن يحتوي على أحد الامتدادات التالية: :values.',
    'file' => 'حقل :attribute يجب أن يكون ملف.',
    'filled' => 'حقل :attribute يجب أن يحتوي على قيمة.',
    'gt' => [
        'array' => 'حقل :attribute يجب أن يحتوي على أكثر من :value عنصر.',
        'file' => 'حقل :attribute يجب أن يكون أكبر من :value كيلوبايت.',
        'numeric' => 'حقل :attribute يجب أن يكون أكبر من :value.',
        'string' => 'حقل :attribute يجب أن يكون أكبر من :value أحرف.',
    ],
    'gte' => [
        'array' => 'حقل :attribute يجب أن يحتوي على :value عنصر أو أكثر.',
        'file' => 'حقل :attribute يجب أن يكون أكبر من أو يساوي :value كيلوبايت.',
        'numeric' => 'حقل :attribute يجب أن يكون أكبر من أو يساوي :value.',
        'string' => 'حقل :attribute يجب أن يكون أكبر من أو يساوي :value أحرف.',
    ],
    'hex_color' => 'حقل :attribute يجب أن يكون لون سادس عشري صحيح.',
    'image' => 'حقل :attribute يجب أن يكون صورة.',
    'in' => ':attribute المحدد غير صالح.',
    'in_array' => 'حقل :attribute يجب أن يكون موجود في :other.',
    'in_array_keys' => 'حقل :attribute يجب أن يحتوي على واحد على الأقل من المفاتيح التالية: :values.',
    'integer' => 'حقل :attribute يجب أن يكون عدد صحيح.',
    'ip' => 'حقل :attribute يجب أن يكون عنوان IP صحيح.',
    'ipv4' => 'حقل :attribute يجب أن يكون عنوان IPv4 صحيح.',
    'ipv6' => 'حقل :attribute يجب أن يكون عنوان IPv6 صحيح.',
    'json' => 'حقل :attribute يجب أن يكون سلسلة JSON صحيحة.',
    'list' => 'حقل :attribute يجب أن تكون قائمة.',
    'lowercase' => 'حقل :attribute يجب أن يكون أحرف صغيرة.',
    'lt' => [
        'array' => 'حقل :attribute يجب أن يحتوي على أقل من :value عنصر.',
        'file' => 'حقل :attribute يجب أن يكون أقل من :value كيلوبايت.',
        'numeric' => 'حقل :attribute يجب أن يكون أقل من :value.',
        'string' => 'حقل :attribute يجب أن يكون أقل من :value أحرف.',
    ],
    'lte' => [
        'array' => 'حقل :attribute يجب أن لا يحتوي على أكثر من :value عنصر.',
        'file' => 'حقل :attribute يجب أن يكون أقل من أو يساوي :value كيلوبايت.',
        'numeric' => 'حقل :attribute يجب أن يكون أقل من أو يساوي :value.',
        'string' => 'حقل :attribute يجب أن يكون أقل من أو يساوي :value أحرف.',
    ],
    'mac_address' => 'حقل :attribute يجب أن يكون عنوان MAC صحيح.',
    'max' => [
        'array' => 'حقل :attribute يجب أن لا يحتوي على أكثر من :max عنصر.',
        'file' => 'حقل :attribute يجب أن لا يكون أكبر من :max كيلوبايت.',
        'numeric' => 'حقل :attribute يجب أن لا يكون أكبر من :max.',
        'string' => 'حقل :attribute يجب أن لا يكون أكبر من :max أحرف.',
    ],
    'max_digits' => 'حقل :attribute يجب أن لا يحتوي على أكثر من :max أرقام.',
    'mimes' => 'حقل :attribute يجب أن يكون ملف من النوع: :values.',
    'mimetypes' => 'حقل :attribute يجب أن يكون ملف من النوع: :values.',
    'min' => [
        'array' => 'حقل :attribute يجب أن يحتوي على الأقل :min عنصر.',
        'file' => 'حقل :attribute يجب أن يكون الأقل :min كيلوبايت.',
        'numeric' => 'حقل :attribute يجب أن يكون الأقل :min.',
        'string' => 'حقل :attribute يجب أن يكون الأقل :min أحرف.',
    ],
    'min_digits' => 'حقل :attribute يجب أن يحتوي على الأقل :min أرقام.',
    'missing' => 'حقل :attribute يجب أن يكون مفقود.',
    'missing_if' => 'حقل :attribute يجب أن يكون مفقود عندما يكون :other هو :value.',
    'missing_unless' => 'حقل :attribute يجب أن يكون مفقود إلا إذا كان :other في :values.',
    'missing_with' => 'حقل :attribute يجب أن يكون مفقود عندما :values موجود.',
    'missing_with_all' => 'حقل :attribute يجب أن يكون مفقود عندما تكون :values موجودة.',
    'multiple_of' => 'حقل :attribute يجب أن يكون مضاعف :value.',
    'not_in' => ':attribute المحدد غير صالح.',
    'not_regex' => 'تنسيق حقل :attribute غير صالح.',
    'numeric' => 'حقل :attribute يجب أن يكون رقم.',
    'password' => [
        'letters' => 'حقل :attribute يجب أن يحتوي على حرف واحد على الأقل.',
        'mixed' => 'حقل :attribute يجب أن يحتوي على حرف كبير واحد على الأقل وحرف صغير واحد.',
        'numbers' => 'حقل :attribute يجب أن يحتوي على رقم واحد على الأقل.',
        'symbols' => 'حقل :attribute يجب أن يحتوي على رمز واحد على الأقل.',
        'uncompromised' => 'قيمة :attribute المعطاة ظهرت في تسرب بيانات. يرجى اختيار :attribute مختلف.',
    ],
    'present' => 'حقل :attribute يجب أن يكون موجود.',
    'present_if' => 'حقل :attribute يجب أن يكون موجود عندما يكون :other هو :value.',
    'present_unless' => 'حقل :attribute يجب أن يكون موجود إلا إذا كان :other في :values.',
    'present_with' => 'حقل :attribute يجب أن يكون موجود عندما :values موجود.',
    'present_with_all' => 'حقل :attribute يجب أن يكون موجود عندما تكون :values موجودة.',
    'prohibited' => 'حقل :attribute محظور.',
    'prohibited_if' => 'حقل :attribute محظور عندما يكون :other هو :value.',
    'prohibited_if_accepted' => 'حقل :attribute محظور عندما يتم قبول :other.',
    'prohibited_if_declined' => 'حقل :attribute محظور عندما يتم رفض :other.',
    'prohibited_unless' => 'حقل :attribute محظور إلا إذا كان :other في :values.',
    'prohibits' => 'حقل :attribute يحظر :other من أن يكون موجود.',
    'regex' => 'تنسيق حقل :attribute غير صالح.',
    'required' => 'حقل :attribute مطلوب.',
    'required_array_keys' => 'حقل :attribute يجب أن يحتوي على إدخالات لـ: :values.',
    'required_if' => 'حقل :attribute مطلوب عندما يكون :other هو :value.',
    'required_if_accepted' => 'حقل :attribute مطلوب عندما يتم قبول :other.',
    'required_if_declined' => 'حقل :attribute مطلوب عندما يتم رفض :other.',
    'required_unless' => 'حقل :attribute مطلوب إلا إذا كان :other في :values.',
    'required_with' => 'حقل :attribute مطلوب عندما :values موجود.',
    'required_with_all' => 'حقل :attribute مطلوب عندما تكون :values موجودة.',
    'required_without' => 'حقل :attribute مطلوب عندما :values غير موجود.',
    'required_without_all' => 'حقل :attribute مطلوب عندما لا يكون أي من :values موجود.',
    'same' => 'حقل :attribute يجب أن يطابق :other.',
    'size' => [
        'array' => 'حقل :attribute يجب أن يحتوي على :size عنصر.',
        'file' => 'حقل :attribute يجب أن يكون :size كيلوبايت.',
        'numeric' => 'حقل :attribute يجب أن يكون :size.',
        'string' => 'حقل :attribute يجب أن يكون :size أحرف.',
    ],
    'starts_with' => 'حقل :attribute يجب أن يبدأ بأحد التالي: :values.',
    'string' => 'حقل :attribute يجب أن يكون نص.',
    'timezone' => 'حقل :attribute يجب أن يكون منطقة زمنية صحيحة.',
    'unique' => ':attribute تم أخذها بالفعل.',
    'uploaded' => 'فشل رفع :attribute.',
    'uppercase' => 'حقل :attribute يجب أن يكون أحرف كبيرة.',
    'url' => 'حقل :attribute يجب أن يكون رابط URL صحيح.',
    'ulid' => 'حقل :attribute يجب أن يكون ULID صحيح.',
    'uuid' => 'حقل :attribute يجب أن يكون UUID صحيح.',

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

    'attributes' => [],

];
