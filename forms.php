<!-- header -->
<?php include('header.php') ?>



<?php
$urls = $_SERVER['SERVER_NAME'].$_SERVER['REQUEST_URI'];
$urls = basename(parse_url($urls, PHP_URL_PATH));

if($urls=='forms'){
echo '
<form method="POST">
    <label for="title">عنوان</label>
    <input name="title" id="title" type="text">
    <br />
    <label for="urls">نامک</label>
    <input name="urls" id="urls" type="text">
    <br />
    <label for="summary">توضیحات</label>
    <textarea name="summary" id="summary"></textarea>

    <input type="submit" name="create" id="create" value="ارسال فرم">
</form>
';

    if(isset($_POST["create"])){
        $title = $_POST['title'];
        $urls = $_POST['urls'];
        $summary = $_POST['summary'] ;
        $created_date = date('y-m-d');

        $sql = "INSERT INTO forms (title,urls,summary,created_date)
        VALUES ('$title','$urls','$summary','$created_date')";

        if ($conn->query($sql) === TRUE) {
        echo "New record created successfully";
        } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
        }

        $conn->close();

    }

}else{

    // get form id
   
    $sql = "select * FROM forms WHERE urls='$urls' ";
    $result = $conn->query($sql);
    
    if ($result->num_rows > 0) {
      // output data of each row
        while($row = $result->fetch_assoc()) {
            echo "نام فرم: " . $row["title"]."<br/>";

            echo '
            
            <form method="POST">
                <label for="title">سوال</label>
                <input name="title" id="title" type="text">
                <br />
                <label for="responses_key">پاسخ صحیح</label>
                <input name="responses_key" id="responses_key" type="text">
                <br />
                <label for="responses">پاسخ ها</label>
                <textarea name="responses" id="responses"></textarea>
            
                <input type="submit" name="add" id="add" value="ارسال فرم">
            </form>
            
            ';
            if(isset($_POST["add"])){
                $title = $_POST['title'];
                $responses = $_POST['responses'];
                $responses_key = $_POST['responses_key'] ;
                $created_date = date('y-m-d');
                $form_id = $row['id'];
                $sql = "INSERT INTO questions (form_id,title,responses,responses_key,created_date)
                VALUES ($form_id,'$title','$responses','$responses_key','$created_date')";

                if ($conn->query($sql) === TRUE) {
                echo "New record created successfully";
                } else {
                echo "Error: " . $sql . "<br>" . $conn->error;
                }


            }
        }
    } else {
      echo "404";
    }
    $conn->close();


}
?>


<!-- footer -->
<?php include('footer.php') ?>