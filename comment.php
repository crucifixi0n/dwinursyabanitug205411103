<!DOCTYPE HTML>
<html>
<head>
<title>DNS Portfolio | Comment</title>
<meta charset="utf-8">
<link rel="stylesheet" type="text/css" href="css/style.css">
<script src="https://code.jquery.com/jquery-3.4.1.js" integrity="sha256-WpOohJOqMqqyKL9FccASB9O0KwACQJpFTUBLTYOVvVU=" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
</head>
<body>
<header>
  <nav class="main-nav">
    <ul>
      <li>
        <ul>
          <li><a href="index.php">home</a></li>
          <li><a href="services.php">services</a></li>
          <li><a href="comment.php" class="active">comment</a></li>
        </ul>
      </li>
    </ul>
  </nav>
</header>
<section id="video" class="comment">
  <h1>leave me a comment</h1>
</section>
<section id="main-content">
  <div class="text-intro">
    <h2>Comment here</h2>
  </div>
  <div class="columns features">
    <form method="post" id="comment_form">
      <textarea id="comment" maxlength="10000" name="comment" placeholder="Your comment"></textarea>
      <div class="texticon"></div>
      <input type="name" class="input-name" id="name" maxlength="50" name="name" placeholder="Name">
      <div class="nameicon"></div>
	  <input type="hidden" name="comment_id" id="comment_id" value="0"/>
      <input type="submit" class="btn btn-input" id="submit" name="submit" value="SUBMIT">
	</form>
  </div>
	<div class="columns features">
	  <h3>Comments</h3>
	  <p>Write your name and comment to leave any comment.</p>
	  <p>Click reply, then write your name and comment to reply.</p>
	  <span id="comment_message"></span>
	  <br/><br/>
	  <div id="display_comment"></div>
	  </div>
	</div>
</section>
</body>
</html>

<script>
$(document).ready(function(){
 
 $('#comment_form').on('submit', function(event){
  event.preventDefault();
  var form_data = $(this).serialize();
  $.ajax({
   url:"add_comment.php",
   method:"POST",
   data:form_data,
   dataType:"JSON",
   success:function(data)
   {
    if(data.error != '')
    {
     $('#comment_form')[0].reset();
     $('#comment_message').html(data.error);
     $('#comment_id').val('0');
     load_comment();
    }
   }
  })
 });

 load_comment();

 function load_comment()
 {
  $.ajax({
   url:"fetch_comment.php",
   method:"POST",
   success:function(data)
   {
    $('#display_comment').html(data);
   }
  })
 }

 $(document).on('click', '.reply', function(){
  var comment_id = $(this).attr("id");
  $('#comment_id').val(comment_id);
  $('#comment_name').focus();
 });
 
});
</script>