<div class="wrapper">
    <header>
        <div>Добро пожаловать, <?=$_SESSION['user']['login']?>!</div>
        <div>
        <?php
            if ( ! $_SESSION['user']) {
                header("Location:/auth");
                exit();
            } elseif ($_POST) {
                header("Location:/task");
                exit();
            }

            $id_user=$_SESSION['user']['id'];

            if ($_SESSION['alert']) {
                echo "<span id=mess>".$_SESSION['alert']."</span>";
            }
            unset($_SESSION['alert']);

        ?>
        <a href="/exit">Выход</a></div>
    </header>
    <div class="main">
        <div class="tasks">
            <h1>Задания</h1>
            <h2>Добавить задание</h2>
            <form action="/task/addTask" method="post">
                <textarea name="desc" id="" cols="50" rows="" placeholder="Описание задания"></textarea>
                <input type="submit" value="Добавить" name="add_task">
            </form>
            <div class="actions">
                <form action="/task/delAll" method="post">
                    <input type="submit" class="del" value="Удалить все" name="del_all">
                </form>
                <form action="/task/changeAll" method="post">
                    <input type="submit" class="ready" value="Выполнить все" name="ready_all">
                </form>
            </div>
            <?php
                foreach ($data as $row) {
                    echo "
                    <div class=task>
                        <div>
                            <p>$row[description]</p>
                            <div class=act>
                                <form action=/task/delTask/?id_task=$row[id] method=post>
                                    <input type=submit value=Удалить class=del name=deltask>
                                </form>
                            ";
                                $color="green";
                                if ($row['status']==1) {
                                    echo "
                                    <form action='/task/status/?id_task=$row[id]&status=$row[status]' method=post>
                                        <input type=submit value=Выполнить class=ready name=ready>
                                    </form>
                                    ";
                                    $color="red";
                                } elseif ($row['status']==2) {
                                    echo "
                                    <form action='/task/status/?id_task=$row[id]&status=$row[status]' method=post>
                                        <input type=submit value=Отменить class=del name=unready>
                                    </form>
                                    ";
                                }
                            echo "
                            </div>
                        </div>
                        <div class='status $color'></div>
                    </div>";
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
