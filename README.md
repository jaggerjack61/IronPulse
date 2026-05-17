# IronPulse

A fitness community platform built with **Laravel 13** and **Livewire**. Users can participate in categorized forums, read admin-curated blog posts, message each other in real-time, and follow users for activity updates. Admins can publish blog content and send direct messages to user mailboxes.

---

## Features

### Forums
- Browse fitness discussion categories (General, Workout Routines, Nutrition, Supplements, Progress Logs)
- Create posts within any category
- Comment on posts with threaded reply support
- Like or dislike posts and comments
- View counters on forum posts

### Blog
- Admin-managed blog posts with publish/draft workflow
- Public blog listing and individual article viewing
- Reader comments on blog posts

### Messaging
- Start conversations with any registered user
- Real-time chat via Laravel Reverb (WebSocket)
- Read receipts on direct messages

### Mailbox
- Admins can broadcast messages directly to user mailboxes
- Users receive and read admin communications in a dedicated inbox

### Social
- Follow and unfollow other users
- Public user profiles with activity stats
- Edit your own profile (name, bio, avatar upload)

### Admin Panel
- Dashboard with site statistics
- Create, manage, and delete blog posts
- Send mailbox messages to any user
- Manage forum categories

---

## Tech Stack

| Layer | Technology |
|-------|------------|
| Framework | Laravel 13 |
| Frontend | Livewire + Blade + Tailwind CSS |
| UI Components | Flux UI |
| Auth | Laravel Fortify |
| Database | MySQL |
| Real-time | Laravel Reverb (WebSocket) |
| Build Tool | Vite |

---

## Requirements

- PHP 8.3+
- MySQL 8.0+ / MariaDB 10.4+
- Composer 2.x
- Node.js 20+
- NPM 10+

---

## Installation

1. **Clone the repository**

   ```bash
   git clone <repository-url>
   cd IronPulse
   ```

2. **Install PHP dependencies**

   ```bash
   composer install
   ```

3. **Install Node.js dependencies**

   ```bash
   npm install
   npm run build
   ```

4. **Configure environment**

   ```bash
   cp .env.example .env
   php artisan key:generate
   ```

   Update `.env` with your database credentials:

   ```env
   DB_CONNECTION=mysql
   DB_HOST=127.0.0.1
   DB_PORT=3306
   DB_DATABASE=ironpulse
   DB_USERNAME=root
   DB_PASSWORD=
   ```

5. **Create the database**

   ```sql
   CREATE DATABASE ironpulse CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
   ```

6. **Run migrations and seeders**

   ```bash
   php artisan migrate:fresh --seed
   ```

7. **Link storage for avatars and uploads**

   ```bash
   php artisan storage:link
   ```

8. **Optimize for production (optional)**

   ```bash
   php artisan optimize
   ```

---

## Running the Application

### Development

Open three separate terminals and run each command:

```bash
# Terminal 1 — Laravel development server
php artisan serve

# Terminal 2 — Laravel Reverb real-time server
php artisan reverb:start

# Terminal 3 — Queue worker for notifications and background jobs
php artisan queue:listen --tries=1
```

