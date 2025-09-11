# 🤝 HelpHub – Donation Management Website

## 📖 Project Description
**HelpHub** is a web-based platform designed to simplify **donation management** between donors and associations.  
It allows users to create accounts, make donations, manage projects, and track contributions.  
The system ensures transparency, accessibility, and an intuitive user experience through a modern, responsive design.

---

## 👥 Authors
- **Mohamed Khalil Nafati**  
- [@MoKhalilNafati](https://github.com/MoKhalilNafati)

- **Ahmed Khatmi**  
- [@AhMeD-KhaTmi](https://github.com/AhMeD-KhaTmi)

---

## 🗂️ Project Structure
- **Homepage (index.html)**  
  - Welcome message and introduction to HelpHub  
  - Navigation to login and registration pages  
  - Responsive design with Bootstrap  
  - Statistics section showing total donors and latest donor  

- **Registration Page (register.html + traitement_register.php)**  
  - Two roles: **Donor** or **Association Manager**  
  - Fields: Name, Surname, CIN, Email, Username, Password  
  - Extra fields for associations (Name, Address, Fiscal ID, Logo)  
  - Validation with JavaScript (`register_validation.js`)  
  - Data insertion into the database  

- **Login Page (login.php)**  
  - Username and password fields  
  - Error messages displayed via PHP sessions  
  - Secure authentication  

- **Association Dashboard (dashboard_assoc.php)**  
  - Personalized welcome with logo  
  - Features:  
    - Add a new project  
    - View projects  
    - Edit profile  
    - Logout  

- **Donor Dashboard (dashboard_donor.php)**  
  - Features:  
    - Explore available projects  
    - View personal donations  
    - Logout  

- **Add Project (ajouter_projet.php)**  
  - Association can create projects with:  
    - Title, description, target amount, deadline  
  - Input validation (amount > 0, valid deadline)  
  - Errors shown with Bootstrap alerts  

- **Make a Donation (participer.php)**  
  - Donor selects a project and enters donation amount  
  - Validation:  
    - Amount > 0  
    - Amount ≤ remaining target  
    - Within project deadline  
  - Database updated (project progress + donor history)  
  - Success message and redirection to "My Donations"  

---

## ✨ Key Features
- User roles: **Donor** and **Association**  
- Secure authentication with PHP sessions  
- Bootstrap-based responsive design  
- Dynamic project and donation management  
- Error handling and validation (PHP + JavaScript)  
- Database integration for storing users, donations, and projects  

---

## 🚀 Installation & Usage
1. Clone the repository:  
   bash:
   git clone https://github.com/MoKhalilNafati/HelpHub-Donation-Management-Website.git
2. Import the provided SQL file into your MySQL/MariaDB database.

3. Update config.php with your database credentials.

4. Start a local server (e.g., XAMPP, WAMP, or MAMP).

5. Open index.html in your browser.
