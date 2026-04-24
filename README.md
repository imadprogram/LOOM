# Loom - Modern Community Marketplace

Loom is a premium, fully responsive online marketplace built with **Laravel 11**, **Tailwind CSS**, and **DaisyUI**. It allows users to seamlessly buy, sell, and negotiate items within their community, supported by a robust real-time chatting system and an administrative moderation panel.

## 🚀 Features

### For Users

- **Dynamic Product Listings:** Easily list products by uploading up to 5 high-quality images, setting a price, category, and location.
- **Real-Time Messaging:** Built on **Laravel Reverb**, buyers and sellers can instantly message each other without refreshing the page. Red notification dots keep track of unread messages.
- **Smart Image Galleries:** View products smoothly with interactive thumbnail galleries and hover-to-zoom styled layouts.
- **Search & Discover:** Filter and find specific products quickly using the search functionality and category tags.
- **Report System:** Community-driven moderation allows users to report inappropriate or fake listings.
- **Mobile-First UX:** Intuitive, app-like experience on phones, tablets, and desktop with off-canvas hamburger menus and dynamic floating action buttons.

### For Administrators

- **Admin Dashboard:** Get a quick overview of platform statistics including active listings, active users, and recent activity.
- **User Management:** View all registered users and instantly ban/unban bad actors.
- **Listing Moderation:** View, edit, suspend, or permanently delete any listing on the platform.
- **Report Resolution:** Handle user reports efficiently and mark them as resolved after taking action.

## 🛠 Tech Stack

- **Backend:** PHP 8.2+, Laravel 11
- **Frontend:** Blade Templating, Tailwind CSS v4, DaisyUI v5
- **Database:** PostgreSQL (or MySQL)
- **Real-Time:** Laravel Reverb (WebSockets), Laravel Echo
- **Styling Tools:** Toastify-JS, SweetAlert2, Ionicons

## 📦 Installation & Setup

1. **Clone the repository**

    ```bash
    git clone https://github.com/imadprogram/LOOM.git
    cd LOOM
    ```

2. **Install Composer & NPM Dependencies**

    ```bash
    composer install
    npm install
    ```

3. **Environment Setup**
   Copy the example environment file and update your database credentials.

    ```bash
    cp .env.example .env
    php artisan key:generate
    ```

4. **Database Migration & Seeding**
   The seeders will automatically generate test categories, dummy listings, and test accounts.

    ```bash
    php artisan migrate:fresh --seed
    ```

    _Default Admin:_ `admin@example.com` / `adminadmin`
    _Default User:_ `imad@example.com` / `imadimad`

5. **Start the Development Servers**
   To experience the full features (including real-time chat), you need to run three processes concurrently:

    ```bash
    # Terminal 1: Run the Laravel PHP server
    php artisan serve

    # Terminal 2: Run the Vite frontend bundler
    npm run dev

    # Terminal 3: Run the WebSockets server for real-time messaging
    php artisan reverb:start
    ```

## 📱 Screenshots & UI

Loom features a modern, glassmorphic design strategy with focus on micro-animations and typography (Inter / System Fonts).

- **Responsive Navbar:** Automatically adapts from expanded desktop views to a sleek slide-down mobile menu.
- **Admin Sidebar:** Uses conditional mobile-first rendering with dark-mode overlays.
- **Dynamic Uploads:** Append and preview multiple image files before uploading, complete with hover-to-delete interactions.

## 📄 License

The Loom application is open-sourced software licensed under the MIT license.
