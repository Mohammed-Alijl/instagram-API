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
    'authUser.name.regex' => 'The username must start with a letter and contain only letters, numbers, and scores, and must have at least eight letters and at most 30 letters.',
    'authUser.password.max' => 'The password should be maxim 30 character',
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
    'post.destroy' => 'The post was deleted',
    'post.found' => 'The post is not exists',
    'post.save.store'=>'Post saved successfully',
    'post.save.false'=>'This post is not in your archives',
    'post.save.delete'=>'This post has been removed from the archives',
    'post.save.exists'=>'This post is already saved',
    'post.caption.string' => 'Please write the caption',
    'post.caption.max' => 'The caption is too long',
    'post.media.required' => 'The photo or video is required',
    'post.media.array' => 'The photo or video is required',
    'post.media.*.required' => 'The photo or video is required',
    'post.media.*.max' => 'You can select only 10 photos or videos in one post',
    'post.media.*.mimes' => 'please select images and videos only',
    'post.post_id.required' => 'post id is required',
    'post.post_id.numeric' => 'post id should be numeric',
    'post.post_id.exists' => 'The post is not exists',


    //===========================================================
    // COMMENT
    //===========================================================
    'comment.index' => 'All comments for user in the post have been successfully restored',
    'comment.show' => 'Comment restored successfully',
    'comment.store' => 'Comment added successfully',
    'comment.update' => 'Comment updated successfully',
    'comment.destroy' => 'The comment was deleted',
    'comment.notFound' => 'The comment is not exists',
    'comment.like' => 'The user like the comment',
    'comment.not.like' => 'The user does\'nt like the comment',
    'comment.comment_id.required' => 'Comment id is required',
    'comment.comment_id.numeric' => 'Comment id should be numeric',
    'comment.comment_id.exists' => 'The comment is not exists',
    'comment.like.exists' => 'Like already exists',
    'comment.like.add' => 'Like added successfully',
    'comment.like.destroy' => 'The comment like has been removed',
    'comment.post_id.required' => 'post id is required',
    'comment.post_id.numeric' => 'post id should be numeric',
    'comment.post_id.exists' => 'The post is not exists',
    'comment.comment.required' => 'Comment is required',
    'comment.comment.string' => 'Please write the comment in right way',
    'comment.comment.max' => 'The comment is too long',


    //===========================================================
    // POST LIKE
    //===========================================================
    'like.like' => 'User like the post',
    'like.not.like' => 'User didn\'t like it',
    'like.store' => 'Like added successfully',
    'like.destroy' => 'The post like has been removed',
    'like.exists' => 'Like already exists',
    'like.post_id.required' => 'Post id is required',
    'like.post_id.numeric' => 'Post id should be numeric',


    //===========================================================
    // REPLY
    //===========================================================
    'reply.notFound' => 'The reply is not exists',
    'reply.show' => 'Reply restored successfully',
    'reply.store' => 'Reply added successfully',
    'reply.update' => 'Reply edit successfully',
    'reply.destroy' => 'The reply was deleted',
    'reply.comment_id.required' => 'Comment id is required',
    'reply.like' => 'The user like the reply',
    'reply.not.like' => 'The user does\'nt like the reply',
    'reply.like.exists' => 'Like already exists',
    'reply.like.add' => 'Like added successfully',
    'reply.like.destroy' => 'The reply like has been removed',
    'reply.reply_id.required' => 'Reply id is required',
    'reply.reply_id.numeric' => 'Reply id should be numeric',
    'reply.reply_id.exists' => 'Reply id is invalid',
    'reply.comment_id.numeric' => 'Comment id should be numeric',
    'reply.comment_id.exists' => 'Comment id is invalid',
    'reply.reply.required' => 'Reply is required',
    'reply.reply.string' => 'Please write the reply in right way',
    'reply.reply.max' => 'The reply is too long',


    //===========================================================
    // FOLLOW
    //===========================================================
    'follow.true' => 'You follow this user',
    'follow.false' => 'You don\'t follow this user',
    'follow.store' => 'Follow added successfully',
    'follow.destroy' => 'unfollow was succeeded',
    'follow.exists' => 'You already follow this user',
    'follow.user_id.required' => 'User id is required',
    'follow.user_id.numeric' => 'Use id should be numeric',
    'follow.user_id.exists' => 'User id is invalid',
    'follow.yourself' => 'You can not follow yourself',


    //===========================================================
    // USER
    //===========================================================
    'user.notFound' => 'The user is not exists',
    'user.show' => 'User restored successfully',
    'user.update' => 'User info edit successfully',
    'user.destroy' => 'The user was deleted',
    'user.search' => 'These users have been found',
    'profile.show' => 'The profile info restored successfully',
    'user.password.change' => 'Password has been modified successfully',
    'user.image.update' => 'User image updated successfully',
    'user.bio.string' => 'Please write the bio correctly',
    'user.bio.max' => 'The bio is too long',
    'user.nick_name.string' => 'please write nick name correctly',
    'user.nick_name.max' => 'nick name is too long',
    'user.date_of_birth.date_format' => 'date of birth should be in this format: day/month/year',
    'user.date_of_birth.max' => 'date of birth should be in this format: day/month/year',
    'user.image.required' => 'Image is required',
    'user.image.mimes' => 'The image extension must be: jpeg, png, jpg, gif, svg',
    'user.image.max' => 'The image size is so big',
    'user.current_password.false' => 'The current password is incorrect',
    'user.current_password.required' => 'The current password is required',
    'user.new_password.required' => 'new password is required',
    'user.new_password.confirmed' => 'The password and confirmation do not match',
    'user.new_password.min' => 'The password should be at least 6 character',
    'user.new_password.max' => 'The password should be maxim 30 character',
    'user.username.required' => 'Username is required',
    'user.username.max' => 'Username is too long',
    'user.username.string' => 'Please write username with write way',


    //===========================================================
    // STORY
    //===========================================================
    'story.notFound' => 'This story is not exist',
    'story.index' => 'All stories for auth user have been successfully restored',
    'story.show' => 'Story restored successfully',
    'story.store' => 'Store added successfully',
    'story.destroy' => 'Store was deleted',
    'story.view.user.index' => 'All users view story have been successfully restored',
    'story.view.show.true' => 'User view this story',
    'story.view.show.false' => 'The user has not seen the story',
    'story.view.store' => 'View added successfully',
    'story.view.exists' => 'View already exists',
    'story.media.required' => 'The media is required',
    'story.media.mimes' => 'please select images and videos only',
    'story.view.story_id.required' => 'Story id is required',
    'story.view.story_id.numeric' => 'Story id should be numeric',
    'story.view.story_id.exists' => 'Story is not exists',


    //===========================================================
    // REELS
    //===========================================================
    'reels.notFound' => 'Reels is not exists',
    'reels.show' => 'Reels restored successfully',
    'reels.store' => 'Reels added successfully',
    'reels.destroy' => 'Reels was deleted',
    'reels.required' => 'Reels is required',
    'reels.mimes' => 'please select videos only',
];
