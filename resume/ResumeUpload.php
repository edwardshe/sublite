<?php
	require_once('S3.php');

	class ResumeUpload {
		function upload() {
			$error = "test";
			if(isset($_POST['submitbtn'])) // Begin validation
			{
				if(array_key_exists('userFile', $_FILES)) // Ensure that the key exists first
				{
				    if ($_FILES['userFile']['error'] === UPLOAD_ERR_OK) // Upload succeeded
				    {
						$filename = $_FILES["userFile"]["name"];
						$ext = pathinfo($filename, PATHINFO_EXTENSION);
						$allowed = array("doc", "docx", "rtf", "pdf", "txt", "odf");

						$fname = $_FILES["userFile"]["tmp_name"];

						// Make sure extension matches
						if(in_array($ext, $allowed))
						{
							if($_FILES['userFile']['size'] < 2097152) // Validate size again
							{	
									$bucket = 'sublite-resumes';

									//Can use existing configs when merging with sublite
									$s3 = new S3("AKIAI7IVRJCSAWFTTS7Q", "B0qzRQJ1KlLy+STC2BspwT9oZONjt+U6sRNqaRr5");

									$s3->putBucket($bucket, S3::ACL_PUBLIC_READ);

									$actual_image_name = time() . '.' . $ext;

									if($s3->putObjectFile($fname, $bucket , $actual_image_name, S3::ACL_PUBLIC_READ) )
								    {
								        $image='http://'.$bucket.'.s3.amazonaws.com/'.$actual_image_name;
								        return $image;
								    }else{
								        return "An unknown error occurred during upload!";
								    }

/*								// File validated; Upload the file! !!!Need to upload to S3!!!
								$uploaddir = 'resumes/';
								$uploadfile = basename($_FILES['userFile']['name']);

								if (move_uploaded_file($_FILES['userFile']['tmp_name'], $uploaddir.$uploadfile)) {
								    return "File is valid, and was successfully uploaded.\n";
								} else {
								    return "An unknown error occurred during upload!";
								} */
							}
							else
							{
								$error = "Max file size exceeded!";
							}
						}
						else
						{
							$error = "Bad file extension!";
						}
				    } 
				    else if ($_FILES['userFile']['error'] === UPLOAD_ERR_FORM_SIZE) // Max file size exceeded
				    {
				    	$error = "Max file size exceeded!";
				    }
				    else if ($_FILES['userFile']['error'] === UPLOAD_ERR_NO_FILE) // Max file size exceeded
				    {
				    	$error = "You must choose a file!";
				    }
				    else // Unknown Error
				    {
				        $error = "An unknown error occurred during upload!";
				    }

				    return $error;
				}	
			}
		}
	} 

	$ResumeUploader = new ResumeUpload();
?>