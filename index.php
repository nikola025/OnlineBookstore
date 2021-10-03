<?php
    require_once "header.php";
    
    if (isset($_GET['show'])){
        $bookId = sanitizeString($_GET['show']);
        $result = queryMysql("SELECT bname, bauthor, bprice, bdesc FROM books WHERE books.id = $bookId");
        $row = $result->fetch_assoc();
            
            echo "<div class='mimg'>";
            echo "<img src='slike/knjiga$bookId.jpg'>";
            echo "<br>";
            echo "<p class='nameb'>" .$row['bname']."</p>";
            echo "<p class='author'>" .$row['bauthor']."</p>";
            echo "<p class='price'>" .$row['bprice']."</p>";
            echo $row['bdesc'];
            echo "</div>";
        die("</div></body></html>");
           
    }
    
    if (isset($_GET['buy'])){

        $bookId = sanitizeString($_GET['buy']);

        $result = queryMysql("SELECT * FROM cart WHERE buyer_id = $id 
                                    AND book_id = $bookId");
        if($result->num_rows == 0){
            queryMysql("INSERT INTO cart(buyer_id, book_id)
            VALUES ($id, $bookId)");
        }
    }
    
?>
        <?php if($loggedin){ ?>
        <form action="" method="POST">
            <input type="text" name="sbname" id="sbname" placeholder="Pretražujte knjige po nazivu" onkeyup = "checkname(this)">           
        </form>
        <?php } ?>
        <script>
        function checkname(inp){
        var sbname = inp.value;
        if(sbname == ""){
            document.getElementsByClassName('content')[0].innerHTML = "";         
            return;
        } 
        var params = "sbname=" + sbname;
        var request = ajaxRequest();
        if(request !== false){
            request.open("POST", "checkname.php", true);
            request.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            request.setRequestHeader("Content-length", params.length);
            request.setRequestHeader("Connection","close");
            request.onreadystatechange = function(){                    
                if(this.readyState == 4 && this.status == 200){      
                    document.getElementsByClassName('content')[0].innerHTML = this.responseText;
                }
            }
            request.send(params);         
        }}
        </script>
        
        <div class="content">
            <?php  
                $result = queryMysql("SELECT * FROM books");
                echo"<ul>";
                
                while($row = $result->fetch_assoc()){
                    $bookId = $row['id'];
                    echo "<li <span class='bookname'></span>";
                    echo "<br>";
                    echo "<a href='index.php?show=$bookId'>";
                    echo "<img src='slike/knjiga$bookId.jpg'>";
                    echo "</a>";
                    echo "<br>";
                    echo $row['bname'];
                    echo "<br>";
                    echo "<span class='author'>" .$row['bauthor']."</span>";echo "<br><br>";
                    echo "<span class='price'>" .$row['bprice']."</span>";echo "<br><br>";
                    if ($loggedin && !$admin && !$moderator){
                    // echo "<a href='index.php?buy=$bookId'>U korpu</a>";
                    echo "<a mid='$id' bid='$bookId' href='#' class='add'><img class='cart' src='slike/cart.png'></a>";
                    echo "<br>";
                    }
                    echo "</li>";
                }
                echo"</ul>";
            ?>
        </div>
        <script src="script/myscript.js"></script>
        <script>
            var addLinks = document.querySelectorAll('.add');
            for (var i = 0; i< addLinks.length; i++){
                addLinks[i].addEventListener("click", function(event){
                    event.preventDefault(); 
                    var myId = this.getAttribute('mid');
                    var bookId = this.getAttribute('bid');
                    var params = "action=add&myId=" + myId + "&bookId=" + bookId;
                    var request = ajaxRequest();
                    if (request !==false){
                        request.open("POST","addtocart.php", true);
                        request.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
                        request.setRequestHeader("Content-length", params.length);
                        request.setRequestHeader("Connection","close");
                        
                        request.onreadystatechange = function(){
                            if(this.readyState == 4 && this.status == 200){
                                document.getElementById(bookId).innerHTML = this.responseText;
                            }
                        }
                        request.send(params);
                    }

                }
                );
            }
        </script>

    </div>
    