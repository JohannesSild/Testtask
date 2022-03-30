<!DOCTYPE html>

<html>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    
    <head>
        <title></title>
    </head>
    <body>

        <h1>Product list</h1>
        <form action="addProduct.php">
            <button class="button1">ADD</button>
        </form>
        <form id="deleteProducts" action="test.php" method="post">
            <input type="submit" class="button2" value="MASS DELETE" name="delete-product-btn" id="delete-product-btn">           
            <input type="hidden" name="del" id="del" value=""> <br>
        </form>
        
        <div id="products"></div> 

    </body>
</html>

<script>
    $(document).ready(function() {
        $("#products").load("test.php", function(){
            temp = [];
            del = [];
            $("#delete-product-btn").click(function(){
                i=0;
                $("#products").find("input:checkbox").each(function(){
                    if ($(this).prop('checked')==true){ 
                        del[i] = this.id;
                        i++;
                    } 
                });
                $("#del").val(del);
            });
        });        
    });
</script>

<style>
    .button1 {
    position: absolute; //relative
    top: 30px;
    right: 150px;
    }
    .button2 {
    position: absolute; //relative
    top: 30px;
    right: 30px;
    }
</style>