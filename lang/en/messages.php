<?php

return [


    //===========================================================
    // FAILED API
    //===========================================================
    'failed' => 'There is some thing wrong, please try again',


    //===========================================================
    // AUTHORIZATION
    //===========================================================
    'authorization' => 'you are not authorized',


    //===========================================================
    // AUTHENTICATED
    //===========================================================
    'login' => 'You are logged in successfully',
    'login.found' => 'You should enter email or username or phone number',
    'password.mismatch' => 'Password mismatch',
    'register' => 'successfully registered',
    'logout' => 'Signed out successfully',


    //===========================================================
    // AUTH USER
    //===========================================================
    'authUser.email.required' => 'The email is required',
    'authUser.email.email' => 'Please enter a valid email',
    'authUser.email.exists' => 'This email is not registered in our system',
    'authUser.email.unique' => 'This email was already taken, please select another one',
    'authUser.password.required' => 'The password is required',
    'authUser.password.string' => 'The password should be some character',
    'authUser.password.min' => 'The password should be at least 6 character',
    'authUser.bio.string' => 'The bio should be text',
    'authUser.bio.max' => 'The bio is too long',
    'authUser.name.required' => 'The name of user is required',
    'authUser.name.string' => 'The name of user should be string',
    'authUser.name.max' => 'The name of user is too big',
    'authUser.name.unique' => 'This name is already taken, please select another one',
    'authUser.password.max' => 'The password should be maxim 30 character ',
    'authUser.nick_name.required' => 'Nick name is required',
    'authUser.nick_name.string' => 'Nick name is should be a string',
    'authUser.nick_name.max' => 'Nick name is too long',
    'authUser.date_of_birth.required' => 'Date of birth is required',
    'authUser.date_of_birth.string' => 'Date of birth is should be a string',
    'authUser.date_of_birth.max' => 'Date of birth is too long',
    'authUser.phone.required' => 'Phone number is required',
    'authUser.phone.min' => 'Phone number is too short',
    'authUser.phone.max' => 'Phone number is too long',
    'authUser.phone.unique' => 'This phone number is already taken, please select another one',
    'authUser.image.mimes' => 'The image extension must be: jpeg, png, jpg, gif, svg',
    'authUser.image.max' => 'The image size is so big',
    'authUser.email.max' => 'The email user is too long',
    'authUser.username.string' => 'Please enter username in right syntax',
    'authUser.username.exists' => 'Username is not exists',
    'authUser.phone.string' => 'Please enter phone number in right syntax',
    'authUser.phone.exists' => 'Phone number is not exists',
    'authUser.info' => 'This is the user info',
    'authUser.email.taken' => 'This email was taken',
    'authUser.email.taken.not' => 'This email was not taken yet',
    'authUser.found' => 'The user is not exist',
    'authUser.all' => 'All users have been successfully restored',
    'authUser.one' => 'user restored successfully',
    'authUser.create' => 'user created was success',
    'authUser.update' => 'The user was updated',
    'authUser.deleted' => 'The user was deleted',


    //===========================================================
    // POST
    //===========================================================
    'post.index' => 'All posts for user have been successfully restored',
    'post.show' => 'post restored successfully',
    'post.store' => 'Post added successfully',
    'post.update' => 'Post updated successfully',
    'post.destroy'=>'The post was deleted',
    'post.found'=>'The post is not exists',
    'post.caption.string' => 'Please write the caption',
    'post.caption.max' => 'The caption is too long',
    'post.media.required' => 'The photo or video is required',
    'post.media.array' => 'The photo or video is required',
    'post.media.*.required' => 'The photo or video is required',
    'post.media.*.max' => 'You can select only 10 photos or videos in one post',
    'post.media.*.mimes' => 'please select images and videos only',
];
