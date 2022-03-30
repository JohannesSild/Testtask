<?php
    //include 'DB.php';
?>

<!DOCTYPE html>

<html>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    
    <head>
        <title></title>
    </head>
    <body>

        <h1>Product list</h1>
        <form action="addProduct.php">
            <button class="button1">add</button>
        </form>
        <form id="deleteProducts" action="filler.php" method="post">
            <input type="submit" class="button2" value="mass delete" name="delete" id="delete">           
            <input type="hidden" name="del" id="del" value=""> <br>
        </form>
        
        <div id="products"></div> 

    </body>
</html>

<script>
    $(document).ready(function() {
        $("#products").load("filler.php", function(){
            temp = [];
            del = [];
            $("#delete").click(function(){
                i=0;
                $("#products").find("input:checkbox").each(function(){
                    if ($(this).prop('checked')==true){ 
                        del[i] = this.id;
                        i++;
                        //$("#products").append(this.id);
                        //$("#products").append("<br>");
                    } 
                });
                $("#del").val(del);
                $("#products").append(document.getElementById(del).value);
            });
        });        
    });
</script>

<style>
    .button1 {
    position: absolute; //relative
    top: 30px;
    right: 120px;
    }
    .button2 {
    position: absolute; //relative
    top: 30px;
    right: 30px;
    }
</style>