<?php
session_start();
// require('../config.php');
class WebUser {	
	private $db;
	
    protected $hostName;
    protected $userName;
    protected $password;
	protected $dbName;
	private $userTable = 'user';
	private $dbConnect = false;
	public function __construct(){
        if(!$this->dbConnect){ 		
			
			// $database = new dbConfig();            
            // $this -> hostName = $database -> serverName;
            // $this -> userName = $database -> userName;
            // $this -> password = $database ->
			$conn = new mysqli('193.203.184.5', 'u289659885_ajps', 'Welcome@12367', 'u289659885_ajps');
            if($conn->connect_error){
                die("Error failed to connect to MySQL: " . $conn->connect_error);
            } else{
                $this->dbConnect = $conn;
            }
        }
    }	

	// get the gallery categories
	public function getCategories(){
		$sql = "SELECT * FROM categories";
		$result = mysqli_query($this->dbConnect, $sql);
	
		if ($result && mysqli_num_rows($result) > 0) {

			$categories = mysqli_fetch_all($result, MYSQLI_ASSOC);
			return ['data' => $categories];
		} else {
			return ['data' => []];
		}
	}

	// get the images for a specific category
	public function getCategoryById($id){
		$id = mysqli_real_escape_string($this->dbConnect, $id);
	
		$sql = "SELECT * FROM images WHERE category_id = '$id'";
	
		$result = mysqli_query($this->dbConnect, $sql);
	
		if ($result && mysqli_num_rows($result) > 0) {

			$images = mysqli_fetch_all($result, MYSQLI_ASSOC);
			return ['data' => $images];
		} else {
			return ['data' => []];
		}
	}
	
	// Get meta data of a specific page number
	public function getHeaderData($page) {
		$stmt = $this->dbConnect->prepare("SELECT * FROM seo WHERE page_number = ?");
		
		if ($stmt === false) {
			die("Error preparing SQL statement: " . $this->dbConnect->error);
		}
		$stmt->bind_param("i", $page);
		$stmt->execute();
		$result = $stmt->get_result();

		if ($result && $result->num_rows > 0) {
			return $result->fetch_assoc();
		} else {
			return null;
		}
	}

	// get total blogs
	public function getTotalBlogs() {
		$sql = "SELECT COUNT(*) AS total FROM blogs";
		$result = mysqli_query($this->dbConnect, $sql);
	
		if ($result) {
			$row = mysqli_fetch_assoc($result);
			return (int)$row['total'];
		} else {
			return 0; // Return 0 if query fails
		}
	}

	// get all the blogs based on the page and limit
	public function getBlogs($limit, $page) {
		// Calculate offset for pagination
		$offset = ($page - 1) * $limit;
	
		$stmt = $this->dbConnect->prepare("SELECT * FROM blogs ORDER BY created_at DESC LIMIT ? OFFSET ?");
		if ($stmt === false) {
			die("Error preparing SQL statement: " . $this->dbConnect->error);
		}
		$stmt->bind_param("ii", $limit, $offset);
		$stmt->execute();
		$result = $stmt->get_result();

		$blogs = [];
		while ($row = $result->fetch_assoc()) {
			$blogs[] = $row;
		}
	
		// Close the statement and connection
		$stmt->close();
	
		// Return the blogs in the required format
		return ['data' => $blogs];
	}	

	// get latest blogs
	public function getLatestBlogs($limit) {

		$stmt = $this->dbConnect->prepare("SELECT * FROM blogs ORDER BY created_at DESC LIMIT ?");
		if ($stmt === false) {
			die("Error preparing SQL statement: " . $this->dbConnect->error);
		}
		$stmt->bind_param("i", $limit);
		$stmt->execute();
	
		$result = $stmt->get_result();
		$latestBlogs = [];
		while ($row = $result->fetch_assoc()) {
			$latestBlogs[] = $row;
		}
	
		// Close the statement
		$stmt->close();
	
		// Return the latest blogs
		return ['data' => $latestBlogs];
	}
	
	// get recent blog tags
	public function getBlogTags() {

		$stmt = $this->dbConnect->prepare("SELECT tags FROM blogs ORDER BY created_at DESC LIMIT 1");
		if ($stmt === false) {
			die("Error preparing SQL statement: " . $this->dbConnect->error);
		}
		$stmt->execute();
		$result = $stmt->get_result();
		$tags = [];
		if ($result && $row = $result->fetch_assoc()) {
			$tags = array_map('trim', explode(',', $row['tags']));
		}
	
		// Close the statement
		$stmt->close();
	
		// Return the tags
		return ['tags' => $tags];
	}
	

	public function getBlogDetails($id) {
		
		$id = mysqli_real_escape_string($this->dbConnect, $id);
	
		// Prepare the SQL query to fetch blog details by ID
		$stmt = $this->dbConnect->prepare("SELECT * FROM blogs WHERE id = ?");
		if ($stmt === false) {
			die("Error preparing SQL statement: " . $this->dbConnect->error);
		}
	
		// Bind the parameter (ID) to the query
		$stmt->bind_param("i", $id);
	
		// Execute the query
		$stmt->execute();
	
		// Fetch the result
		$result = $stmt->get_result();
		$blogDetails = $result->fetch_assoc();
	
		// Close the statement
		$stmt->close();
	
		// Return the blog details
		return $blogDetails ? $blogDetails : null;
	}
	

}

?>