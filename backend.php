<?php

$conn=mysqli_connect('localhost','root',"",'crudoperation');
extract($_POST);

if(isset($_POST['readrecord'])){
    $data='<table class="table table-bordered table-striped">
            <tr>
            <th>No.</th>
            <th>First Name</th>
            <th>Last Name</th>
            <th>Email</th>
            <th>Mobile Number</th>
            <th>Edit Action</th>
            <th>Delete Action</th>
            </tr>';

            $displayquery = "SELECT * FROM crudtable1 ";
            $result = mysqli_query($conn,$displayquery);
            if(mysqli_num_rows($result) > 0)
            {
                $number=1;
                while($row = mysqli_fetch_array($result)){
                    $data .= '<tr>
                        <td>'.$number.'</td>
                        <td>'.$row['firstname'].'</td>
                        <td>'.$row['lastname'].'</td>
                        <td>'.$row['email'].'</td>
                        <td>'.$row['mobile'].'</td>
                        <td>
                            <button onclick="GetUserDetails('.$row['id'].')" class="btn btn-warning">Edit</button>
                            </td>
                            <td>
                            <button onclick="DeleteUser('.$row['id'].')" class="btn btn-danger">Delete</button>
                            </td>
                            </tr>';
                            $number++;
                }
            }

            $data .= '/table';
            echo $data;
}

if(isset($_POST['firstname']) && isset($_POST['lastname']) && isset($_POST['email']) && isset($_POST['mobile']))
{
    $query="INSERT INTO `crudtable1`( `firstname`, `lastname`, `email`, `mobile`) VALUES ('$firstname','$lastname','$email','$mobile')";
    mysqli_query($conn,$query);
}

if(isset($_POST['deleteid'])){
    $userid=$_POST['deleteid'];
    $deletequery="delete from crudtable where id='$userid'";
    mysqli_query($conn,$deletequery);
}

if(isset($_POST['id']) && isset($_POST['id']) !="")
{
    $user_id = $_POST['id'];
    $query="SELECT * FROM curdtable1 WHERE id = '$user_id'";
    if(!$result=mysqli_query($conn,$query)){
        exit(mysqli_error());
    }
    $response=array();
    if(mysqli_num_rows($result) > 0){
        while($row = mysqli_fetch_assoc($result)){
            $response=$row;
        }
    }else
    {
        $response['status']=200;
        $response['message']="Data not found!";
    }
    echo json_encode($response);
}else{
    $response['status']=200;
    $response['message']="invalid response";
}

if(isset($_POST['hidden_user_idupd'])){
    $hidden_user_idupd=$_POST['hidden_user_idupd'];
    $firstnameupd=$_POST['firstnameupd'];
    $lastnameupd=$_POST['lastnameupd'];
    $emailupd=$_POST['emailupd'];
    $mobileupd=$_POST['mobileupd'];

    $query="UPDATE `crudtable1` SET `firstname`='$firstnameupd',`lastname`='$lastnameupd',`email`='$emailupd',`mobile`='$mobileupd' WHERE id='$hidden_user_idupd'";
    mysqli_query($conn,$query);
}

?>