<?php

/* @var $this yii\web\View */
/* @var $authors */
?>
<div class="container-fluid">
    <div class="card shadow mb-4 border-bottom-warning border-left-warning">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Authors of the selected publication</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                    <tr>
                        <th>#</th>
                        <th>Authid</th>
                        <th>Authname</th>
                        <th>Afid</th>
                        <th>Afname</th>
                        <th>Afcity</th>
                        <th>Afcountry</th>
                    </tr>
                    </thead>
                    <tbody>
                        <?php
                            $array = explode('|', $authors);
                            $count = 0;
                            foreach($array as $element){
                                $count++;
                                echo "<tr>";
                                echo "<td>$count</td>";
                                $row = explode('@', $element);
                                foreach($row as $column){
                                    echo "<td>$column</td>";
                                }
                                echo "</tr>";
                            }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

