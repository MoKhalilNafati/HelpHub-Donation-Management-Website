# HelpHub - Donation Website

HelpHub is a website built to help associations collect donations for their causes. It's a platform where people who want to donate can connect with associations that need help.

This project was built for a web project class at ISG Tunis.

---

## 👥 Authors
- **Mohamed Khalil Nafati**  
- [@MoKhalilNafati](https://github.com/MoKhalilNafati)

- **Ahmed Khatmi**  
- [@AhMeD-KhaTmi](https://github.com/AhMeD-KhaTmi)

---

## 📸 What it Looks Like

**Homepage**

<img width="1241" height="881" alt="image" src="https://github.com/user-attachments/assets/871adabd-1635-409b-9d30-7b1afa8e79f4" />

*This is the first page everyone sees. It shows what the site is about and has live stats, like how many donors there are and who donated last.*

**Sign Up Page**

<img width="1019" height="468" alt="image" src="https://github.com/user-attachments/assets/a6ca195e-7c21-41d1-a433-50f130512829" />

*New users can sign up as a "Donor" or an "Association." If you pick "Association," a few extra fields pop up asking for your group's name and logo.*

**Association Dashboard**

<img width="1035" height="497" alt="image" src="https://github.com/user-attachments/assets/a6fc77d2-ef41-41e3-8426-3a911f8480c2" />

*When an association logs in, they see this page. From here, they can add new projects, see their current ones, or change their profile.*

**Donor Dashboard**

<img width="1070" height="518" alt="image" src="https://github.com/user-attachments/assets/049b160d-4f03-475e-a7a5-8993325673b8" />

*When a donor logs in, they see this simple page. They can look for projects to support or check their past donation history.*

## ✨ What it Does

### For Everyone
* **Two Types of Users:** The site works for both "Donors" (who give money) and "Associations" (who collect it).
* **Sign Up & Log In:** A full system for users to create accounts and log in securely.
* **Works on Mobile:** The website is built with Bootstrap, so it looks good and is easy to use on phones and tablets.

### For Donors
* **Find Projects:** Donors can browse a list of all projects that need funding.
* **Donate Easily:** A simple and safe way to give money to a project.
* **See Your History:** Donors can look up a list of all the donations they've made.

### For Associations
* **Special Dashboard:** A control panel just for associations.
* **Create Projects:** Associations can easily post new projects, adding a title, description, and how much money they need.
* **Manage Profile:** They can update their info and upload their association's logo.

### Security
* **Safe Donations:** The site checks every donation to make sure the amount is valid and the project is still active.
* **Smart Forms:** The site uses PHP code to block common hacking attempts (like SQL injection) and protect user data.
* **Checks Inputs:** Uses JavaScript to make sure users fill out the forms correctly before they can even submit them.

## 🛠️ How it Was Built

* **Backend (Server):** **PHP** (for all the logic) and **MySQL** (for the database).
* **Frontend (Browser):** **HTML**, **CSS**, and **JavaScript**.
* **Frameworks:** **Bootstrap 5** (to make it look good and work on mobile) and **Bootstrap Icons**.

## 🚀 How to Run it Locally

Here's how to get the project running on your own computer.

### You Will Need
* A local server like **XAMPP** or **WAMP** (this gives you PHP and MySQL).

### Installation Steps

1.  **Clone the repo:**
    ```sh
    git clone https://github.com/MoKhalilNafati/helphub.git
    ```
2.  **Move the folder:**
    * Drag the `helphub` project folder into your server's main web directory (usually called `htdocs` in XAMPP).
3.  **Set up the Database:**
    * Go to `phpMyAdmin` in your XAMPP control panel.
    * Create a new, empty database.
    * Find the `.sql` file in the project folder and import it into your new database. This will create all the tables.
4.  **Connect the Database:**
    * Find and open the `config.php` file in the project.
    * Change the database name, username, and password to match your local setup. (For XAMPP, the username is usually "root" and the password is empty).
5.  **All done!**
    * Open your browser and go to `http://localhost/helphub/`. The site should now be working!
