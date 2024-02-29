<?php include('header.php'); ?>
<?php include('session.php'); ?>

<body >
    <?php include('navbar.php'); ?>
    <div class="container-fluid">
        <div class="row-fluid">
            <?php include('subject_sidebar.php'); ?>

            <div class="span9" id="content">
                <div class="row-fluid">
                    <a href="add_subject.php" class="btn btn-info"><i class="icon-plus-sign icon-large"></i> Add
                        Subject</a>
                    <!-- block -->
                    <div id="block_bg" class="block">
                        <div class="navbar navbar-inner block-header">
                            <div class="pull-left">Subject List</div>
                        </div>
                        <div class="block-content collapse in">
                            <div class="span12">
                                <form action="delete_subject.php" method="post">
                                    <table cellpadding="0" cellspacing="0" border="0" class="table" id="example">
                                        <a data-toggle="modal" href="#subject_delete" id="delete" class="btn btn-danger"
                                            name=""><i class="icon-trash icon-large"></i></a>
                                        <?php include('modal_delete.php'); ?>
                                        <thead>
                                            <tr>
                                                <th></th>
                                                <th>Subject Code</th>
                                                <th>Subject Title</th>
                                                <th></th>
                                            </tr>
                                        </thead>
                                        <tbody>

                                            <?php
											$subject_query = mysqli_query($conn,"select * from subject")or die(mysqli_error());
											while($row = mysqli_fetch_array($subject_query)){
											$id = $row['subject_id'];
											?>

                                            <tr>
                                                <td width="30">
                                                    <input id="optionsCheckbox" class="uniform_on" name="selector[]"
                                                        type="checkbox" value="<?php echo $id; ?>">
                                                </td>
                                                <td><?php echo $row['subject_code']; ?></td>
                                                <td><?php echo $row['subject_title']; ?></td>

                                                <td width="30"><a href="edit_subject.php<?php echo '?id='.$id; ?>"
                                                        class="btn btn-success"><i class="icon-pencil"></i> </a></td>
                                            </tr>

                                            <?php } ?>

                                        </tbody>
                                    </table>
                                </form>
                            </div>
                        </div>
                    </div>
                    <!-- /block -->
                </div>


            </div>
        </div>
        <?php include('footer.php'); ?>
    </div>
    <?php include('script.php'); ?>
</body>

</html>