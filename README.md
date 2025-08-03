# 🧠 Project Management System for Teams

> A modern and collaborative platform for managing projects, tasks, and teams — built with Laravel.

---

## 📌 Overview

This is a full-featured **project management system** tailored for teams in business environments. It enables **task assignment**, **progress tracking**, **team collaboration**, and **company organization** in one centralized workspace.

---

## 🚀 Core Features

### 👥 User Management
- Secure authentication (Laravel Fortify)
- Role-based access control
- Social login (Google, GitHub, etc.)
- User profiles and team roles

### 📁 Project & Task Management
- Create and manage projects and tasks
- Assign tasks to team members
- Monitor task/project progress
- File attachments for tasks

### 💬 Team Collaboration
- Real-time in-app chat
- Threaded task comments
- Instant notifications (Pusher / Laravel Echo)
- Internal messaging support

### 🏢 Company & Teams
- Manage company profiles
- Organize users into teams/departments
- Department-level access and roles

---

## 🛠️ Tech Stack

| Layer       | Technology                              |
|-------------|------------------------------------------|
| Backend     | Laravel  10.x                            |
| Database    | MySQL                                    |
| Auth        | Laravel Fortify, Laravel Socialite       |
| Real-time   | Laravel Echo + Pusher / Socket.io        |
| Frontend    | Blade, bootstribe CSS, Alpine.js         |
| Icons       | font Awsson                              |
| Dev Tools   | Composer, NPM, Git                       |

---

## 📁 Project Structure

```plaintext
app/
├── Http/Controllers/      → Business logic controllers
│   ├── Auth/              → Login & registration
│   └── Dashboard/         → Main app logic
├── Models/                → Eloquent data models
├── Notifications/         → App notifications
├── View/Components/       → Blade UI components
├── Events/ & Listeners/   → Event-driven architecture

routes/
├── web.php                → Public & dashboard routes
├── api.php                → API endpoints
├── dashboard/             → Internal dashboard routes

resources/
├── views/                 → Blade templates
├── components/            → Shared UI elements
└── js/                    → Frontend interactivity

```

## Architecture & Patterns
- **MVC Architecture**: Follows Laravel's MVC pattern
- **Component-Based UI**: Utilizes Blade components for reusable UI elements
- **Repository Pattern**: Data access layer abstraction
- **Service Layer**: Business logic encapsulation

## Key Observations
1. The application follows Laravel's conventions and best practices
2. Implements a clean separation of concerns between business logic and presentation
3. Uses Laravel's built-in notification system for user alerts
4. Features real-time updates for chat and notifications
5. Responsive design for cross-device compatibility

## Dependencies
- Laravel Fortify (Authentication)
- Laravel Socialite (Social login)
- Pusher (WebSockets)
- Intervention Image (Image handling)
- Laravel Debugbar (Development)

---
*Last Updated: 2025-08-03*
