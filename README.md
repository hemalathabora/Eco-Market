
# ♻️ Eco-Market

Eco-Market is an e-commerce web platform focused on eco-friendly and sustainable products. It supports both **admin** and **user** roles and is built using **PHP & MySQL**, with a clean and responsive Bootstrap frontend.

---

## 🌿 Project Objectives

- Promote eco-friendly and sustainable living through a dedicated marketplace.
- Allow admins to manage product listings and monitor users.
- Enable users to register, browse, and purchase eco-products.
- Provide a clean, modern UI with login and registration functionality.

---

## ✨ Features

### 🔐 Authentication
- Secure **User Login & Registration** using PHP sessions.
- Passwords stored with **PHP `password_hash()`** for security.
- Role-based login (Admin/User).

### 🛍️ For Users
- Browse eco-products.
- Apply or purchase items.
- User dashboard (future scope).

### ⚙️ For Admins
- Add/edit/remove eco-products.
- Monitor registered users.
- Admin dashboard (in progress).

### 🎨 UI/UX
- Clean, modern Bootstrap styling.
- Centered login/register forms with animations and transitions.
- Fully responsive for desktop and mobile.

---

## 🧑‍💻 Tech Stack

| Layer         | Technology         |
|---------------|--------------------|
| Frontend      | HTML, CSS, Bootstrap |
| Backend       | PHP                 |
| Database      | MySQL (phpMyAdmin)  |
| Web Server    | Apache (XAMPP)      |
| Version Control | Git + GitHub     |

---

## 📂 Folder Structure

```bash
eco_market/
├── includes/
│   ├── header.php
│   └── footer.php
├── config.php
├── login.php
├── register.php
├── index.php
├── admin_dashboard.php (optional/future)
├── product_list.php
├── README.md
````

---

## 🚀 Getting Started (Local Setup)

1. **Clone the Repository**

```bash
git clone https://github.com/hemalathabora/Eco-Market.git
cd Eco-Market
```

2. **Set up your XAMPP server**

* Place the project in `C:/xampp/htdocs/eco_market/`.
* Start Apache & MySQL from the XAMPP control panel.

3. **Configure the Database**

* Open `phpMyAdmin` at `http://localhost/phpmyadmin`.
* Create a database: `eco_market`.
* Run the SQL script to create a `users` table:

```sql
CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    email VARCHAR(100) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    role ENUM('admin','user') DEFAULT 'user'
);
```

* You can add a `products` table if you're implementing product listings.

4. **Update `config.php`**

```php
<?php
$conn = new mysqli("localhost", "root", "", "eco_market");
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
```



## 🧪 Future Enhancements

* Add product catalog and shopping cart.
* Payment integration.
* Admin analytics dashboard.
* Email verification and password recovery.
* REST API for future mobile app support.

---

## 🙌 Contributing

Pull requests are welcome! To contribute:

1. Fork the repo
2. Create a new branch
3. Make your changes
4. Submit a pull request

---

## 📝 License

This project is open-source under the MIT License.

---

## 📬 Contact

Made with ❤️ by [Hemalatha Bora](https://github.com/hemalathabora)

