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
           
            <button type="submit" class="btn btn-primary text-center">Add Category</button>
        </form>
            </div>
   
    <footer>
    <?php
        include("footer.php");
        ?>
    </footer>
</body>
</html>