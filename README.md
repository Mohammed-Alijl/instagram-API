<div align="center">

# 📸 Instagram Clone API

**A fully-featured RESTful API backend for an Instagram-like social media platform, built with Laravel 9 and secured with OAuth 2.0 (Passport).**

[![PHP](https://img.shields.io/badge/PHP-8.0.2%2B-777BB4?style=for-the-badge&logo=php&logoColor=white)](https://php.net)
[![Laravel](https://img.shields.io/badge/Laravel-9.x-FF2D20?style=for-the-badge&logo=laravel&logoColor=white)](https://laravel.com)
[![Passport](https://img.shields.io/badge/Laravel%20Passport-OAuth%202.0-orange?style=for-the-badge)](https://laravel.com/docs/passport)
[![License: MIT](https://img.shields.io/badge/License-MIT-yellow?style=for-the-badge)](LICENSE)

</div>

---

## 📖 Table of Contents

- [About the Project](#-about-the-project)
- [Real-World Usage](#-real-world-usage)
- [Features](#-features)
- [Tech Stack](#-tech-stack)
- [Getting Started](#-getting-started)
  - [Prerequisites](#prerequisites)
  - [Installation](#installation)
  - [Environment Configuration](#environment-configuration)
- [Authentication](#-authentication)
- [Request Headers](#-request-headers)
- [API Reference](#-api-reference)
  - [Authentication Endpoints](#1-authentication)
  - [User Management](#2-user-management)
  - [Posts](#3-posts)
  - [Post Likes](#4-post-likes)
  - [Saved Posts](#5-saved-posts)
  - [Comments](#6-comments)
  - [Comment Likes](#7-comment-likes)
  - [Replies](#8-replies)
  - [Reply Likes](#9-reply-likes)
  - [Follow System](#10-follow-system)
  - [Stories](#11-stories)
  - [Story Views](#12-story-views)
  - [Reels](#13-reels)
  - [Profile](#14-profile)
  - [Search](#15-search)
  - [Search History](#16-search-history)
  - [Email Verification](#17-email-verification)
- [Response Format](#-response-format)
- [Database Schema](#-database-schema)
- [Localization](#-localization)
- [License](#-license)

---

## 🌟 About the Project

This project is a **complete Instagram clone API** — a pure backend with no frontend. It provides every feature you'd expect from a modern social media platform: user accounts, posts with media, comments and nested replies, stories, reels, a follow system, and more.

The API is stateless, secured via **OAuth 2.0 Bearer tokens** (Laravel Passport), and also protected by an **API key** header. It supports **English and Arabic** localization, making it accessible to a wider audience.

---

## 📱 Real-World Usage

This API powers a real Flutter mobile application built by **[Saleem Mahdi](https://github.com/saleem-15)**:

> **[instagram_clone (Flutter App)](https://github.com/saleem-15/instagram_clone)**
> A complete Instagram clone mobile app that consumes this API.

If you're a developer looking to build a frontend (mobile or web) on top of this API, Saleem's Flutter app is an excellent reference implementation showing exactly how every endpoint is consumed in a production app.

---

## ✨ Features

| Feature | Description |
|---|---|
| 🔐 **Authentication** | Register, login, logout with OAuth 2.0 Bearer tokens |
| 📧 **Email Verification** | Signed email verification links on registration |
| 🔑 **Password Reset** | Reset via emailed verification code |
| 🖼️ **Posts** | Create posts with multiple image/video attachments, update captions, delete |
| 💬 **Comments & Replies** | Nested two-level comment system with full CRUD |
| ❤️ **Likes** | Like/unlike posts, comments, and replies independently |
| 🔖 **Saved Posts** | Bookmark and retrieve saved posts |
| 👥 **Follow System** | Follow/unfollow users, list followers/following, search within them |
| 📖 **Stories** | Time-limited image/video stories with auto-expiry (scheduled command) |
| 👁️ **Story Views** | Track who viewed a story |
| 🎬 **Reels** | Upload and view short video reels |
| 👤 **Profiles** | View any user's public profile and their posts |
| 🔍 **Search** | Search users by name, with persistent search history |
| 🌍 **Localization** | Full Arabic and English support via a request header |
| 🛡️ **API Key Protection** | All routes protected by a shared API key header |

---

## 🛠 Tech Stack

| Layer | Technology |
|---|---|
| **Framework** | [Laravel 9](https://laravel.com) |
| **Language** | PHP 8.0.2+ |
| **Authentication** | [Laravel Passport](https://laravel.com/docs/passport) (OAuth 2.0) |
| **Database** | MySQL |
| **File Storage** | Laravel local disk (configurable) |
| **Email** | Laravel Mail (SMTP) |
| **Task Scheduling** | Laravel Scheduler (story expiry) |
| **Testing** | PHPUnit |

---

## 🚀 Getting Started

### Prerequisites

- PHP **8.0.2** or higher
- [Composer](https://getcomposer.org/)
- MySQL (or compatible) database server
- An SMTP mail server (for email verification and password reset)

### Installation

**1. Clone the repository**

```bash
git clone https://github.com/Mohammed-Alijl/instagram-API.git
cd instagram-API
```

**2. Install PHP dependencies**

```bash
composer install
```

**3. Copy the environment file and generate the application key**

```bash
cp .env.example .env
php artisan key:generate
```

**4. Configure your database** (see [Environment Configuration](#environment-configuration))

**5. Run database migrations**

```bash
php artisan migrate
```

**6. Install and configure Laravel Passport**

```bash
php artisan passport:install
```

**7. Create the storage symbolic link** (for media file access)

```bash
php artisan storage:link
```

**8. (Optional) Set up the task scheduler** for automatic story expiry.
Add the following Cron entry on your server:

```cron
* * * * * cd <YOUR_PROJECT_PATH> && php artisan schedule:run >> /dev/null 2>&1
```

**9. Start the development server**

```bash
php artisan serve
```

The API will be available at `http://localhost:8000`.

---

### Environment Configuration

Open `.env` and configure the following values:

```dotenv
APP_NAME="Instagram API"
APP_URL=http://localhost:8000

# API Key (used to authenticate all API requests — change this to something secret)
apiKey=your_secret_api_key_here

# Database
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=instagram
DB_USERNAME=root
DB_PASSWORD=your_password

# Mail (for email verification & password reset)
MAIL_MAILER=smtp
MAIL_HOST=your_smtp_host
MAIL_PORT=587
MAIL_USERNAME=your_email@example.com
MAIL_PASSWORD=your_email_password
MAIL_ENCRYPTION=tls
MAIL_FROM_ADDRESS="noreply@your-domain.com"
MAIL_FROM_NAME="${APP_NAME}"
```

---

## 🔐 Authentication

This API uses **OAuth 2.0 Bearer Tokens** via Laravel Passport.

### Flow

```
1. Register  →  POST /api/auth/user/register
2. Verify Email  →  Click link sent to email
3. Login  →  POST /api/auth/user/login  →  receive { access_token }
4. Use token  →  Authorization: Bearer {access_token}
```

### Token Usage

Include the token in the `Authorization` header of every protected request:

```
Authorization: Bearer eyJ0eXAiOiJKV1QiLCJhbGci...
```

---

## 📋 Request Headers

Every API request (authenticated or not) **must** include the following headers:

| Header | Value | Required | Description |
|---|---|---|---|
| `apiKey` | See `.env` (`apiKey` key, default: `p@ssword123`) | ✅ Yes | Shared API key — set `apiKey` in your `.env` to override the default |
| `Authorization` | `Bearer {token}` | ✅ On protected routes | OAuth 2.0 access token |
| `Accept` | `application/json` | ✅ Recommended | Ensures JSON responses |
| `lang` | `en` or `ar` | ❌ Optional | Response language (default: `en`) |

---

## 📚 API Reference

> **Base URL:** `http://your-domain.com/api`
>
> All endpoints require the `apiKey` header.
> Endpoints marked 🔒 also require the `Authorization: Bearer {token}` header.

---

### 1. Authentication

#### Register

```http
POST /auth/user/register
```

| Field | Type | Required | Description |
|---|---|---|---|
| `name` | string | ✅ | Unique username |
| `email` | string | ✅ | Unique email address |
| `password` | string | ✅ | Min 8 characters |
| `password_confirmation` | string | ✅ | Must match `password` |
| `phone` | string | ✅ | Unique phone number |
| `date_of_birth` | date | ✅ | Format: `YYYY-MM-DD` |
| `nick_name` | string | ❌ | Display name |
| `bio` | string | ❌ | Profile bio |
| `image` | file | ❌ | Profile picture (image file) |

**Response:**
```json
{
    "Data": {
        "access_token": "eyJ0eXAiOiJKV1Qi...",
        "user": { "..." }
    },
    "Status": 201,
    "Messages": "User registered successfully"
}
```

---

#### Login

```http
POST /auth/user/login
```

| Field | Type | Required | Description |
|---|---|---|---|
| `email` | string | ✅* | User's email *or* username *or* phone |
| `password` | string | ✅ | User's password |

> \* You may login with `email`, `name` (username), or `phone`. Only one is required.

**Response:**
```json
{
    "Data": {
        "access_token": "eyJ0eXAiOiJKV1Qi...",
        "user": { "..." }
    },
    "Status": 200,
    "Messages": "Login successful"
}
```

---

#### Logout 🔒

```http
POST /auth/user/logout
```

Revokes the current user's access token.

---

#### Get Authenticated User Info 🔒

```http
GET /auth/user/info
```

Returns the currently authenticated user's profile.

---

#### Send Password Reset Code

```http
POST /auth/user/password/code/send
```

| Field | Type | Required | Description |
|---|---|---|---|
| `email` | string | ✅ | Registered email address |

Sends a numeric reset code to the provided email address.

---

#### Verify Reset Code

```http
POST /auth/user/password/code/check
```

| Field | Type | Required | Description |
|---|---|---|---|
| `email` | string | ✅ | Registered email address |
| `code` | string | ✅ | The code received by email |

---

#### Reset Password

```http
POST /auth/user/password/reset
```

| Field | Type | Required | Description |
|---|---|---|---|
| `email` | string | ✅ | Registered email address |
| `code` | string | ✅ | The verified reset code |
| `new_password` | string | ✅ | New password (min 8 chars) |

---

### 2. User Management

#### Update Profile 🔒

```http
PUT /auth/user
```

| Field | Type | Required | Description |
|---|---|---|---|
| `name` | string | ❌ | New username |
| `email` | string | ❌ | New email |
| `bio` | string | ❌ | Profile bio |
| `nick_name` | string | ❌ | Display name |
| `phone` | string | ❌ | Phone number |
| `date_of_birth` | date | ❌ | Date of birth |

---

#### Update Profile Image 🔒

```http
POST /auth/user/update/image
```

| Field | Type | Required | Description |
|---|---|---|---|
| `image` | file | ✅ | New profile picture (image file) |

---

#### Change Password 🔒

```http
PUT /auth/user/password
```

| Field | Type | Required | Description |
|---|---|---|---|
| `old_password` | string | ✅ | Current password |
| `new_password` | string | ✅ | New password |
| `new_password_confirmation` | string | ✅ | Must match `new_password` |

---

#### Delete Account 🔒

```http
DELETE /auth/user
```

Permanently deletes the authenticated user's account and all associated data.

---

#### Get User by ID 🔒

```http
GET /user/{id}
```

Returns public profile information for the user with the given `id`.

---

### 3. Posts

#### List All Posts 🔒

```http
GET /post
```

Returns a paginated list of all posts.

| Query Param | Type | Description |
|---|---|---|
| `page` | integer | Page number (default: 1) |
| `per_page` | integer | Items per page |

---

#### Get Post 🔒

```http
GET /post/{id}
```

Returns a single post with its media and metadata.

---

#### Create Post 🔒

```http
POST /post
```

| Field | Type | Required | Description |
|---|---|---|---|
| `caption` | string | ❌ | Post caption/description |
| `media[]` | file | ❌ | One or more image/video files |

---

#### Update Post 🔒

```http
PUT /post/{id}
```

| Field | Type | Required | Description |
|---|---|---|---|
| `caption` | string | ✅ | Updated post caption |

> Only the post's owner can update it.

---

#### Delete Post 🔒

```http
DELETE /post/{id}
```

> Only the post's owner can delete it.

---

### 4. Post Likes

#### Get User's Liked Posts 🔒

```http
GET /post/like
```

Returns a paginated list of posts liked by the authenticated user.

---

#### Get Likes for a Post 🔒

```http
GET /post/like/{id}
```

Returns the list of users who liked the post with the given `id`.

---

#### Like a Post 🔒

```http
POST /post/like
```

| Field | Type | Required | Description |
|---|---|---|---|
| `post_id` | integer | ✅ | ID of the post to like |

---

#### Unlike a Post 🔒

```http
DELETE /post/like/{id}
```

Removes the authenticated user's like from the post with the given `id`.

---

### 5. Saved Posts

#### Get Saved Posts 🔒

```http
GET /post/save
```

Returns a paginated list of posts saved by the authenticated user.

---

#### Save a Post 🔒

```http
POST /post/save
```

| Field | Type | Required | Description |
|---|---|---|---|
| `post_id` | integer | ✅ | ID of the post to save |

---

#### Unsave a Post 🔒

```http
DELETE /post/save/{id}
```

Removes the post with the given `id` from the user's saved posts.

---

### 6. Comments

#### Get Comments for a Post 🔒

```http
GET /comment
```

| Query Param | Type | Description |
|---|---|---|
| `post_id` | integer | ID of the post to fetch comments for |
| `page` | integer | Page number |
| `per_page` | integer | Items per page |

---

#### Get Comment 🔒

```http
GET /comment/{id}
```

---

#### Create Comment 🔒

```http
POST /comment
```

| Field | Type | Required | Description |
|---|---|---|---|
| `post_id` | integer | ✅ | ID of the post to comment on |
| `comment` | string | ✅ | Comment text |

---

#### Update Comment 🔒

```http
PUT /comment/{id}
```

| Field | Type | Required | Description |
|---|---|---|---|
| `comment` | string | ✅ | Updated comment text |

> Only the comment's author can update it.

---

#### Delete Comment 🔒

```http
DELETE /comment/{id}
```

> Only the comment's author (or post owner) can delete it.

---

### 7. Comment Likes

#### Get Likes for a Comment 🔒

```http
GET /comment/like/{id}
```

Returns the list of users who liked the comment with the given `id`.

---

#### Like a Comment 🔒

```http
POST /comment/like
```

| Field | Type | Required | Description |
|---|---|---|---|
| `comment_id` | integer | ✅ | ID of the comment to like |

---

#### Unlike a Comment 🔒

```http
DELETE /comment/like/{id}
```

---

### 8. Replies

#### Get Replies for a Comment 🔒

```http
GET /comment/reply
```

| Query Param | Type | Description |
|---|---|---|
| `comment_id` | integer | ID of the comment |
| `page` | integer | Page number |
| `per_page` | integer | Items per page |

---

#### Get Reply 🔒

```http
GET /comment/reply/{id}
```

---

#### Create Reply 🔒

```http
POST /comment/reply
```

| Field | Type | Required | Description |
|---|---|---|---|
| `comment_id` | integer | ✅ | ID of the comment to reply to |
| `reply` | string | ✅ | Reply text |

---

#### Update Reply 🔒

```http
PUT /comment/reply/{id}
```

| Field | Type | Required | Description |
|---|---|---|---|
| `reply` | string | ✅ | Updated reply text |

---

#### Delete Reply 🔒

```http
DELETE /comment/reply/{id}
```

---

### 9. Reply Likes

#### Get Likes for a Reply 🔒

```http
GET /reply/like/{id}
```

---

#### Like a Reply 🔒

```http
POST /reply/like
```

| Field | Type | Required | Description |
|---|---|---|---|
| `reply_id` | integer | ✅ | ID of the reply to like |

---

#### Unlike a Reply 🔒

```http
DELETE /reply/like/{id}
```

---

### 10. Follow System

#### Follow a User 🔒

```http
POST /follow
```

| Field | Type | Required | Description |
|---|---|---|---|
| `user_id` | integer | ✅ | ID of the user to follow |

---

#### Unfollow a User 🔒

```http
DELETE /follow/{id}
```

`{id}` is the ID of the user to unfollow.

---

#### Check Follow Status 🔒

```http
GET /follow/{id}
```

Returns whether the authenticated user is following the user with the given `id`.

---

#### Get Following List 🔒

```http
GET /following/{id}
```

Returns a list of users that the user with `{id}` is following.

---

#### Get Followers List 🔒

```http
GET /followers/{id}
```

Returns a list of users who follow the user with `{id}`.

---

#### Search Following 🔒

```http
POST /following/search
```

| Field | Type | Required | Description |
|---|---|---|---|
| `search` | string | ✅ | Search query |

Searches within the authenticated user's following list.

---

#### Search Followers 🔒

```http
POST /followers/search
```

| Field | Type | Required | Description |
|---|---|---|---|
| `search` | string | ✅ | Search query |

Searches within the authenticated user's followers list.

---

### 11. Stories

#### Get All Stories 🔒

```http
GET /story
```

Returns a paginated list of stories from the users the authenticated user follows.

---

#### Get Story 🔒

```http
GET /story/{id}
```

---

#### Create Story 🔒

```http
POST /story
```

| Field | Type | Required | Description |
|---|---|---|---|
| `media` | file | ✅ | Image or video file for the story |

> Stories are automatically expired by the scheduler (`StoryExpire` command).

---

#### Delete Story 🔒

```http
DELETE /story/{id}
```

---

### 12. Story Views

#### Get Stories from a User 🔒

```http
GET /story/view/users/{id}
```

Returns all active stories for the user with the given `{id}`.

---

#### Get Story Views 🔒

```http
GET /story/view/{id}
```

Returns a list of users who viewed the story with the given `{id}`.

---

#### Record a Story View 🔒

```http
POST /story/view
```

| Field | Type | Required | Description |
|---|---|---|---|
| `story_id` | integer | ✅ | ID of the story that was viewed |

---

### 13. Reels

#### Get All Reels 🔒

```http
GET /reels
```

Returns a paginated list of all reels.

---

#### Get Reel 🔒

```http
GET /reels/{id}
```

---

#### Create Reel 🔒

```http
POST /reels
```

| Field | Type | Required | Description |
|---|---|---|---|
| `reels` | file | ✅ | Video file for the reel |

---

#### Delete Reel 🔒

```http
DELETE /reels/{id}
```

---

### 14. Profile

#### Get User Profile 🔒

```http
GET /profile/{id}
```

Returns a user's full public profile including their follower/following counts.

---

#### Get User's Posts 🔒

```http
GET /profile/posts/{id}
```

Returns a paginated list of posts created by the user with the given `{id}`.

| Query Param | Type | Description |
|---|---|---|
| `page` | integer | Page number |
| `per_page` | integer | Items per page |

---

### 15. Search

#### Search Users 🔒

```http
POST /user/search
```

| Field | Type | Required | Description |
|---|---|---|---|
| `search` | string | ✅ | Search query (matches name/username) |

---

### 16. Search History

#### Get Search History 🔒

```http
GET /search/history
```

Returns the authenticated user's past search queries.

---

#### Save Search to History 🔒

```http
POST /search/history
```

| Field | Type | Required | Description |
|---|---|---|---|
| `search` | string | ✅ | The search query to save |

---

#### Delete a Search History Entry 🔒

```http
DELETE /search/history/{id}
```

---

### 17. Email Verification

#### Verify Email Address

```http
GET /email/verify/{id}/{hash}
```

This is the signed URL sent to the user's email after registration. It verifies the email address.

> This link is generated automatically — you do not need to construct it manually.

---

## 📦 Response Format

All API responses follow a unified structure:

```json
{
    "Data": {},
    "Status": 200,
    "Messages": "A descriptive success or error message"
}
```

| Field | Type | Description |
|---|---|---|
| `Data` | object / array / null | The response payload. `null` for operations with no return data. |
| `Status` | integer | HTTP-equivalent status code |
| `Messages` | string / object | Human-readable message or validation error details |

### Common Status Codes

| Code | Meaning |
|---|---|
| `200` | OK — Request succeeded |
| `201` | Created — Resource created successfully |
| `422` | Unprocessable Entity — Validation failed |
| `401` | Unauthorized — Missing or invalid API key / Bearer token |
| `403` | Forbidden — Authenticated but not permitted |
| `404` | Not Found — Resource does not exist |
| `500` | Internal Server Error |

### Example: Validation Error (422)

```json
{
    "Data": null,
    "Status": 422,
    "Messages": {
        "email": ["The email has already been taken."],
        "password": ["The password must be at least 8 characters."]
    }
}
```

---

## 🗄 Database Schema

The application uses the following core database tables:

| Table | Description |
|---|---|
| `users` | User accounts (name, email, phone, bio, image, etc.) |
| `posts` | Posts with optional caption |
| `post_media` | Media files (images/videos) attached to posts |
| `comments` | Comments on posts |
| `replies` | Replies to comments |
| `likes` | Post likes (user ↔ post) |
| `comment_likes` | Comment likes (user ↔ comment) |
| `reply_likes` | Reply likes (user ↔ reply) |
| `user_followers` | Follow relationships (follower ↔ followed) |
| `stories` | Story media with timestamps |
| `views` | Story view records (user ↔ story) |
| `reels` | Reel video files |
| `post_saves` | Saved post records (user ↔ post) |
| `search_histories` | Per-user search history |
| `reset_code_passwords` | Password reset codes |
| `oauth_access_tokens` | Laravel Passport OAuth tokens |

---

## 🌍 Localization

The API supports **English** (`en`) and **Arabic** (`ar`). All validation messages, success messages, and error responses are translated.

To select a language, include the `lang` header in your request:

```
lang: ar
```

or

```
lang: en
```

If the header is omitted, the API defaults to **English**.

---

## 📄 License

This project is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).

---

<div align="center">

Built with ❤️ using [Laravel](https://laravel.com) · API consumed by [instagram_clone Flutter App](https://github.com/saleem-15/instagram_clone)

</div>
