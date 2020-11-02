<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>  
  
</head>
<body>
    <div class="container">
        <h1 class="text-primary text uppercase text-center">AJAX CRUD OPERATION</h1>
        <div class="d-flex justify-content-end">
        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal">
        Open modal</button>
        </div>

        <h2 class="text-danger">All Records</h2>
        <div id="records_contant">
        
        </div>

        <div class="modal fade" id="myModal">
  <div class="modal-dialog">
    <div class="modal-content">

      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title">AJAX CRUD OPERATION</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>

      <!-- Modal body -->
      <div class="modal-body">
       <div class="form-group">
            <label for="firstname">Firstname:</label>
            <input type="text" id="firstname" class="form-control" placeholder="First Name">
       </div>
       <div class="form-group">
            <label for="lastname">Lastname:</label>
            <input type="text" id="lastname" class="form-control" placeholder="Last Name">
       </div>
       <div class="form-group">
            <label for="email">Email Id:</label>
            <input type="text" id="email" class="form-control" placeholder="Email">
       </div>
       <div class="form-group">
            <label for="mobile">Mobile:</label>
            <input type="text" id="mobile" class="form-control" placeholder="Mobile Number">
       </div>
      </div>

      <!-- Modal footer -->
      <div class="modal-footer">
      <button type="button" class="btn btn-success" data-dismiss="modal" onclick="addRecord()">Save</button>
        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
      </div>

    </div>
  </div>
</div>

<div class="modal fade" id="update_user_modal">
  <div class="modal-dialog">
    <div class="modal-content">

      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title">AJAX CRUD OPERATION</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>

      <!-- Modal body -->
      <div class="modal-body">
       <div class="form-group">
            <label for="update_firstname">Update_Firstname:</label>
            <input type="text" name="" id="update_firstname" class="form-control">
       </div>
       <div class="form-group">
            <label for="update_lastname">Update_Lastname:</label>
            <input type="text" name="" id="update_lastname" class="form-control">
       </div>
       <div class="form-group">
            <label for="update_email">Update_Email Id:</label>
            <input type="text" name="" id="update_email" class="form-control">
       </div>
       <div class="form-group">
            <label for="update_mobile">Update_Mobile:</label>
            <input type="text" name="" id="update_mobile" class="form-control">
       </div>
      </div>

      <!-- Modal footer -->
      <div class="modal-footer">
      <button type="button" class="btn btn-success" data-dismiss="modal" onclick="updateuserdetail()">Save</button>
        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
        <input type="hidden" name="" id="hidden_user_id">
      </div>

    </div>
  </div>
</div>


    </div>


  <script type="text/javascript">

  $(document).ready(function(){
      readyRecords();
  });

  function readRecords(){
      var readrecord = "readrecord";
      $.ajax({
          url:"backend.php",
          type:'post',
          data:{readrecord:readrecord},
          success:function(data,status){
              $('#records_contant').html(data);
          }
      });
  }
    function addRecord(){
        var firstname = $('#firstname').val();
        var lastname = $('#lastname').val();
        var email = $('#email').val();
        var mobile = $('#mobile').val();

        $.ajax({
            url:"backend.php",
            type:'post',
            data:{firstname:firstname,
                lastname:lastname,
                email:email,
                mobile:mobile
            },
            success:function(data,status){
                readRecords();
            }
        });
    }

    function DeleteUser(deleteid){
      var conf=confirm("Are You sure");
      if(conf==true){
        $.ajax({
          url:"backend.php",
          type:"post",
          data:{deleteid:deleteid},
          success:function(data,status){
            readRecords();
          }
        });
      }
    }

    function GetUserDetails(id){
      $('#hidden_user_id').val(id);
      $.post("backend.php",{
        id:id
      },function(data,status){
        var user=JSON.parse(data);
        $('#update_firstname').val(user.firstname);
        $('#update_lastname').val(user.lastname);
        $('#update_email').val(user.email);
        $('#update_mobile').val(user.mobile);
      }
      );
      $('#update_user_modal').modal("show");
    }

    function updateuserdetail(){
      var firstnameupd=$('#update_firstname').val();
      var lastnameupd=$('#update_lastname').val();
      var emailupd=$('#update_email').val();
      var mobileupd=$('#update_mobile').val();

      var hidden_user_idupd=$('#hidden_useer_id').val();
      $post("backend.php",{
        hidden_user_idupd:hidden_user_idupd,
        firstnameupd:firstnameupd,
        lastnameupd:lastnameupd,
        emailupd:emailupd,
        mobileupd:mobileupd,
      },
      function(data,status){
        $("#update_user_id").modal("hide");
        readRecords();
      }
      );
    }
  </script>
</body>
</html>