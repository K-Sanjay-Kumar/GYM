### Amara Jyothi Public School Website Code - Histudy Theme  

**Planned Features:**
1. **Website Theme:**  
   - The chosen theme is **Histudy** to provide an educational look and feel.  

2. **Development Approach:**  
   - Initial development in **PHP** for fast deployment.  
   - Future transition to **React.js** for enhanced interactivity and modern performance.  

3. **SEO Integration:**  
   - SEO optimization for all pages, ensuring visibility and better search engine rankings.  

4. **Admin Panel:**  
   - A **dynamic content management system** to allow admin control over updates and content customization.

---

### Setting up and Running PHP Files Using XAMPP  
Follow these steps to open and run the PHP files locally using XAMPP:

1. **Download and Install XAMPP:**  
   - Download XAMPP from [https://www.apachefriends.org](https://www.apachefriends.org).  
   - Install it and start the Apache and MySQL modules from the XAMPP control panel.

2. **Set Up Project Folder:**  
   - Navigate to the XAMPP installation directory (e.g., `C:/xampp/htdocs/`).  
   - Create a folder, e.g., `ajps`, and place all PHP project files in it.

3. **Configure Database:**  
   - Open `phpMyAdmin` from the XAMPP control panel.  
   - Create a new database (e.g., `ajps_db`).  
   - Import the SQL file (if any) related to the project using the `Import` tab.
   - Using aws database no need local setup we can use dummy database.

4. **Run PHP Files:**  
   - Open a browser and go to `http://localhost/ajps`.  
   - Access specific pages by navigating to `http://localhost/ajps/filename.php`.  

---

### Git Commands for Version Control  

#### **Cloning Repository:**  
If the repository is not already cloned:  
```bash
git clone https://github.com/hemanth19088/Ajpscode
```

#### **Pull Latest Changes (Main File Locked):**  
To fetch the latest updates and ensure your branch is updated:  
```bash
git fetch origin
git pull origin main
```

#### **Pushing Changes:**  
To push your changes after making updates:  
1. **Check the current branch:**  
   ```bash
   git branch
   ```
2. **Stage changes:**  
   ```bash
   git add .
   ```
3. **Commit changes:**  
   ```bash
   git commit -m "Brief description of changes"
   ```
4. **Push changes to the repository:**  
   ```bash
   git push origin <your-branch-name>
   ```

#### **Handling Locked Main File:**  
If the main branch is locked, create a feature branch:  
1. **Create a new branch:**  
   ```bash
   git checkout -b <feature-branch-name>
   ```
2. **Push your feature branch:**  
   ```bash
   git push origin <feature-branch-name>
   ```
3. **Merge requests:**  
   Submit a merge request to the repository's admin for review and inclusion.

---

### Transition Plan for React.js:  
1. **Setup:**  
   Install Node.js, React, and other dependencies using:  
   ```bash
   npm install react react-dom
   ```
2. **Rewrite Components:**  
   Rebuild each PHP module as a React component with reusable structures.  

3. **Integrate API Endpoints:**  
   Use RESTful APIs from the PHP backend to fetch and display dynamic content in React.  

4. **SEO with React:**  
   Configure server-side rendering (SSR) using frameworks like **Next.js** for SEO.
