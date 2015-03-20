# comp3013Databases
Building a database system 
As part of 3rd year UCL

<h3> To do for fri 13th: </h3>

Anuz
- 1. student-users will upload free text reports to their group account
- 2. student-users will be able to visually browse the other groups’ reports they have been allocated to review
- 3. student-users will submit grading assessments and comments on the reports assigned to them
- 4. student-users will be able to view assessments on their own reports made by other groups
- Done login/design etc 


Abbas 
- 7. student-users in a group will be able to discuss submissions with other members of their group via a forum which is threaded, browseable and searchable
- 5. Student-users will be able to know the ranking of their own aggregated mark within the aggregated marks for all groups.
- 6. student-users will upload their reports as XML files. The system will extract the data elements from the file and insert them into the database
- 8 student-users will be able to see the aggregate assessment grades received by each group that provides a grade on their own submissions


Mahi 
- 9. administrator-users will have a separate interface through which student registration will be managed and groups defined from the student registration list
- 10. the administrator-user interface will support searching for details of a particular student and browsing of student details
- 11. the administrator-user interface will allow particular groups to be allocated to the peer assessment of particular other groups
- 12. the administrator-users will be able to see a list of the groups ranked according with the aggregation of peer assessments on their submissions 
- 13. Validation checks on the login/registration forms

<b> Notes: </b>
- For forms where users enter data to be stored in the database, use mysqli_real_escape_string() to escape the data (make it store in a safe way). E.g. in a registration form, for the username (you'd do this for name, email etc too) you do: $username = mysqli_real_escape_string($connection, $username);


Stuff to include in video/report
- Everything validated - forms validated, mysql injection avoided (mysqli_real_escape_string(), - Strong validation checks e.g. registration
- Uploads - don't insert all the fields into the database - save space by uploading file and storing name of file
- Normilisation
- Foreign key definitions in Grade Table
- Boostrap / header design/ responsive - responsive screenshots for higher marks
- group by query in admin allocate 
- Created sql_model class - has class structure - allows us to use mvc by having all model data in this class, and having view logic in the view files (e.g. admin.php?allocateGroups). However may not have used everywhere due to time - only found about class use a week before deadline so didn't have time to convert everything over. A lot of sql queries remain in the php classes relevant to them. E.g. login.php has been changed, admin, browse_users, but not some like forum
Used it for admin.php - using php classes. Also heavily validated - e.g. assigning a new group, adding a new user, goes through various checks (filtering input) and escaping output (prepared statements / mysqli_real_escape_string / htmlentities() use). 
- Used prepared statements in sql_model class
- Customised error messageges - e.g. unaothorised.php access, registration, login - using helper_functions classes to give these message functions - errorMessage($title, $message), successMessage($title, $message)
- For good queries, maybe everyone go through their files and talk about good ones
