<?php

return [
    'menuTitle'          => 'محرر .env',
    'controllerMessages' => [
        'backupWasCreated'                       => 'تم إنشاء نسخة احتياطية جديدة',
        'fileWasRestored'                        => 'تمت استعادة ملف النسخ الاحتياطي ":name" كملف افتراضي .env',
        'fileWasDeleted'                         => 'تم حذف ملف النسخة الاحتياطية ":name".',
        'currentEnvWasReplacedByTheUploadedFile' => 'تم تحميل الملف وأصبح ملف .env الجديد',
        'uploadedFileSavedAsBackup'              => 'تم تحميل الملف كنسخة احتياطية بالاسم ":name"',
        'keyWasAdded'                            => 'تمت إضافة المفتاح ":name".',
        'keyWasEdited'                           => 'تم تحديث المفتاح ":name".',
        'keyWasDeleted'                          => 'تم حذف المفتاح ":name".',
    ],
    'views' => [
        'tabTitles' => [
            'upload'     => 'رفع',
            'backup'     => 'النسخ الاحتياطية',
            'currentEnv' => 'الحالي .env',
        ],
        'currentEnv' => [
            'title'       => 'محتوى ملف .env الحالي',
            'tableTitles' => [
                'key'     => 'مفتاح',
                'value'   => 'قيمة',
                'actions' => 'أجراءات',
            ],
            'btn' => [
                'edit'                    => 'تعديل ملف',
                'delete'                  => 'حذف المفتاح',
                'addAfterKey'             => 'أضف مفتاحًا جديدًا بعد هذا المفتاح',
                'addNewKey'               => 'إضافة مفتاح جديد',
                'deleteConfigCache'       => 'مسح ذاكرة التخزين المؤقت للتكوين',
                'deleteConfigCacheDesc'   => 'في بيئات الإنتاج، قد لا يتم تطبيق القيم المتغيرة على الفور بسبب التكوين المخزن مؤقتًا. لذلك قد تحاول إلغاء تخزينها مؤقتًا',
            ],
            'modal' => [
                'title' => [
                    'new'    => 'مفتاح جديد',
                    'edit'   => 'تحرير المفتاح',
                    'delete' => 'حذف المفتاح',
                ],
                'input' => [
                    'key'   => 'مفتاح',
                    'value' => 'قيمة',
                ],
                'btn' => [
                    'close'  => 'يغلق',
                    'new'    => 'إضافة مفتاح',
                    'edit'   => 'مفتاح التحديث',
                    'delete' => 'حذف المفتاح',
                ],
            ],

        ],
        'upload' => [
            'title'            => 'هنا يمكنك تحميل ملف ".env" جديد كنسخة احتياطية أو لاستبدال ملف ".env" الحالي',
            'selectFilePrompt' => 'حدد ملف',
            'btn'              => [
                'clearFile'        => 'يلغي',
                'uploadAsBackup'   => 'تحميل كنسخة احتياطية',
                'uploadAndReplace' => 'تحميل واستبدال .env الحالي',
            ],
        ],
        'backup' => [
            'title'       => 'هنا يمكنك رؤية قائمة بملفات النسخ الاحتياطي المحفوظة (إذا كان لديك)، ويمكنك إنشاء ملف جديد، أو تنزيل ملف .env',
            'tableTitles' => [
                'filename'   => 'اسم الملف',
                'created_at' => 'تاريخ الإنشاء',
                'actions'    => 'أجراءات',
            ],
            'noBackUpItems' => 'لا توجد نسخ احتياطية في الدليل الذي اخترته. <br> يمكنك عمل النسخة الاحتياطية الأولى عن طريق الضغط على زر "الحصول على نسخة احتياطية جديدة".',
            'btn'           => [
                'backUpCurrentEnv'   => 'الحصول على نسخة احتياطية جديدة',
                'downloadCurrentEnv' => 'تنزيل .env الحالي',
                'download'           => 'تحميل الملف',
                'delete'             => 'حذف ملف',
                'restore'            => 'استعادة الملف',
                'viewContent'        => 'عرض محتويات الملف',
            ],
        ],
    ],
    'exceptions' => [
        'fileNotExists'    => 'الملف ":name" غير موجود !!!',
        'keyAlreadyExists' => 'المفتاح ":name" موجود بالفعل !!!',
        'keyNotExists'     => 'المفتاح ":name" غير موجود !!!',
        'provideFileName'  => 'يجب عليك تقديم اسم الملف !!!',
    ],

];
