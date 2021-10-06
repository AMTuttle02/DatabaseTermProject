# DatabaseTermProject
#Stage 3: Development Plan and Development Environment

**1. Databases and Software Languages:**
Database – MySQL
Server Script- PHP
Scraper for MyAkron- Python
Web Development – HTML (maybe CSS)

**2. Relational Schema:**
Course Information Table: Course Number (Unique), Course Name, Start Time (Distinct), End Time (Distinct) (Primary Key), Room ID
Classroom Information Table: Room ID (Unique), Location (Primary Key), Room Number, Capacity
User Input Table: Room ID, User ID (Unique), Start Time (Distinct), End Time (Distinct) (Primary Key)

**3. Data Location for Application:**
We can retrieve the course information from the MyAkron search function that includes all class times and locations.  The course information will be obtained using a python package called ‘Beautiful Soup’. This package will access the MyAkron’s class search tool in order to find classes in a certain time frame. It will grab the necessary information from the HTTP page and export it in a file format that can be used to fill the database the user will be accessing. We will be receiving user input as well, to allow the user to reserve a classroom during a specific time. This time cannot be overlapped with a course time.
 
**4. Task Division:**
MySQL code - All of us
Web Development – Alex & Mitch
Server Script – Alex & Mitch 
Scraping – Lee

**5. Timeline:**
Executing SQL code and Scraping Start- Because of midterms, October 18th 
-	(Hopefully finished before the start of server scripting language).
Server-side scripting language and Web Development Start - October 25 
-	(Finished by Wednesday November 3rd before demo)
Milestone: Finishing touches – Week of demo (November 1)
Finish Web Scraping – Finish by November 30
Milestone: Finish Website Style – Finish by November 30
