# IP Check System

"A corporate-level security system for managing employee logins and session control. Admins monitor active sessions, IP logs, and access reports, while employees can view their login history. It restricts simultaneous logins from multiple IPs, ensuring secure remote work environments and maintaining transparency in organizational access control."

---

## 🚀 Key Features

- **Concurrent Session Prevention:** Restricts single user accounts from logging in simultaneously from different IP addresses.
- **Real-Time IP Logging:** Tracks detailed access logs including IP address, device user-agent, geolocation, and timestamps.
- **Admin Security Dashboard:** Gives administrators full visibility over active user sessions, suspicious activity, and audit logs.
- **Employee Portal:** Allows employees to review their active login sessions and past login activity.
- **Automatic Session Termination:** Forcefully terminates active sessions if suspicious IP changes or policy violations occur.

---

## 🛠️ Tech Stack

- **Backend:** Laravel / PHP
- **Database:** MySQL
- **Frontend:** HTML5, CSS3, Bootstrap, JavaScript, Blade Templating
- **Security Protocols:** Session Middleware, Custom IP Whitelisting / Blacklisting

---

## 💻 Local Setup Instructions

Follow these step-by-step instructions to set up and run the project in your local development environment:

### 1. **Clone the Repository**
Clone the project repository to your local machine and navigate into the project directory:

```bash
git clone [https://github.com/Zunair-01/ip-check-system.git](https://github.com/Zunair-01/ip-check-system.git)
cd ip-check-system

```

### 2. **Install PHP Dependencies**

Install all required Composer packages and backend dependencies:

```bash
composer install

```

### 3. **Configure Environment File**

Create a copy of the default environment configuration file:

```bash
# On Windows (CMD / PowerShell):
copy .env.example .env

# On Linux / macOS / Git Bash:
cp .env.example .env

```

### 4. **Generate Application Key**

Generate the Laravel security and encryption key:

```bash
php artisan key:generate

```

### 5. **Configure Database & Credentials**

Start your local MySQL server (via XAMPP, WAMP, or terminal), create a database named `ip_check_db`, and update the `.env` file:

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=ip_check_db
DB_USERNAME=root
DB_PASSWORD=

```

### 6. **Run Database Migrations & Seeders**

Create database tables and populate initial roles, admin credentials, and sample logs:

```bash
php artisan migrate --seed

```

### 7. **Link Storage Directory**

Create the symbolic link for public file access and report downloads:

```bash
php artisan storage:link

```

### 8. **Start the Application**

Launch the Laravel development server:

```bash
php artisan serve

```

Access the application in your browser at: **`http://127.0.0.1:8000`**
