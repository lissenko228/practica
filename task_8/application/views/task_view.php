    <div class="wrapper">
        <header>
            <div>Добро пожаловать, <?=$_SESSION['user']['login']?>!</div>
            <div>
            <?php
                if(!$_SESSION['user'])
                {
                    header("Location:/auth");
                    exit();
                }
                elseif($_POST)
                {
                    header("Location:/task");
                    exit();
                }
                $id_user=$_SESSION['user']['id'];
                if($_SESSION['alert'])
                {
                    echo "<span id=mess>".$_SESSION['alert']."</span>";
                }
                unset($_SESSION['alert'])
            ?>
            <a href="../controllers/exit.php">Выход</a></div>
        </header>
        <div class="main">
            <div class="tasks">
                <h1>Задания</h1>
                <h2>Добавить задание</h2>
                <form action="" method="post">
                    <textarea name="desc" id="" cols="50" rows="" placeholder="Описание задания"></textarea>
                    <input type="submit" value="Добавить" name="add_task">
                </form>
                <div class="actions">
                    <a href="?id_user=<?=$id_user?>" class="del">Удалить все</a>
                    <a href="?id_user=<?=$id_user?>" class="ready">Выполнить все</a>
                </div>
                <?php
                    $str_out_t="SELECT * FROM `tasks` where `id_user` = '$id_user'";
                    $run_out_t=mysqli_query($connect,$str_out_t);

                    while($out_t=mysqli_fetch_array($run_out_t))
                    {
                        echo "<div class=task>
                        <div>
                            <p>$out_t[description]</p>
                            <div class=act>
                                <a href='../controllers/del.php?id_task=$out_t[id]' class=del>Удалить</a>";
                                $color="green";
                                if($out_t['status']==1)
                                {
                                    echo "<a href='?id_task=$out_t[id]&status=$out_t[status]' class=ready>Выполнить</a>";
                                    $color="red";
                                }
                                elseif($out_t['status']==2)
                                {
                                    echo "<a href='?id_task=$out_t[id]&status=$out_t[status]' class=del>Отменить</a>";
                                }
                            echo "
                            </div>
                        </div>
                        <div class='status $color'></div>
                    </div>";
                    }

                    $id_task=$_GET['id_task'];
                    $status=$_GET['status'];

                    if($id_task)
                    {
                        if($status==1)
                        {
                            $upd_stat="UPDATE `tasks` SET `status` = '2' WHERE `id` = '$id_task'";
                            $upd=mysqli_query($connect,$upd_stat);
                            if($upd)
                            {
                                $_SESSION['alert']="Задача выполнена";
                            }
                            else
                            {
                                $_SESSION['alert']="Ошибка выполнения";
                            }
                        }
                        elseif($status==2)
                        {
                            $upd_stat="UPDATE `tasks` SET `status` = '1' WHERE `id` = '$id_task'";
                            $upd=mysqli_query($connect,$upd_stat);
                            if($upd)
                            {
                                $_SESSION['alert']="Задача отменена";
                            }
                            else
                            {
                                $_SESSION['alert']="Ошибка отмены";
                            }
                        }    
                    }

                    $id_user=$_GET['id_user'];

                    if($id_user)
                    {
                        $upd_stat="UPDATE `tasks` SET `status` = '2' WHERE `id_user` = '$id_user'";
                        $upd=mysqli_query($connect,$upd_stat);

                        if($upd)
                        {
                            $_SESSION['alert']="Задача выполнена";
                        }
                        else
                        {
                            $_SESSION['alert']="Ошибка выполнения";
                        }
                    }

                ?>
            </div>
        </div>
        <footer>
        ©Корепанов Влад
    </footer>
    </div>
    <script>
            setTimeout(function(){
                document.getElementById('mess').style.display = "none";
            }, 5000);
    </script>
