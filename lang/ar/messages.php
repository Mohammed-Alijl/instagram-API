<?php

return [
//===========================================================
    // FAILED API
    //===========================================================
    'failed' => 'فشلت العملية يوجد خطأ ما, الرجاء المحاولة مرة اخرى',


    //===========================================================
    // AUTHORIZATION
    //===========================================================
    'authorization' => 'غير مسموح لك بالدخول',


    //===========================================================
    // AUTHENTICATED
    //===========================================================
    'login' => 'تم تسجيل الدخول بنجاح',
    'login.found' => 'يجب ادخال البريد الالكتروني او اسم المستخدم او رقم الهاتف',
    'password.mismatch' => 'كلمة المرور غير متطابقة',
    'register' => 'تم التسجيل بنجاح',
    'logout' => 'تم تسجيل الخروج بنجاح',


    //===========================================================
    // AUTH USER
    //===========================================================
    'authUser.email.required' => 'البريد الالكتروني مطلوب',
    'authUser.email.email' => 'الرجاء ادخال بريد الكتروني صالح',
    'authUser.email.exists' => 'هذا البريد غير مسجل',
    'authUser.email.unique' => 'هذا البريد مستخدم بالفعل',
    'authUser.password.required' => 'كلمة المرور مطلوبة',
    'authUser.password.string' => 'يجب ان تكون كلمة المرور عبارة عن بعض الحروف او الارقام او الرموز',
    'authUser.password.min' => 'يجب ان تكون كلمة السر 6 خانات',
    'authUser.bio.string' => 'يجب ان يكون البايو الخاص بك نص',
    'authUser.bio.max' => 'لقد تجاوزت الحد الاقصى لعدد الحروف',
    'authUser.name.required' => 'اسم المستخدم مطلوب',
    'authUser.name.string' => 'يجب ان يكون اسم المستخدم نص',
    'authUser.name.max' => 'اسم المستخدم كبير جدا',
    'authUser.name.unique' => 'هذا الاسم مسخدم بالفعل, الرجاء اختيار اسم اخر',
    'authUser.password.max' => 'يجب ان تكون كلمة المرور 32 خانة على الاكثر',
    'authUser.nick_name.required' => 'اسم المستخدم المستعار مطلوب',
    'authUser.nick_name.string' => 'يجب ان يكون الاسم المستعار للمستخدم نص',
    'authUser.nick_name.max' => 'اسم المستخدم المستعار كبير جدا',
    'authUser.date_of_birth.required' => 'تاريخ الميلاد مطلوب',
    'authUser.date_of_birth.string' => 'يجب ادخال تاريخ الميلاد بشكل صحيح',
    'authUser.date_of_birth.max' => 'تاريخ الميلاد اكبر من اللازم',
    'authUser.phone.required' => 'رقم الهاتف مطلوب',
    'authUser.phone.min' => 'رقم الهاتف اقل من اللازم',
    'authUser.phone.max' => 'رقم الهاتف اكبر من اللازم',
    'authUser.phone.unique' => 'هذا الرقم مستخدم بالفعل, الرجاء اختيار رقم اخر',
    'authUser.image.mimes' => 'امتداد الصورة يجب ان يكون: jpeg, png, jpg, gif, svg',
    'authUser.image.max' => 'حجم الصورة كبير جدا',
    'authUser.email.max' => 'لبريد الالكتروني اكبر من اللازم',
    'authUser.info' => 'تم ارجاع معلومات المستخدم',
    'authUser.email.taken' => 'هذا البريد مستخدم بالفعل',
    'authUser.email.taken.not' => 'لم يتم استخدام هذا البريد الالكتروني بعد',
    'authUser.username.string' => 'الرجاء ادخال اسم المستخدم بشكل صحيح',
    'authUser.username.exists' => 'اسم المستخدم هذا غير موجود',
    'authUser.phone.string' => 'الرجاء ادخال رقم الهاتف بشكل صحيح',
    'authUser.phone.exists' => 'رقم الهاتف هذا غير موجود',
    'authUser.found' => 'هذا المستخدم غير موجود',
    'authUser.all' => 'تم اعادة جميع الزبائن المسجلين بنجاح',
    'authUser.one' => 'تم اعادة المستخدم المطلوب بنجاح',
    'authUser.create' => 'تم تسجيل المستخدم بنجاح',
    'authUser.update' => 'تم تعديل بيانات المستخدم بنجاح',
    'authUser.deleted' => 'تم حذف المستخدم نهائيا بنجاح',


    //===========================================================
    // POST
    //===========================================================
    'post.index' => 'تم ارجاع جميع المنشورات الخاصة بالمستخدم بنجاح',
    'post.show' => 'تم ارجاع المنشور بنجاج',
    'post.store' => 'تم اضافة المنشور بنجاح',
    'post.update' => 'تم تعديل المنشور بنجاح',
    'post.destroy' => 'تم حذف المنشور بنجاح',
    'post.found' => 'هذا المنشور غير موجود',
    'post.caption.string' => 'رجاء اكتب الشرح التوضيحي للمنشور',
    'post.caption.max' => 'الشرح التوضيحي اكبؤ من اللازم',
    'post.media.required' => 'الصور او الفيديوهات مطلوبة',
    'post.media.array' => 'الصور او الفيديوهات مطلوبة',
    'post.media.*.required' => 'الصور او الفيديوهات مطلوبة',
    'post.media.*.max' => 'يمكنك نشر 10 صور او فيديوهات في المنشور الواحد فقط',
    'post.media.*.mimes' => 'رجاء اختر الصور و الفيديوهات فقط',


    //===========================================================
    // COMMENT
    //===========================================================
    'comment.index' => 'تم ارجاع جميع التعليقات بنجاح',
    'comment.show' => 'تم ارجاع التعليق المطلوب بنجاح',
    'comment.store' => 'تم اضافة التعليق بنجاح',
    'comment.update' => 'تم تحديث التعليق بنجاح',
    'comment.destroy' => 'تم حذف التعليق بنجاح',
    'comment.notFound' => 'عذرا, هذا التعليق غير موجود',
    'comment.like' => 'المستخدم معجب بالتعليق',
    'comment.not.like' => 'المستخدم غير معجب بالتعليق',
    'comment.comment_id.required' => 'معرف التعليق مطلوب',
    'comment.comment_id.numeric' => 'معرف التعليق يجب ان يكون رقم',
    'comment.comment_id.exists' => 'التعليق غير موجود',
    'comment.like.exists' => 'المستخدم معجب بالتعليق بالفعل',
    'comment.like.add' => 'تم اضافة الاعجاب بنجاح',
    'comment.like.destroy' => 'تم ازالة الاعجاب بنجاح',
    'comment.post_id.required' => 'معرف المنشور مطلوب',
    'comment.post_id.numeric' => 'يجب ان يكون معرف المنشور عبارة عن رقم',
    'comment.post_id.exists' => 'عذرا, هذا المنشور غير موجود',
    'comment.comment.required' => 'التعليق مطلوب',
    'comment.comment.string' => 'رجاء قم بكتابة التعليق بطريقة صحيحة',
    'comment.comment.max' => 'هذا التعليق اطول من اللازم',


    //===========================================================
    // POST LIKE
    //===========================================================
    'like.like' => 'المستخدم معجب بالمنشور',
    'like.not.like' => 'المستخدم غير معجب بالمنشور',
    'like.store' => 'تم اضافة الاعجاب على المنشور بنجاح',
    'like.destroy' => 'تم ازالة الاعجاب بنجاح',
    'like.exists' => 'المستخدم معجب بالمنشور بالفعل',
    'like.post_id.required' => 'معرف المنشور مطلوب',
    'like.post_id.numeric' => 'يجب ان يكون معرف المنشور عبارة عن ارقام فقط',


    //===========================================================
    // REPLY
    //===========================================================
    'reply.notFound' => 'الرد غير موجود',
    'reply.show' => 'تم ارجاع الرد بنجاح',
    'reply.store' => 'تم اضافة الرد بنجاح',
    'reply.update' => 'تم تحديث الرد بنجاح',
    'reply.destroy' => 'تم حذف الرد بنجاح',
    'reply.like' => 'المستخدم معجب بالرد',
    'reply.not.like' => 'المستخدم غير معجب بالرد',
    'reply.like.exists' => 'المستخدم معجب بالرد بالفعل',
    'reply.like.add' => 'تم اضافة الاعجاب بنجاح',
    'reply.like.destroy' => 'تم ازالة الاعجاب بنجاح',
    'reply.reply_id.required' => 'معرف الرد مطلوب',
    'reply.reply_id.numeric' => 'يجب ان يكون معرف الرد عبارة عن رقم فقط',
    'reply.reply_id.exists' => 'هذا الرد غير موجود',
    'reply.comment_id.required' => 'معرف التعليق مطلوب',
    'reply.comment_id.numeric' => 'معرف التعليق يجب ان يكون ارقام فقط',
    'reply.comment_id.exists' => 'هذا التعليق غير موجود',
    'reply.reply.required' => 'لا يمكن ترك الرد فارغ',
    'reply.reply.string' => 'الرجاء كتابة الرد بطريقة صحيحة',
    'reply.reply.max' => 'هذا الرد اطول من اللازم',


    //===========================================================
    // FOLLOW
    //===========================================================
    'follow.true' => 'انت تتابع هذا المستخدم',
    'follow.false' => 'انت تتابع هذا المستخدم بالفعل',
    'follow.store' => 'تم اضافة المتابعة بنجاح',
    'follow.destroy' => 'تم الغاء المتابع بنجاح',
    'follow.exists' => 'انت تتابع هذا المستخدم بالفعل',
    'follow.user_id.required' => 'معرف المستخدم مطلوب',
    'follow.user_id.numeric' => 'يجب ان يكون معرف المستخد ارقام فقط',
    'follow.user_id.exists' => 'هذا المستخدم غير موجود',


    //===========================================================
    // USER
    //===========================================================
    'user.notFound'=>'هذا المستخدم غير موجود',
    'user.show'=>'تم ارجاع معلومات المستخدم بنجاح',
    'user.update'=>'تم تعديل بيانات المستخدم بنجاح',
    'user.destroy'=>'تم ازالة المستخدم نهائيا بنجاح',
    'user.password.change'=>'تم تحديث كلمة المرور بنجاح',
    'user.image.update'=>'تم تعديل الصورة الشخصية بنجاح',
    'user.bio.string'=>'الرجاء كتابة السيرة الذاتية بطريقة صحيحة',
    'user.bio.max'=>'السيرة الذاتية اطول من اللازم',
    'user.nick_name.string'=>'الرجاء كتابة الاسم المستعار بطريقة صحيحة',
    'user.nick_name.max'=>'الاسم المستعار اطول من اللازم',
    'user.date_of_birth.date_format'=>'يجب ان يكون تاريخ الميلاد بهذه الصيغة: اليوم/الشهر/السنة',
    'user.date_of_birth.max'=>'يجب ان يكون تاريخ الميلاد بهذه الصيغة: اليوم/الشهر/السنة',
    'user.image.required'=>'الصورة مطلوبة',
    'user.image.mimes'=>'يجب ان يكون امتداد الصورة باحدى هذه الامتدادات: jpeg, png, jpg, gif, svg',
    'user.image.max'=>'حجم الصورة كبير جدا',
    'user.current_password.false'=>'كلمة المرور الحالبة غير صحيحة',
    'user.current_password.required'=>'كلمة المرور الحالية مطلوبة',
    'user.new_password.required'=>'كلمة المرور الجديدة مطلوبة',
    'user.new_password.confirmed'=>'كلمة المرور وتأكيدها غير متطابقين',
    'user.new_password.min'=>'يجب ان تكون كلمة المرور الجديدة 6 حروف على الاقل',
    'user.new_password.max'=>'يجب ان لا تزيد كلمة المرور الجديدة عن 30 حرف',



    //===========================================================
    // STORY
    //===========================================================
    'story.notFound'=>'القصة غير موجودة',
    'story.index' =>'تم ارجاع جميع القصص الخاصة بالمستخدم',
    'story.show' =>'تم ارجاع القصة بنجاح',
    'story.store' =>'تم اضافة القصة بنجاح',
    'story.destroy' =>'تم حذف القصة بنجاح',
    'story.media.required' =>'الرجاء اضافة صورة او فيديو',
    'story.media.mimes' =>'الرجاء اختيار صورة او فيديو فقط',
];
