# 🗣️ Student4U – Student Complaint Management System

**Student4U** is a web-based platform developed to streamline the process of handling student complaints directed to the **MPP (Majlis Perwakilan Pelajar)**. It provides an efficient channel for students to voice their concerns, and for MPP representatives to respond, manage, and resolve issues transparently and effectively.

---

## 🎯 Purpose

This system was built to:
- Empower students to submit complaints or feedback easily.
- Help MPP track and manage complaints systematically.
- Provide transparency between student issues and student representatives.
- Ensure better communication and resolution flow within the university environment.

---

## 📂 Project Structure

```yaml
student4u/
├── controller/ # PHP controllers handling request logic
├── css/ # Styling for the UI
├── database/ # Database schema and config files
├── fonts/ # Font assets
├── image/ # Icons and image assets
├── js/ # JavaScript functionality
├── model/ # PHP models for database interaction
├── plugins/ # External JS/CSS libraries
├── view/ # HTML/PHP templates for UI
├── index.php # Main entry point of the app
└── README.md # Documentation file
```

---

## 🚀 Features

- 📝 **Student Complaint Submission**  
  Students can submit their concerns through a structured form.

- 📬 **Complaint Inbox for MPP**  
  MPP members can view, sort, and respond to student submissions.

- 🔍 **Tracking & Status**  
  Students can track the status of their complaints: Pending, In Review, or Resolved.

- 👤 **User Roles**  
  Separate roles for students and MPP members with appropriate access control.

- 📊 **Dashboard**  
  Overview of complaints submitted, status summary, and response metrics.

---

## 🛠️ Getting Started

### Prerequisites
- PHP 7.x or newer
- MySQL
- Apache or any PHP-supported web server

### Installation

1. **Clone the Repository**
   ```bash
   git clone https://github.com/NoorRaihan/student4u.git
   ```
   
2. Setup the Database
  1. Import the SQL file inside the database/ folder into your MySQL server.
  2. Update DB credentials in the configuration file.

3. Run the Application
  1. Deploy the project in your htdocs or appropriate web directory.
  2. Access the system via http://localhost/student4u/.

🖼️ Example Use Case
1. A student submits a complaint about poor Wi-Fi in a lecture hall.
2. The MPP team receives the complaint and assigns a representative.
3. The student receives updates on the status until it is resolved.
4. The issue is logged for transparency and tracking.

