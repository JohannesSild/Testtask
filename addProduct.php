<!DOCTYPE html>

<html>
    <head>
        <title></title>
        <script src="https://code.jquery.com/jquery-3.6.0.min.js" 
            integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" 
            crossorigin="anonymous">
        </script>
    </head>
    <body onload="OnSelectionChange(0)">
        <div id="container">
            <h1>Product Add</h1>
            <form action="index.php">
                <button class="button1">cancel</button>
            </form>
            <form id="product_form" action="test.php" method="post">
                <input type="submit" value="Save" name="save" id="save"><br>

                <label for="sku">SKU</label>
                <input type="text" name="sku" id="sku" required> <br>

                <label for="name">Name</label>
                <input type="text" name="name" id="name" required> <br>

                <label for="price">Price($)</label>
                <input type="number" name="price" id="price" required> <br>
                
                <label for="productType">Type Switcher</label>
                
                <select name="productType" id="productType" onchange="OnSelectionChange(document.getElementById(this.id).value)">
                    <option value="0">DVD</option>
                    <option value="1">Book</option>
                    <option value="2">Furniture</option>
                </select>
                <div id="TypeSize"></div>
                

                <script>
                    function OnSelectionChange(s1) {

                        const plz = [
                            "<p>Please, provide size.</p>",
                            "<p>Please, provide weight.</p>",
                            "<p>Please, provide dimensions.</p>"
                        ];
                        const des = [
                            "<p>Enter DVD size in MB's.</p>",
                            "<p>Enter Book weight in Kg's.</p>",
                            "<p>Enter Furniture dimensions as height, width and length.</p>"
                            ];
                        const lbl = [
                            "<label for='size'>Size(MB) </label> <input type='number' name='size' id='size' required>",
                            "<label for='weight'>Weight(Kg) </label> <input type='number' name='weight' id='weight' required>",
                            "<p id='furniture'><label for='height'>Height(CM) </label> <input type='number' name='height' id='height' required><br>    <label for='width'>Width(CM) </label> <input type='number' name='width' id='width' required><br>     <label for='length'>Length(CM) </label> <input type='number' name='length' id='length' required></p>"
                            ];
                        $("#TypeSize").empty();
                        $("#TypeSize").append(plz[s1], lbl[s1], des[s1]);
                        
                    }
                </script>
                
                
            </form>
        </div>
    </body>
</html>

<style>
    .button1 {
    position: absolute; //relative
    top: 30px;
    right: 30px;
    }
</style>