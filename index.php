<?php 
    require 'connection.php';
?>
<DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>To-Do App</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="main-section">
        <div class="add-section">
            <form action="create.php" method="POST">
                <?php if(isset($_GET['mess']) && $_GET['mess'] == 'error'){ ?>
                    <input type="text" name="title" placeholder="The field is required">
                    <button type="submit">Add &nbsp; <span>&#43;</span></button>
                <?php }else{ ?>
                    <input type="text" name="title" placeholder="What is your focus today?">
                    <button type="submit">Add &nbsp; <span>&#43;</span></button>
                <?php } ?>
            </form>
        </div>
        <div class="show-todo-section">
        <?php 
            $query = $conn->query("SELECT * FROM tbl_todo ORDER BY id DESC");

            while($todo = $query->fetch(PDO::FETCH_ASSOC)):
            ?>
                <div class="todo-item">
                    <span id="<?php echo $todo['id'] ?>"
                          class="remove-to-do">x</span>
                    <?php if($todo['checked']){ ?>
                        <input type="checkbox"
                               class="check-box"
                               data-todo-id ="<?php echo $todo['id'] ?>"
                               checked />
                        <h2 class="checked"><?php echo $todo['title'] ?></h2>
                    <?php }else { ?>
                        <input type="checkbox"
                               data-todo-id ="<?php echo $todo['id'] ?>"
                               class="check-box" />
                        <h2><?php echo $todo['title'] ?></h2>
                    <?php } ?>
                    <br>
                    <small>created: <?php echo $todo['date'] ?></small>
                </div>
            <?php endwhile ?>
        </div>
    </div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

    <script>
        $(document).ready(function(){
            $('.remove-to-do').click(function(){
                const id = $(this).attr('id');
                
                $.post("delete.php", 
                      {
                          id: id
                      },
                      (data)  => {
                         if(data){
                             $(this).parent().hide(600);
                         }
                      }
                );
            });

            $(".check-box").click(function(e){
                const id = $(this).attr('data-todo-id');
                
                $.post('check.php', 
                      {
                          id: id
                      },
                      (data) => {
                          if(data != 'error'){
                              const h2 = $(this).next();
                              if(data === '1'){
                                  h2.removeClass('checked');
                              }else {
                                  h2.addClass('checked');
                              }
                          }
                      }
                );
            });
            
        });
    </script>
</body>
</html>