Visit: [http://localhost:8000](http://localhost:8000)

### With the provided dev script

```bash
composer run dev
```

This runs the Laravel server, queue listener, and Vite dev server concurrently.

---

## Default Credentials

| Role | Email | Password |
|------|-------|----------|
| Admin | `admin@ironpulse.com` | `password` |
| User | `user@ironpulse.com` | `password` |

---

## Project Structure

```
IronPulse/
├── app/
│   ├── Http/Controllers/       # Forum, Blog, Message, Mailbox, Profile, Admin
│   ├── Livewire/
│   │   ├── Forum/              # Index, Category, Post
│   │   ├── Blog/               # Index, Show
│   │   ├── Message/            # Inbox, Conversation, Compose
│   │   ├── Mailbox/            # Index, Show
│   │   ├── Admin/              # Dashboard, BlogPostCreate, BlogPostManage, MailboxSend, ForumCategoryManage
│   │   ├── Profile/            # Show, Edit
│   │   └── Components/         # LikeButton, FollowButton, CommentSection, NotificationDropdown
│   ├── Models/
│   │   ├── User.php
│   │   ├── ForumCategory.php
│   │   ├── ForumPost.php
│   │   ├── BlogPost.php
│   │   ├── Comment.php
│   │   ├── Like.php
│   │   ├── Follow.php
│   │   ├── Conversation.php
│   │   ├── Message.php
│   │   └── MailboxMessage.php
│   ├── Events/
│   │   └── NewMessage.php
│   ├── Http/Middleware/
│   │   └── EnsureAdmin.php
│   └── Policies/
│       └── UserPolicy.php
├── database/
│   ├── migrations/              # All application migrations
│   └── seeders/
│       ├── DatabaseSeeder.php
│       ├── UserSeeder.php
│       ├── ForumCategorySeeder.php
│       └── BlogPostSeeder.php
├── resources/
│   └── views/
│       ├── forums/             # Index, Category, Show
│       ├── blog/               # Index, Show
│       ├── messages/           # Index, Show
│       ├── mailbox/            # Index, Show
│       ├── profile/            # Show
│       ├── admin/              # Dashboard
│       └── livewire/           # Component views
└── routes/
    ├── web.php
    └── channels.php
```

---

## Routes

### Public
| Route | Description |
|-------|-------------|
| `GET /` | Welcome page |
| `GET /forums` | Forum categories |
| `GET /forums/{category}` | Category posts |
| `GET /forums/{category}/{post}` | Single post |
| `GET /blog` | Blog listing |
| `GET /blog/{post}` | Blog article |
| `GET /users/{user}` | Public profile |

### Authenticated
| Route | Description |
|-------|-------------|
| `GET /forums/create/{category}` | Create forum post |
| `GET /messages` | Message inbox |
| `GET /messages/{conversation}` | Conversation |
| `GET /messages/compose/{user?}` | New message |
| `GET /mailbox` | Mailbox inbox |
| `GET /mailbox/{message}` | Read mailbox message |
| `GET /profile/edit` | Edit profile |

### Admin Only
| Route | Description |
|-------|-------------|
| `GET /admin` | Admin dashboard |
| `GET /admin/blog` | Manage blog posts |
| `GET /admin/blog/create` | Create blog post |
| `GET /admin/mailbox/send` | Send mailbox message |
| `GET /admin/forums` | Manage categories |

---

## Database Design

### Users
Extended default Laravel `users` table with `role` (user/admin), `bio`, and `avatar`.

### Forum System
- `forum_categories` — name, slug, description, icon, sort order
- `forum_posts` — title, slug, body, pinned, locked, views count, soft deletes
- Polymorphic `comments` — supports forum posts and blog posts
- Polymorphic `likes` — like or dislike on posts, comments, and blog posts

### Blog System
- `blog_posts` — title, slug, body, excerpt, featured image, published_at, soft deletes

### Messaging System
- `conversations` — conversation threads
- `conversation_user` — many-to-many participant links
- `messages` — body, read_at, belongs to conversation and user

### Admin Mailbox
- `mailbox_messages` — sender_id (admin), recipient_id, subject, body, read_at

### Social
- `follows` — follower_id, following_id with unique constraint

---

## Real-Time Configuration

Laravel Reverb is pre-configured in `.env`:

```env
BROADCAST_CONNECTION=reverb

REVERB_APP_ID=ironpulse
REVERB_APP_KEY=ironpulse_key
REVERB_APP_SECRET=ironpulse_secret
REVERB_HOST=localhost
REVERB_PORT=8080
REVERB_SCHEME=http

REVERB_SERVER_HOST=127.0.0.1
REVERB_SERVER_PORT=8080
```

The `NewMessage` event broadcasts to private `conversation.{id}` channels. Authorized users in a conversation receive instant message updates.

---

## Testing

Run the full test suite:

```bash
php artisan test
```

Run with code style check:

```bash
composer run test
```

---

## License

This project is open-source software licensed under the [MIT license](https://opensource.org/licenses/MIT).
