<?php 
// Welcome Controller File (Welcome.php)
public function uploadPhoto()
	{	
		// Replace the 'photo' value with the name of input that you are specifying in the HTML.
		// The input type must be an array variable. 
		//<input type="file" name="photo[]" />
		// This uploader will work for Single as well as the Multiple Image uploader. 

		if($this->input->post('savedata') && !empty($_FILES['photo']['name']))
		{
            $filesCount = count($_FILES['photo']['name']);            
            for($i = 0; $i < $filesCount; $i++){            	
                
                // For Checking Purpose of the data submitted
                
                /*echo 'File Name'.$_FILES['file']['name']     = $_FILES['photo']['name'][$i];
                echo '<br>';
                echo 'File Type'.$_FILES['file']['type']     = $_FILES['photo']['type'][$i];
                echo '<br>';
                echo 'File TMP Name'.$_FILES['file']['tmp_name'] = $_FILES['photo']['tmp_name'][$i];
                echo '<br>';
                echo 'File Error'.$_FILES['file']['error']     = $_FILES['photo']['error'][$i];
                echo '<br>';
                echo 'File Size'.$_FILES['file']['size']     = $_FILES['photo']['size'][$i];
                exit;*/

                $_FILES['file']['name']     = $_FILES['photo']['name'][$i];
                $_FILES['file']['type']     = $_FILES['photo']['type'][$i];
                $_FILES['file']['tmp_name'] = $_FILES['photo']['tmp_name'][$i];
                $_FILES['file']['error']     = $_FILES['photo']['error'][$i];
                $_FILES['file']['size']     = $_FILES['photo']['size'][$i];

                // File upload configuration
                $uploadPath = FCPATH.'assets/uploads/photo/';
                $config['upload_path'] = $uploadPath;
                $config['allowed_types'] = 'jpg|jpeg|png|gif';
                
                // Load and initialize upload library
                $this->load->library('upload', $config);

                $this->upload->initialize($config);                
                // Upload file to server
                if($this->upload->do_upload('file')){
                    // Uploaded file data
                    $fileData = $this->upload->data();
                    $uploadData[$i]['file_name'] = $fileData['file_name'];
                    $uploadData[$i]['uploaded_on'] = date("Y-m-d H:i:s");
                }
            }            
            if(!empty($uploadData)){
                // Here you can Process if the Upload is Successfull
                print_r($uploadData);
            }
            else
            {
            	// Here you can Process if the Upload is not Successfull
            	echo $this->upload->display_errors();
            }
        }//End of IF Function
	}// End of uploadPhoto Function
?>

<?php echo form_open_multipart('Welcome/uploadPhoto',array('id' => 'my_id')) ?>
<input type="file" name="photo[]">
<input type="submit" name="savedata" value="Save">
<?php echo form_close(); ?>
