<!DOCTYPE html>
<html>

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KyZXEAg3QhqLMpG8r+8fhAXLRk2vvoC2f3B09zVXn8CA5QIVfZOJ3BCsw2P0p/We" crossorigin="anonymous">

  <title>Facebook SDK</title>

  <style>
    #postImage,
    #postLink {
      display: none;
    }
  </style>
</head>

<body>

  <div class="container">

    <div>
      <input type="checkbox" id="PostCheck" name="PostCheck" value="on" checked>
      <label for="PostCheck">Normal Post</label><br>

      <input type="checkbox" id="ImagePostCheck" name="ImagePostCheck" value="on">
      <label for="ImagePostCheck">Image Post</label><br>

      <input type="checkbox" id="LinkCheck" name="LinkCheck" value="on">
      <label for="LinkCheck">Link</label><br>
    </div>

    <div id="postImage">

      <form action="upload.php" method="post" enctype="multipart/form-data">
        Select image to upload:
        <input type="text" class="form-control" placeholder="Image description" name="description" />
        <input type="file" class="form-control" name="fileToUpload" id="fileToUpload">
        <input type="submit" value="Upload Image" name="submit" class="btn btn-primary">
      </form>
    </div>


    <div id="postLink">

      <form action="upload.php" method="post">
        <input type="text" class="form-control" placeholder="Link description" name="description" />
        <input type="text" class="form-control" placeholder="URL...Web Address" name="website" />
        <input type="submit" name="sharedLink" class="btn btn-primary">
      </form>
    </div>

    <div id="postText">

      <form action="upload.php" method="post">
        <input type="text" class="form-control" placeholder="What's going on?" name="post" />
        <input type="submit" name="sharedTextPost" class="btn btn-primary">
      </form>
    </div>




  </div>




  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-U1DAWAznBHeqEIlVSCgzq+c9gqGAJn5c/t99JyeKa9xxaYpSvHU5awsuZVVFIhvj" crossorigin="anonymous"></script>
  <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
  <script>
    $("#PostCheck").on("click", () => {
      $("#ImagePostCheck").prop('checked', false);
      $("#LinkCheck").prop('checked', false);


      $("#postImage").css({
        display: "none"
      });
      $("#postText").css({
        display: "block"
      });
      $("#postLink").css({
        display: "none"
      });

    });

    $("#ImagePostCheck").on("click", () => {
      $("#PostCheck").prop('checked', false);
      $("#LinkCheck").prop('checked', false);

      $("#postImage").css({
        display: "block"
      });
      $("#postText").css({
        display: "none"
      });
      $("#postLink").css({
        display: "none"
      });
    });

    $("#LinkCheck").on("click", () => {
      $("#PostCheck").prop('checked', false);
      $("#ImagePostCheck").prop('checked', false);


      $("#postImage").css({
        display: "none"
      });
      $("#postText").css({
        display: "none"
      })
      $("#postLink").css({
        display: "block"
      })

    });
  </script>
</body>

</html>