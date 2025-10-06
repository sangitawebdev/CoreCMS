# 🧩 CoreCMS

**Version:** 1.0  
**Start Date:** October 2, 2025  
**Author:** CoreCMS Team  

---

## 🧠 Overview

**CoreCMS** is a lightweight, modular, and developer-friendly content management system inspired by WordPress — built for performance, simplicity, and scalability.  
It allows developers, bloggers, and businesses to easily manage posts, users, menus, and site settings from a clean and secure admin interface.

---

## 🚀 Features

### 🏠 General
- Clean, responsive admin dashboard  
- User-friendly navigation  
- SEO-friendly URLs and slugs  
- Fast page loading and optimized queries  

### 👥 User Management
- Roles: **Admin**, **Editor**, **Author**, **Subscriber**  
- Secure authentication using **BCRYPT**  
- Profile fields: nickname, display name, and user URL  
- Role-based access control  

### 📝 Content Management
- Create, edit, and delete posts  
- Draft and publish status management  
- Auto slug generation  
- Author association for each post  
- SEO meta fields per post  

### 🧭 Menu Management
- Create multiple menus (e.g., header, footer)  
- Add, edit, and reorder menu items dynamically  
- Menu-item linking to pages or external URLs  

### ⚙️ Settings & Configuration
- Centralized options table (`options`)  
- Manage site name, base URL, and dynamic fields via admin  
- Web-based setup wizard  

### 🔐 Authentication
- Login/logout system with session handling  
- Secure password hashing (PHP `password_hash`)  
- Error and validation handling  

### 🧩 Core Architecture
- **MVC Pattern**: Models, Views, Controllers  
- **Router** handles URL parsing and route dispatch  
- **Bootstrap** initializes database and environment  
- **Config system** for database credentials and constants  

---

## 🏗️ Folder Structure

