<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        .main{
            display: flex;
            padding-top: 70px ;
         
        }
        h1{
            color: blueviolet;
        }
        .container {
            max-width: 800px;
            margin: 50px auto;
            background-color: #ffffff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            position: relative;
        }
        </style>
    
</head>
<body>

    

    <header>
        <?php
        include("header.php");
        ?>
    </header>
    
    <div class="main">
    <sidebar>
    <?php
        include("sidebar.php");
        ?>
    </sidebar>
    <form>
        <h1>Add Category</h1><br>
            <div class="form-group">
                <label for="categoryName">Category Name</label>
                <input type="text" class="form-control" id="categoryName" placeholder="Enter category name">
            </div>
            <div class="form-group">
                <label for="categorydes">Category Description</label>
                <input type="text" class="form-control datepicker" id="startDate" placeholder="Enter Category Description">
            </div>
           
            <a href="addcategory.php" class="btn btn-primary mt-3">Add Category</a>
            <a href="index.php" class="btn btn-primary mt-3">Go Back</a>
        </form>
            </div>
   
    <footer>
    <?php
        include("footer.php");
        ?>
    </footer>
</body>
</html>